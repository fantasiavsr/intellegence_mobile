import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
import joblib
import json

# Membaca data dari JSON
with open('student_validations.json') as file:
    data = json.load(file)

# Ekstrak data
table_data = data[2]['data']
df = pd.DataFrame(table_data)
df = df[df['status'] == 'FAILED']

# Memilih fitur dan target
X = df['testid'].values.reshape(-1, 1)
y = df['report']

# Membagi data menjadi data latih dan data uji
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Membuat model Decision Tree
model = DecisionTreeClassifier()

# Melatih model
model.fit(X_train, y_train)

# Menyimpan model
joblib.dump(model, 'test_report_model2.pkl')
