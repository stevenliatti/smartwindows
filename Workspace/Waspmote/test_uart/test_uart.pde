#include <wire.h>     
#include <WaspUART.h>

// Put your libraries here (#include ...)

void setup() {
    // put your setup code here, to run once:
    beginSerial(115200, 0);
    
    Utils.setMuxAux1();
    beginSerial(115200,1);
    serialFlush(1);  //clear buffers

    
    USB.printf("RDY\n");
    delay(500);
}


void loop() {
   int a = 0x41;   
  char b = 'B';   

  // Sends a string through UART1 
  printString("Example.",1);
  // Sends int a five times.
  for(int i=0; i<5;i++){
    printHex(a,1);
    delay(50);
  }
  delay(1000);

  // Sends char b five times.
  for(int i=0; i<5;i++){
    printByte(b,1);
    delay(50);
  }

  // Check if data is available on RX buffer of UART1 and prints it.
  // (sended from PC through the gateway, to Waspmote)
  USB.println("Received data");
  while(serialAvailable(1))
  {
    USB.println(serialRead(1));
  }
  delay(5000);
}


