/*
 *  ------------------ [BLE_7] - Connecting to a BLE device as Master -------
 *
 *  Explanation: This examples shows how to connect to other BLE device, using default 
 *  connecting parameters. This device will be the master and the remote device 
 *  will be the slave. A remote attribute is read / written on the slave.
 *
 *  Copyright (C) 2014 Libelium Comunicaciones Distribuidas S.L.
 *  http://www.libelium.com
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 * 
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS ARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 * 
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  Version:		0.1
 *  Design:		David Gascón
 *  Implementation:	Javier Siscart
 */

#include <WaspBLE.h>

// Auxiliary variable
uint8_t aux = 0;
uint16_t flag = 0;

// MAC address of BLE device to find and connect.
char MAC[14] = "b0b448c99d00";

//char attributeData[20] = "att 1.0 written";
unsigned char attributeData[] = {1};

// Variable to count notify events
uint8_t eventCounter = 0;

// Convertisseur température
void sensorTmp007Convert(uint16_t rawAmbTemp, float *tAmb)
{
  const float SCALE_LSB = 0.03125;
  float t;
  int it;
 
  it = (int)((rawAmbTemp) >> 2);
  t = ((float)(it)) * SCALE_LSB;
  *tAmb = t;
}

// Convertisseur intensité lumineuse
float sensorOpt3001Convert(uint16_t rawData)
{
  uint16_t e, m;
 
  m = rawData & 0x0FFF;
  e = (rawData & 0xF000) >> 12;
 
  return m * (0.01 * pow(2.0,e));
}

void setup() 
{  
  USB.println(F("BLE_07 Example"));  

  // 0. Turn BLE module ON
  BLE.ON(SOCKET0);
  
  // 0.1 Turn UART ON
  Utils.setMuxAux1();
  beginSerial(115200,1);
  serialFlush(1);  //clear buffers
  
  delay(500);
}

void loop() 
{

  // 1. Look for a specific device
  USB.println(F("First scan for device"));  
  USB.print("Look for device: ");
  USB.println(MAC);
  if (BLE.scanDevice(MAC) == 1)
  {
    //2. now try to connect with the defined parameters.
    USB.println(F("Device found. Connecting... "));
    aux = BLE.connectDirect(MAC);

    if (aux == 1) 
    {
      USB.print("Connected. connection_handle: ");
      USB.println(BLE.connection_handle, DEC);

      // 3. get RSSI of the link
      USB.print("RSSI:");
      USB.println(BLE.getRSSI(BLE.connection_handle), DEC);


      // 4. Now try to read a remote attribute. 
      // Note 1: Maximum allowed bytes to read from one attempt are 22 bytes, 
      // but the attribute chosen is 20 bytes length.
      // Note 2: On default profile of Waspmote BLE module, handler 32 matches
      // with the characteristic 1.0 of user service 1.
      USB.println(F("Reading attribute.. "));
      BLE.attributeRead(BLE.connection_handle,  3); 


      // 4.1 Print attribute value. First byte of BLE.attributeValue is the length of the value.
      USB.print(F("Attribute Value: "));
      for(uint8_t i = 0; i < BLE.attributeValue[0]; i++)
      {
        USB.printHex(BLE.attributeValue[i+1]);        
      }
      USB.println();
      // Print attribute in ASCII
      USB.print(F("Attribute Value (ASCII): "));
      for(uint8_t i = 0; i < BLE.attributeValue[0]; i++)
      {
        USB.print(BLE.attributeValue[i+1]);        
      }
      USB.println();
      USB.println();
      printNewline(1);
      delay(3000);
      
      /*-----------------------------------*/
      /* CONFIGURATION CAPTEUR TEMPERATURE */
      /*-----------------------------------*/

      attributeData[0] = 1;
      // 5 Now remotely write an attribute with the data defined at the beginning.
      USB.println(F("Writing attribute.. "));
      if (BLE.attributeWrite(BLE.connection_handle,  36, attributeData, 1) == 0)
      {
        USB.println(F("Temperature measurement in progress.."));
      }   

      /* 6. Subscribe to notifications of one characteristic. 
       In this case an attribute with handler 44.
       
       NOTE 1: the client characteristic configuration attribute of 
       this characteristic has the handler 46.
       
       NOTE 2: To subscribe notifications it is necessary to write a '1'
      */
      uint8_t notify_temp[2] = {1,0};
      flag = BLE.attributeWrite(BLE.connection_handle, 34, notify_temp, 2);
      
       if (flag == 0)
      {
        // 7 Read attribute again to demonstrate write operation.
        USB.println(F("Reading attribute.. "));
        BLE.attributeRead(BLE.connection_handle, 33); 
        
        /* 8. Notify subscription successful. Now start a loop till 
         receive 5 notification or timeout is reached (30 seconds). If disconnected, 
         then exit while loop.
         
         NOTE 3: 5 notifications are done by the example BLE_11.
         */
        eventCounter = 0;
        unsigned long previous = millis();
        while (( eventCounter < 5 ) && ( (millis() - previous) < 30000))
        {
          // 8.1 Wait for indicate event. 
          USB.println(F("Waiting events..."));
          flag = BLE.waitEvent(5000);

          if (flag == BLE_EVENT_ATTCLIENT_ATTRIBUTE_VALUE)
          {
            USB.println(F("Notification received."));

            /* attribute value event structure:
             Field:   | Message type | Payload| Msg Class | Method |  Connection |...
             Length:  |       1      |    1   |     1     |    1   |      1      |...
             Example: |      80      |   05   |     04    |   05   |     00      |...
             
             ...| att handle | att type | value |
             ...|     2      |     8    |   n   |
             ...|   2c 00    |     x    |   n   |
             */

            // 8.2 Extract the handler from the received event saved on the buffer BLE.event
            uint16_t handler = ((uint16_t)BLE.event[6] << 8) | BLE.event[5];
            USB.print("attribute with handler ");
            USB.print(handler, DEC);
            USB.println(" has changed. ");

            // 8.3 Print attribute value
            float tAmb;
            uint16_t rawAmbTemp = ((uint16_t)BLE.event[10] << 8) | BLE.event[9];
            sensorTmp007Convert(rawAmbTemp, &tAmb);
            USB.print("Ambiant temperature: ");
            USB.println(tAmb);
            USB.println();
            printString("Temperature: ",1);
            printInteger((int)tAmb,1);
            printNewline(1);

            eventCounter++;
            flag = 0;
          }
          else
          {
            // 8.4 If disconnection event is received, then exit the while loop.
            if (flag == BLE_EVENT_CONNECTION_DISCONNECTED)
            {
              break;
            }
          }

          // Condition to avoid an overflow (DO NOT REMOVE)
          if( millis() < previous ) previous=millis();

        } // end while loop
      }
      else
      {
        USB.println(F("Failed subscribing."));
        USB.println();
      }
      attributeData[0] = 0;
      if (BLE.attributeWrite(BLE.connection_handle,  36, attributeData, 1) != 0)
      {
        USB.println(F("Temperature measurement put to sleep"));
        USB.println();
      }   
      delay(1000);
      
      /*----------------------------------*/
      /* CONFIGURATION CAPTEUR LUMINOSITE */
      /*----------------------------------*/      
      
      flag = 0;
      attributeData[0] = 1;
      // 9 Now remotely write an attribute with the data defined at the beginning.
      USB.println(F("Writing attribute.. "));
      if (BLE.attributeWrite(BLE.connection_handle,  68, attributeData, 1) == 0)
      {
        USB.println(F("Light intensity measurement in progress.."));
      }   

      /* 10. Subscribe to notifications of one characteristic. 
       In this case an attribute with handler 44.
       
       NOTE 1: the client characteristic configuration attribute of 
       this characteristic has the handler 46.
       
       NOTE 2: To subscribe notifications it is necessary to write a '1'
      */
      uint8_t notify_lux[2] = {1,0};
      flag = BLE.attributeWrite(BLE.connection_handle, 66, notify_lux, 2);
      
       if (flag == 0)
      {
        // 11 Read attribute again to demonstrate write operation.
        USB.println(F("Reading attribute.. "));
        BLE.attributeRead(BLE.connection_handle, 65); 
        
        /* 12. Notify subscription successful. Now start a loop till 
         receive 5 notification or timeout is reached (30 seconds). If disconnected, 
         then exit while loop.
         
         NOTE 3: 5 notifications are done by the example BLE_11.
         */
        eventCounter = 0;
        unsigned long previous = millis();
        while (( eventCounter < 5 ) && ( (millis() - previous) < 30000))
        {
          // 12.1 Wait for indicate event. 
          USB.println(F("Waiting events..."));
          flag = BLE.waitEvent(5000);

          if (flag == BLE_EVENT_ATTCLIENT_ATTRIBUTE_VALUE)
          {
            USB.println(F("Notification received."));

            /* attribute value event structure:
             Field:   | Message type | Payload| Msg Class | Method |  Connection |...
             Length:  |       1      |    1   |     1     |    1   |      1      |...
             Example: |      80      |   05   |     04    |   05   |     00      |...
             
             ...| att handle | att type | value |
             ...|     2      |     8    |   n   |
             ...|   2c 00    |     x    |   n   |
             */

            // 12.2 Extract the handler from the received event saved on the buffer BLE.event
            uint16_t handler = ((uint16_t)BLE.event[6] << 8) | BLE.event[5];
            USB.print("attribute with handler ");
            USB.print(handler, DEC);
            USB.println(" has changed. ");

            // 12.3 Print attribute value
            float iLum;
            uint16_t rawData = ((uint16_t)BLE.event[10] << 8) | BLE.event[9];
            iLum = sensorOpt3001Convert(rawData);
            USB.print("Light Intensity: ");
            USB.println(iLum);
            USB.println();
            printString("Luminosity: ",1);
            printInteger((int)iLum,1);
            printNewline(1);

            eventCounter++;
            flag = 0;
          }
          else
          {
            // 12.4 If disconnection event is received, then exit the while loop.
            if (flag == BLE_EVENT_CONNECTION_DISCONNECTED)
            {
              break;
            }
          }

          // Condition to avoid an overflow (DO NOT REMOVE)
          if( millis() < previous ) previous=millis();

        } // end while loop
      }
      else
      {
        USB.println(F("Failed subscribing."));
        USB.println();
      }
      attributeData[0] = 0;
      if (BLE.attributeWrite(BLE.connection_handle,  68, attributeData, 1) != 0)
      {
        USB.println(F("Light intensity measurement put to sleep"));
        USB.println();
      } 
      delay(1000);
      
      // 13. disconnect. Remember that after a disconnection, the slave becomes invisible automatically.
      BLE.disconnect(BLE.connection_handle);
      USB.println(F("Disconnected."));
      printString("done",1);
    }
    else
    {
      USB.println(F("NOT Connected"));  
    }
  }
  else
  {
    USB.println(F("Device not found: "));
  }

  USB.println();
  delay(5000);

}




