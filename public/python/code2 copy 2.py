import subprocess
import difflib
import json
import os

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

def compare_code(student_code_path, kunci_jawaban_path):
    with open(student_code_path, 'r') as student_file:
        student_code = student_file.readlines()

    with open(kunci_jawaban_path, 'r') as kunci_jawaban_file:
        kunci_jawaban_code = kunci_jawaban_file.readlines()

    differ = difflib.Differ()
    diff = list(differ.compare(student_code, kunci_jawaban_code))

    error_count = 0
    for line in diff:
        if line.startswith('? '):  # Karakter ? menunjukkan perbedaan yang tidak dapat dihitung
            error_count += 1

    # Menyiapkan list untuk menyimpan perbedaan antara kode siswa dan kunci jawaban
    differences = []
    for line in diff:
        if line.startswith('- ') or line.startswith('+ '):
            # Menyimpan nomor baris dan jenis perubahan
            kode = "code 1" if line.startswith('- ') else "code 2"
            differences.append({kode: line[2:].strip()})

    return {'error_count': error_count, 'differences': differences}

def evaluate_flutter_code(student_code_path, kunci_jawaban_path):
    analyze_returncode, analyze_stdout, analyze_stderr, analyze_error_count = run_dart_analyze(student_code_path)

    # Cek keberadaan file kunci jawaban
    if os.path.exists(kunci_jawaban_path):
        # Membandingkan kode siswa dengan kunci jawaban
        differences_result = compare_code(student_code_path, kunci_jawaban_path)
    else:
        print(f"File kunci jawaban '{kunci_jawaban_path}' tidak ditemukan.")
        differences_result = {'error_count': 0, 'differences': []}

    # Menghitung nilai berdasarkan jumlah error dan perbedaan
    analyze_penalty = analyze_error_count * 10
    differences_penalty = differences_result['error_count'] * 5
    total_penalty = analyze_penalty + differences_penalty
    score = 100 - total_penalty
    score = max(0, score)  # Skor minimum adalah 0

    # Mengembalikan hasil penilaian dalam bentuk objek JSON
    result = {
        'analyze_returncode': analyze_returncode,
        'analyze_stdout': analyze_stdout,
        'analyze_stderr': analyze_stderr,
        'analyze_error_count': analyze_error_count,
        'analyze_penalty': analyze_penalty,
        'differences': differences_result['differences'],
        'differences_penalty': differences_penalty,
        'total_penalty': total_penalty,
        'score': score,
    }

    return json.dumps(result, indent=2)

def main():
    student_code_path = 'flutter_application_1/lib/main3.dart'
    kunci_jawaban_path = 'flutter_application_1/lib/main.dart'

    key_word = 'FloatingActionButton, Increment, Text'

    evaluation_result = evaluate_flutter_code(student_code_path, kunci_jawaban_path)

    print(evaluation_result)

if __name__ == '__main__':
    main()
