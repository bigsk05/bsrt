/*
BringSpark Controller
Author: Bigsk(https://xiaxinzhe.cn)
Date: 2021.3.3 15:42
Copyright GHINK Network Studio
*/

#include <SPI.h>
#include <Ethernet2.h>
#include <Servo.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(192, 168, 1, 3);
EthernetClient client1,client2;
IPAddress server(192, 168,  1,  2);//Server IP
Servo myservo1,myservo2;

unsigned long lastConnectionTime1,lastConnectionTime2 = 0;
const unsigned long postingInterval1,postingInterval2 = 10L * 10L;

void setup() {
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  myservo1.attach(6);
  myservo2.attach(5);
}

void loop() {
  if (client1.available()) {
    int c = client1.read();
    Serial.print("From 1:");
    Serial.println(c);
    myservo1.write(c);
  }
  if (client2.available()) {
    int c = client2.read();
    Serial.print("From 2:");
    Serial.println(c);
    myservo2.write(c);
  }
  if (millis() - lastConnectionTime1 > postingInterval1) {
    httpRequest1();
  }
  if (millis() - lastConnectionTime2 > postingInterval2) {
    httpRequest2();
  }
}

void httpRequest1() {
  client1.stop();

  if (client1.connect(server, 8001)) {//Server Port
    client1.println();

    lastConnectionTime1 = millis();
  }
}
void httpRequest2() {
  client2.stop();

  if (client2.connect(server, 8002)) {//Server Port
    client2.println();

    lastConnectionTime2 = millis();
  }
}
