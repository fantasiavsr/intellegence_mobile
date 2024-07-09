import json
import requests
import joblib

# Membaca file JSON
with open('/path/to/student_validations.json') as file:
    data = json.load(file)

# Mengambil data dari JSON
table_data = data[2]['data']

# Memuat model
model = joblib.load('test_report_model.pkl')

# Endpoint API Laravel
url = 'http://localhost:8000/hasil2'

# Mengirim setiap data testid dan report ke API Laravel
for record in table_data:
    if record['status'] == 'FAILED':

        testid = int(record['testid'])
        report = model.predict([[testid]])[0]

        # Data yang akan dikirim
        data = {
            'testid': testid,
            'report': report
        }

        # Mengirim data ke API Laravel
        response = requests.post(url, json=data)

        # Menampilkan respons dari API
        print(response.json())
