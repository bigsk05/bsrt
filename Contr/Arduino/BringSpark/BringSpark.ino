/*
  BringSpark Controller
  Author: Bigsk(https://www.xiaxinzhe.cn)
  Date: 2021.4.16 16:58
  Copyright Bigsk(Xinzhe Xia/IanXia)
*/

#include <SPI.h>
#include <Ethernet2.h>
#include <Servo.h>

//Info for the ethernet card
byte mac[] = {
  0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED
};
IPAddress ip(192, 168, 0, 3);

//Define servers and servos
EthernetServer server1(8001),server2(8002);
Servo m1,m2;

void setup() {
  m1.attach(6);
  m2.attach(5);
  //Open serial communications
  Serial.begin(9600);
  //Start the Ethernet connection and the server
  Ethernet.begin(mac, ip);
  server1.begin();
  server2.begin();
  Serial.print("Arduino is at:");
  Serial.println(Ethernet.localIP());
}

void loop() {
  // listen for controller
  EthernetClient client1 = server1.available();
  EthernetClient client2 = server2.available();
  //Code for M1
  if (client1) {
    Serial.println("From M1:");
    while (client1.connected()) {
      if (client1.available()) {
        int c = client1.read();
        Serial.println(c);
        m1.write(c);
      }
    }
    client1.stop();
  }
  //Code for M2
  if (client2) {
    Serial.println("From M2:");
    while (client2.connected()) {
      if (client2.available()) {
        int c = client2.read();
        Serial.println(c);
        m2.write(c);
      }
    }
    client2.stop();
  }
}
