from flask import Flask, render_template, request, jsonify
from pymongo import MongoClient
from datetime import datetime

app = Flask(__name__)

# Connect to MongoDB
client = MongoClient('mongodb://localhost:27017/')
db = client['sensor_data']
sensor_readings = db['sensor_readings']

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/api/readings', methods=['GET'])
def get_readings():
    readings = list(sensor_readings.find({}, {'_id': 0}).sort('timestamp', -1).limit(100))
    return jsonify(readings)

@app.route('/api/readings', methods=['POST'])
def add_reading():
    data = request.get_json()
    if 'value' not in data:
        return jsonify({'error': 'No value provided'}), 400
    
    reading = {
        'value': data['value'],
        'timestamp': datetime.utcnow()
    }
    
    result = sensor_readings.insert_one(reading)
    return jsonify({'_id': str(result.inserted_id)}), 201

if __name__ == '__main__':
    app.run(debug=True)