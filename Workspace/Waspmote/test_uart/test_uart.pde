/*  
 *  ------ Waspmote Pro Code Example -------- 
 *  
 *  Explanation: This is the basic Code for Waspmote Pro
 *  
 *  Copyright (C) 2013 Libelium Comunicaciones Distribuidas S.L. 
 *  http://www.libelium.com 
 *  
 *  This program is free software: you can redistribute it and/or modify  
 *  it under the terms of the GNU General Public License as published by  
 *  the Free Software Foundation, either version 3 of the License, or  
 *  (at your option) any later version.  
 *   
 *  This program is distributed in the hope that it will be useful,  
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of  
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the  
 *  GNU General Public License for more details.  
 *   
 *  You should have received a copy of the GNU General Public License  
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.  
 */
 
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

