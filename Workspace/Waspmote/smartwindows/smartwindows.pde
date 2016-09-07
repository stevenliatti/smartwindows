#include <WaspBLE.h>

// Nombre de leds du bargraph
const int ledCount = 10;

// Tableau contenant les pins utilisées par le bargraph
int ledPins[] = {
  ANA2, ANA3, ANA4, ANA5, ANA6, DIGITAL1, 
  DIGITAL2, DIGITAL3, DIGITAL4, DIGITAL5 };

// Auxiliary variable
uint8_t aux_in = 0;
uint8_t aux_out = 0;
uint16_t flag = 0;

// MAC address of BLE device to find and connect.
char MAC_in[14] = "b0b448c99d00";
char MAC_out[14] = "b0b448c99803";

//char attributeData[20] = "att 1.0 written";
unsigned char attributeData[] = {1};

// Variable to count notify events
uint8_t eventCounter = 0;

// Valeur envoyée au wifly
char outstr[15];

// Nombre de notifications
int nb_notif = 1;

// Variables contenant les données
float iLum = 0;
float TI = 0;
float TE = 0;
int windLevel = 0;

// Variable d'état des périphériques
int windowState = 0; // état de la fenetre
int storeState = 0; // état du store

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
  USB.println(F("SmartWindows"));  

  // 0. Turn BLE module ON
  BLE.ON(SOCKET0);
  
  // 0.1 Turn UART ON
  Utils.setMuxAux1();
  beginSerial(115200,1);
  serialFlush(1);  //clear buffers
  
  // 0.2 Initialisation des pins de sortie
  PWR.setSensorPower(SENS_3V3,SENS_ON);
  pinMode(ANA1, OUTPUT);
  digitalWrite(ANA1, HIGH); // Inversion des poles -> HIGH = led éteinte
  for (int thisLed = 0; thisLed < ledCount; thisLed++) {
    pinMode(ledPins[thisLed], OUTPUT);
  }
  for (int thisLed = 0; thisLed < ledCount; thisLed++) {
    digitalWrite(ledPins[thisLed], HIGH); // Inversion des poles -> HIGH = led éteinte
  }
}

void loop() 
{

  /*-----------------------------------*/
  /*--        CAPTEUR INTERIEUR      --*/
  /*-----------------------------------*/
  
  // 1. Look for a specific device
  USB.println(F("First scan for intern device"));  
  USB.print("Look for intern device: ");
  USB.println(MAC_in);
  if (BLE.scanDevice(MAC_in) == 1)
  {
    //2. now try to connect with the defined parameters.
    USB.println(F("Intern device found. Connecting... "));
    aux_in = BLE.connectDirect(MAC_in);

    if (aux_in == 1) 
    {
      USB.print("Connected. connection_handle: ");
      USB.println(BLE.connection_handle, DEC);

      // 3. get RSSI of the link
      USB.print("RSSI:");
      USB.println(BLE.getRSSI(BLE.connection_handle), DEC);


      // 4. Read a remote attribute
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
      
      /*-----------------------------------*/
      /* CONFIGURATION CAPTEUR TEMPERATURE */
      /*-----------------------------------*/

      attributeData[0] = 1;
      // 5 Now remotely write an attribute with the data defined at the beginning.
      USB.println(F("Writing attribute.. "));
      if (BLE.attributeWrite(BLE.connection_handle,  36, attributeData, 1) == 0)
      {
        USB.println(F("Intern Temperature measurement in progress.."));
      }   

      // 6. Subscribe to notifications of one characteristic. 
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
         */
        eventCounter = 0;
        unsigned long previous = millis();
        TI = 0;
        float sum_TI = 0;
        while (( eventCounter < nb_notif ) && ( (millis() - previous) < 30000))
        {
          // 8.1 Wait for indicate event. 
          USB.println(F("Waiting events..."));
          flag = BLE.waitEvent(5000);

          if (flag == BLE_EVENT_ATTCLIENT_ATTRIBUTE_VALUE)
          {
            USB.println(F("Notification received."));

            // 8.2 Extract the handler from the received event saved on the buffer BLE.event
            uint16_t handler = ((uint16_t)BLE.event[6] << 8) | BLE.event[5];
            USB.print("attribute with handler ");
            USB.print(handler, DEC);
            USB.println(" has changed. ");

            // 8.3 Print attribute value
            uint16_t rawAmbTemp = ((uint16_t)BLE.event[10] << 8) | BLE.event[9];
            sensorTmp007Convert(rawAmbTemp, &TI);
            USB.print("Intern temperature: ");
            USB.println(TI);
            USB.println();
            sum_TI = sum_TI + TI;
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
        
        // Calcul de la moyenne des températures
        TI = sum_TI / eventCounter;
        
        // Envoi des données sur le wifly
        dtostrf(TI,0, 2, outstr);
        printString(outstr,1);
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
      
      /*----------------------------------*/
      /* CONFIGURATION CAPTEUR LUMINOSITE */
      /*----------------------------------*/      
      
      attributeData[0] = 1;
      
      // 9 Now remotely write an attribute with the data defined at the beginning.
      USB.println(F("Writing attribute.. "));
      if (BLE.attributeWrite(BLE.connection_handle,  68, attributeData, 1) == 0)
      {
        USB.println(F("Light intensity measurement in progress.."));
      }   

      // 10. Subscribe to notifications of one characteristic. 
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
         */
         
        eventCounter = 0;
        unsigned long previous = millis();
        iLum = 0;
        float sum_L = 0;
        while (( eventCounter < nb_notif ) && ( (millis() - previous) < 30000))
        {
          // 12.1 Wait for indicate event. 
          USB.println(F("Waiting events..."));
          flag = BLE.waitEvent(5000);

          if (flag == BLE_EVENT_ATTCLIENT_ATTRIBUTE_VALUE)
          {
            USB.println(F("Notification received."));

            // 12.2 Extract the handler from the received event saved on the buffer BLE.event
            uint16_t handler = ((uint16_t)BLE.event[6] << 8) | BLE.event[5];
            USB.print("attribute with handler ");
            USB.print(handler, DEC);
            USB.println(" has changed. ");

            // 12.3 Print attribute value
            uint16_t rawData = ((uint16_t)BLE.event[10] << 8) | BLE.event[9];
            iLum = sensorOpt3001Convert(rawData);
            USB.print("Light Intensity: ");
            USB.println(iLum);
            USB.println();
            sum_L = sum_L + iLum;
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
        
        // Calcul de la moyenne de luminosité
        iLum = sum_L / eventCounter;
        
        // Envoi des données sur le wifly
        dtostrf(iLum,0, 2, outstr);
        printString(outstr,1);
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
      
      /*-----------------------------------*/
      /*--          DECONNEXION          --*/
      /*-----------------------------------*/
      
      BLE.disconnect(BLE.connection_handle);
      USB.println(F("Intern device disconnected."));
    }
    else
    {
      USB.println(F("NOT Connected"));  
    }
  }
  else
  {
    USB.println(F("Intern device not found: "));
  }
  USB.println();

  /*-----------------------------------*/
  /*--        CAPTEUR EXTERIEUR      --*/
  /*-----------------------------------*/
      
  BLE.ON(SOCKET0);
  // 1. Look for a specific device
  USB.println(F("First scan for extern device"));  
  USB.print("Look for extern device: ");
  USB.println(MAC_out);
  if (BLE.scanDevice(MAC_out) == 1)
  {
    //2. now try to connect with the defined parameters.
    USB.println(F("Extern device found. Connecting... "));
    aux_out = BLE.connectDirect(MAC_out);

    if (aux_out == 1) 
    {
      USB.print("Connected. connection_handle: ");
      USB.println(BLE.connection_handle, DEC);

      // 3. get RSSI of the link
      USB.print("RSSI:");
      USB.println(BLE.getRSSI(BLE.connection_handle), DEC);


      // 4. Read a remote attribute
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
      
      /*-----------------------------------*/
      /* CONFIGURATION CAPTEUR TEMPERATURE */
      /*-----------------------------------*/

      attributeData[0] = 1;
      // 5 Now remotely write an attribute with the data defined at the beginning.
      USB.println(F("Writing attribute.. "));
      if (BLE.attributeWrite(BLE.connection_handle,  36, attributeData, 1) == 0)
      {
        USB.println(F("Extern temperature measurement in progress.."));
      }   

      // 6. Subscribe to notifications of one characteristic. 
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
         */
        eventCounter = 0;
        unsigned long previous = millis();
        TE = 0;
        float sum_TE = 0;
        while (( eventCounter < nb_notif ) && ( (millis() - previous) < 30000))
        {
          // 8.1 Wait for indicate event. 
          USB.println(F("Waiting events..."));
          flag = BLE.waitEvent(5000);

          if (flag == BLE_EVENT_ATTCLIENT_ATTRIBUTE_VALUE)
          {
            USB.println(F("Notification received."));

            // 8.2 Extract the handler from the received event saved on the buffer BLE.event
            uint16_t handler = ((uint16_t)BLE.event[6] << 8) | BLE.event[5];
            USB.print("attribute with handler ");
            USB.print(handler, DEC);
            USB.println(" has changed. ");

            // 8.3 Print attribute value
            uint16_t rawAmbTemp = ((uint16_t)BLE.event[10] << 8) | BLE.event[9];
            sensorTmp007Convert(rawAmbTemp, &TE);
            USB.print("Extern temperature: ");
            USB.println(TE);
            USB.println();
            sum_TE = sum_TE + TE;
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
        
        // Calcul de la moyenne des températures
        TE = sum_TE / eventCounter;
        
        // Envoi des données sur le wifly
        dtostrf(TE,0, 2, outstr);
        printString(outstr,1);
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
      
      /*-----------------------------------*/
      /*--          DECONNEXION          --*/
      /*-----------------------------------*/
      
      BLE.disconnect(BLE.connection_handle);
      USB.println(F("Disconnected."));
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
  
  /*-----------------------------------*/
  /*--      LECTURE DES DONNEES      --*/
  /*-----------------------------------*/
 
  // Convertion des données de vent en m/s
  windLevel = analogRead(ANALOG1); 
  int windSpeed = Utils.map(windLevel, 122, 620, 0, 32);
  // Envoi de la vitesse du vent
  printInteger(windSpeed,1);

  // Ouverture/fermeture de la fenetre automatique
  if (TI >= 25 && windSpeed > 122) {
    digitalWrite(ANA1, LOW);
    windowState = 1;
  }
  else if (TI >= 25 && TI > TE) {
    digitalWrite(ANA1, LOW);
    windowState = 1;
  }
  else {
    digitalWrite(ANA1, HIGH);
    windowState = 0;
  }
  
  // Ouverture/fermeture de la fenetre depuis le web
  while (serialAvailable(1)) {
    uint8_t buff = serialRead(1);
    if (buff == 111) {
      digitalWrite(ANA1,LOW);
      windowState = 1;
    }
    else if (buff == 99) {
      digitalWrite(ANA1,HIGH);
      windowState = 0;
    }
  }
  
  // Envoi de l'état de la fenetre
  printInteger(windowState,1);
  
  // Ouverture/fermeture du volet automatique
  if (iLum < 140 && storeState != 10) {
    storeState++;
  }
  if (iLum > 160 && storeState != 0) {
    storeState--;
  }
  for (int thisLed = 0; thisLed < storeState; thisLed++) {
    if (thisLed < storeState) {
      digitalWrite(ledPins[thisLed], LOW); // Inversion des poles -> LOW = led allumée
    }
    else {
      digitalWrite(ledPins[thisLed], HIGH); // Inversion des poles -> HIGH = led éteinte
    }
  }
  // Envoi de l'état du store
  printInteger(storeState,1);
  
  // Commande d'arret de la reception des données
  printString("DONE",1);
}




