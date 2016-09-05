float f_val = 123.6794;
char outstr[15];

void setup() {
  dtostrf(f_val,7, 3, outstr);

  USB.println(outstr);
}

void loop(){
}
