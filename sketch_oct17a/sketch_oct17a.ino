#include <WiFi.h>
#include <HTTPClient.h>

// Replace with your network credentials
const char* ssid = "Pixel";           // Your Wi-Fi SSID
const char* password = "nsdiie994";       // Your Wi-Fi password

// ThingSpeak settings
const char* server = "api.thingspeak.com";
const char* apiKey = "I2AI4LYZSPWDW5OO"; // Your ThingSpeak API key

// HC-SR04 pins
#define TRIG_PIN 23
#define ECHO_PIN 22

void setup() {
  // Initialize Serial Monitor
  Serial.begin(115200);

  // Configure HC-SR04 pins
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);

  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConnected to WiFi");
}

void loop() {
  // Trigger the ultrasonic sensor
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);

  // Read the echo time
  long duration = pulseIn(ECHO_PIN, HIGH);
  
  // Calculate the distance in centimeters
  long distance = (duration * 0.0343) / 2;

  // Print distance to Serial Monitor
  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");

  // Check if connected to Wi-Fi
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // Construct the URL for ThingSpeak
    String url = String("http://") + server + "/update?api_key=" + apiKey + "&field1=" + String(distance);

    // Make HTTP GET request
    http.begin(url);
    int httpResponseCode = http.GET();

    // Check the response from ThingSpeak
    if (httpResponseCode > 0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
      String response = http.getString();
      Serial.println("Response: " + response);
    } else {
      Serial.print("Error on sending GET request: ");
      Serial.println(httpResponseCode);
    }

    // End the HTTP connection
    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }

  // Wait 15 seconds before the next update (ThingSpeak's rate limit)
  delay(15000);
}
