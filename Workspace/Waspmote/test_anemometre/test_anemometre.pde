
int val = 0;

void setup() {
  PWR.setSensorPower(SENS_3V3,SENS_ON);
  pinMode(ANA1, OUTPUT);
  digitalWrite(ANA1, HIGH);
}


void loop() {
  val = analogRead(ANALOG1);
  USB.println(val);
  if (val > 122) {
    digitalWrite(ANA1, LOW);
  }
  else {
    digitalWrite(ANA1, HIGH);
  }
  delay(1000);
}

