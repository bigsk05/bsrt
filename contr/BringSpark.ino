/* Sweep
 by BARRAGAN <http://barraganstudio.com>
 This example code is in the public domain.

 modified 8 Nov 2013
 by Scott Fitzgerald
 http://www.arduino.cc/en/Tutorial/Sweep
*/

#include <SPI.h>
#include <Ethernet2.h>
#include <Servo.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(192, 168, 1, 3);
EthernetClient client;
IPAddress server(192,168,1,2);
Servo myservo;  // create servo object to control a servo
// twelve servo objects can be created on most boards

int pos = 0;    // variable to store the servo position
unsigned long lastConnectionTime = 0;             // last time you connected to the server, in milliseconds
const unsigned long postingInterval = 10L * 10L; // delay between updates, in milliseconds

void setup() {
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  myservo.attach(3);  // attaches the servo on pin 9 to the servo object
}

void loop() {
  // if there's incoming data from the net connection.
  // send it out the serial port.  This is for debugging
  // purposes only:
  if (client.available()) {
    int c = client.read();
    Serial.println(c);
    myservo.write(c);
  }
  if (millis() - lastConnectionTime > postingInterval) {
    httpRequest();
  }
}

// this method makes a HTTP connection to the server:
void httpRequest() {
  // close any connection before send a new request.
  // This will free the socket on the WiFi shield
  client.stop();

  // if there's a successful connection:
  if (client.connect(server, 8000)) {
    client.println();

    // note the time that the connection was made:
    lastConnectionTime = millis();
  }
}
