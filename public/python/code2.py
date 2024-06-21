import sys
import json
import subprocess
import os
import difflib

def run_dart_analyze(flutter_code_path):
    try:
        process = subprocess.Popen(['dart', 'analyze', flutter_code_path],
                                   stdout=subprocess.PIPE, stderr=subprocess.PIPE, text=True, shell=True)
        stdout, stderr = process.communicate()

        # Parsing stdout untuk menghitung jumlah error
        error_count = 0
        for line in stdout.splitlines():
            if "error" in line.lower():
                error_count += 1

        return process.returncode, stdout, stderr, error_count
    except Exception as e:
        return -1, str(e), str(e), 0

def clean_line(line):
    cleaned_line = line.split('//')[0].strip()  # Mengambil bagian sebelum //
    return cleaned_line

def is_significant_change(code):
    if not code:
        return False
    if code.startswith('//'):
        return False
    if code.startswith('{') and code.endswith('}'):
        return False
    if code.startswith('[') and code.endswith(']'):
        return False
    if code.startswith('\"') and code.endswith('\"'):
        return False
    if code.startswith('(') and code.endswith(')'):
        return False
    if all(char in '{[;,]}\'"' for char in code):
        return False
    return True

def compare_code(student_code_path, kunci_jawaban_path):
    with open(student_code_path, 'r') as student_file:
        student_code = student_file.readlines()

    with open(kunci_jawaban_path, 'r') as kunci_jawaban_file:
        kunci_jawaban_code = kunci_jawaban_file.readlines()

    differ = difflib.Differ()
    diff = list(differ.compare(kunci_jawaban_code, student_code))

    error_count = 0
    for line in diff:
        if line.startswith('? '):  # Karakter ? menunjukkan perbedaan yang tidak dapat dihitung
            error_count += 1

    differences = []
    for line in diff:
        if line.startswith('- ') or line.startswith('+ '):
            kode = "code 1" if line.startswith('- ') else "code 2"
            if is_significant_change(line[2:].strip()):
                differences.append({kode: line[2:].strip()})
                error_count += 1

    return {'error_count': error_count, 'differences': differences}

def check_keywords(student_code_path, keywords):
    with open(student_code_path, 'r') as student_file:
        student_code = student_file.read()

    missing_keywords = [keyword for keyword in keywords if keyword not in student_code]
    return len(missing_keywords), missing_keywords

def evaluate_flutter_code(student_code_path, kunci_jawaban_path, keywords):
    analyze_returncode, analyze_stdout, analyze_stderr, analyze_error_count = run_dart_analyze(student_code_path)

    if os.path.exists(kunci_jawaban_path) and kunci_jawaban_path:
        differences_result = compare_code(student_code_path, kunci_jawaban_path)
    else:
        differences_result = {'error_count': 0, 'differences': []}

    analyze_penalty = min(analyze_error_count * 3, 30)
    differences_penalty = min(differences_result['error_count'] * 0.6, 20)

    keyword_penalty = 0
    missing_keywords = []
    if keywords:
        missing_keyword_count, missing_keywords = check_keywords(student_code_path, keywords)
        max_keyword_penalty = 50
        if len(keywords) > 0:
            penalty_per_keyword = max_keyword_penalty / len(keywords)
            keyword_penalty = min(missing_keyword_count * penalty_per_keyword, max_keyword_penalty)

    total_penalty = min(analyze_penalty + differences_penalty + keyword_penalty, 100)
    score = max(100 - total_penalty, 0)

    result = {
        'analyze_returncode': analyze_returncode,
        'analyze_stdout': analyze_stdout,
        'analyze_stderr': analyze_stderr,
        'analyze_error_count': analyze_error_count,
        'analyze_penalty': analyze_penalty,
        'differences': differences_result['differences'],
        'differences_total': differences_result['error_count'],
        'differences_penalty': differences_penalty,
        'missing_keywords': missing_keywords,
        'keyword_penalty': keyword_penalty,
        'total_penalty': total_penalty,
        'score': score,
        'student_code_path': student_code_path,
        'kunci_jawaban_path': kunci_jawaban_path,
    }

    return result

def main():
    if len(sys.argv) != 4:
        print(json.dumps({"error": "Usage: python code2.py <student_code_path> <kunci_jawaban_path> <keywords>"}))
        sys.exit(1)

    student_code_path = 'flutter_application_1/lib/' + sys.argv[2]
    kunci_jawaban_path = 'flutter_application_1/lib/' + sys.argv[1]
    key_word = sys.argv[3]
    keywords = key_word.split(', ') if key_word else []

    evaluation_result = evaluate_flutter_code(student_code_path, kunci_jawaban_path, keywords)

    print(json.dumps(evaluation_result))

if __name__ == '__main__':
    main()
