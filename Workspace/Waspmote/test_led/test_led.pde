#include <WaspBLE.h>

const int ledCount = 11;

int ledPins[] = {
  ANA1, ANA2, ANA3, ANA4, ANA5, ANA6, DIGITAL1, 
  DIGITAL2, DIGITAL3, DIGITAL4 };
  
void setup() 
{
  PWR.setSensorPower(SENS_3V3,SENS_ON);
  for (int thisLed = 0; thisLed < ledCount; thisLed++) {
    pinMode(ledPins[thisLed], OUTPUT);
  }
  pinMode(ANA0, OUTPUT);
  digitalWrite(ANA0, HIGH);
}

void loop() 
{
  for (int thisLed = 0; thisLed < ledCount; thisLed++) {
    digitalWrite(ledPins[thisLed], HIGH);
  }
  delay(1000);
  for (int thisLed = 0; thisLed < ledCount; thisLed++) {
    digitalWrite(ledPins[thisLed], LOW);
  }
  delay(1000);
}




