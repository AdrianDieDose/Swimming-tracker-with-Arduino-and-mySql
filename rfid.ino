#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <ESP8266mDNS.h>
#include <ArduinoOTA.h>
#include "FS.h"



constexpr uint8_t RST_PIN = D3;     // Configurable, see typical pin layout above
constexpr uint8_t SS_PIN = D4;

const uint16_t clientIntervall = 30;
const char* ssid  = "FRITZ!Box 7590";  //hier Netzwerkname eintragen
const char* password = "1223112";  // hier Wlan-Passwort
unsigned long ss = 0;
const uint16_t ajaxIntervall = 5;
uint32_t clientPreviousSs = 0 - clientIntervall;
uint32_t internalVcc = ESP.getVcc();

ADC_MODE(ADC_VCC);
MFRC522 rfid(SS_PIN, RST_PIN);

String ip = "192.168.178.21" // hier die IP des Hosts einfügen
String server = "http://"+ip+"/wlan/";

WiFiClient client;
HTTPClient http;


void setup()
{


  Serial.begin(115200);
  SPI.begin();
  rfid.PCD_Init();
  WiFi.begin(ssid, password);
  Serial.println(WiFi.localIP());


  Serial.print  (__DATE__);
  Serial.print  (F(" "));
  Serial.println(__TIME__);
  char myhostname[8] = {"esp"};

  WiFi.hostname(myhostname);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(F("."));
  }
  Serial.println(F(""));
  Serial.print(F("Connected to "));
  Serial.println(ssid);
  Serial.print(F("IP address: "));
  Serial.println(WiFi.localIP());
  if (MDNS.begin("esp8266")) {
    Serial.println(F("MDNS responder started"));
  }

  


}

void loop()
{

long id;

  if (rfid.PICC_IsNewCardPresent()) { //prüft ob ein Chip in der nähe ist

    //CardID resetten
    
    Serial.println("Chip erkannt");

    rfid.PICC_ReadCardSerial(); //liest den Chip aus

    // Hier wird die ID des Chips in die Variable id geladen
    for (byte i = 0; i < rfid.uid.size; i++) {
      id = ((id + rfid.uid.uidByte[i]) * 10);
    }

    scan(id);
  


    delay(2000);
  }
}


void scan(long id)
{
 Serial.print("ID: ");
 Serial.println(id);
 Serial.println(searchId(id));
 String ergebnis = searchId(id);
if (ergebnis == "true") //fragt ab ob die id schon in der Datenbank vorhanden ist
  {
    update(id);
    Serial.println("Update ausgeführt");
    return; 
  }
  else if(ergebnis == "false")   //wenn id nicht vorhanden wird die Website aufgefordert ein Login-Fenster zu öffnen
  {
    logIn(id);
    Serial.println("Id registriert");

    return;
  }
}








String searchId(long id)  //sucht in der Datenbank nach einer bestimmten id
{


  String url = "search_id.php";
  String serverPath = server + url + "?rfid=" + id;

  http.begin(client, serverPath.c_str());

  int httpResponseCode = http.GET();

  if (httpResponseCode > 0) {
    String payload = http.getString();
    payload.trim();
    return payload;
    }
  else {
    return "false";
  }
  // Free resources
  http.end();

}


boolean logIn(long id)  //sendet den Befehl zum öffnen des Login-Fenster
{


  String url = "write_data.php";
  String serverPath = server + url + "?rfid=" + id;

  http.begin(client, serverPath.c_str());

  int httpResponseCode = http.GET();

  if (httpResponseCode > 0) {
   
    String payload = http.getString();
    if (payload.equals("Done"))
    {
      return true;
    }
    else return false;
  }
  else return false;
  // Free resources
  http.end();

}


boolean update(long id)
{


  String url = "update.php";
  String serverPath = server + url + "?rfid=" + id;


  http.begin(client, serverPath.c_str());

  int httpResponseCode = http.GET();

  if (httpResponseCode > 0)
  {
  
    String payload = http.getString();
    if (payload.equals("Done"))
    {
      return true;
    }
    else return false;
  }
  else return false;
  // Free resources
  http.end();

}
