# data_processing_functions.py

from collections import defaultdict
import re
import pandas as pd

def extract_and_count_reports(table_data):
    report_counts = defaultdict(int)
    first_occurrence = {}

    for record in table_data:
        testid = int(record['testid'])
        status = record['status']
        report_lines = record['report'].split('\n')

        if status == 'FAILED':
            for line in report_lines:
                match = re.match(r'(\d+)\.\s*(.*)', line.strip())
                if match:
                    number = int(match.group(1))
                    check_part = match.group(2)
                    key = (testid, number)
                    if '-> FAILED' in check_part:
                        if key not in first_occurrence:
                            first_occurrence[key] = line.strip()
                        report_counts[key] += 1
        elif status == 'ERROR':
            error_report = record['report'].strip()
            error_key = (testid, 'ERROR')
            if error_key not in first_occurrence:
                first_occurrence[error_key] = error_report
            report_counts[error_key] += 1
        # Tidak memproses data dengan status 'PASS'

    rows = []
    for key, count in report_counts.items():
        testid, number_or_status = key
        report = first_occurrence[key]
        if isinstance(number_or_status, int):
            rows.append((testid, 'FAILED', report, count))
        elif number_or_status == 'ERROR':
            rows.append((testid, 'ERROR', report, count))

    report_df = pd.DataFrame(rows, columns=['testid', 'status', 'report', 'count'])
    return report_df
