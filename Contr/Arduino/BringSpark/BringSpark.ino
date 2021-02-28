/*
BringSpark Controller
Author: Bigsk(https://xiaxinzhe.cn)
Date: 2021.2.28 17:11
Copyright GHINK Network Stduio
*/

#include <SPI.h>
#include <Ethernet2.h>
#include <Servo.h>

byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(192, 168, 1, 3);
EthernetClient client;
IPAddress server(192,168,1,2);//Server IP
Servo myservo1;
Servo myservo2;

int pos = 0;
unsigned long lastConnectionTime = 0;
const unsigned long postingInterval = 10L * 10L;

void setup() {
  Serial.begin(9600);
  Ethernet.begin(mac, ip);
  myservo1.attach(6);
  myservo2.attach(5);
}

void loop() {
  if (client.available()) {
    int c = client.read();
    if(c < 1000){
      Serial.print("From 1:");
      Serial.println(c);
      myservo1.write(c);
    }else if(1000 < c < 2000){
      Serial.print("From 2:");
      Serial.println(c);
      myservo2.write(c);
    }
  }
  if (millis() - lastConnectionTime > postingInterval) {
    httpRequest();
  }
}

void httpRequest() {
  client.stop();

  if (client.connect(server, 8000)) {//Server Port
    client.println();

    lastConnectionTime = millis();
  }
}
