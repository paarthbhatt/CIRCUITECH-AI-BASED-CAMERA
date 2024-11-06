document.addEventListener('DOMContentLoaded', () => {
    startCameraFeed();
    fetchSensorData();
    setInterval(fetchSensorData, 5000); // Fetch data every 5 seconds
});

function startCameraFeed() {
    const video = document.getElementById('video');

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
                video.play();
            })
            .catch(error => {
                console.error('Error accessing webcam:', error);
            });
    } else {
        console.error('getUserMedia not supported on your browser!');
    }
}

function fetchSensorData() {
    fetch('/get-sensor-data')
        .then(response => response.json())
        .then(data => {
            const sensorDataDiv = document.getElementById('sensor-data');
            sensorDataDiv.innerHTML = '<h2>Sensor Data</h2>';
            data.forEach((value, index) => {
                sensorDataDiv.innerHTML += `<p>Data Point ${index + 1}: ${value}</p>`;
            });
        })
        .catch(error => console.error('Error fetching sensor data:', error));
}

document.getElementById('scroll-to-top').addEventListener('click', function() {
    window.scrollTo(0, 0);
  });