#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <iostream>
#include <string>
#include <sstream>

const char* ssid = "";
const char* password = ""; 
const char* serverName = "http://projetodemo.com/projetointegrador4/conexao.php";

int pH_Value; 
float Voltage;
const double VCC = 3.3;             // NodeMCU on board 3.3v vcc
const double R2 = 10000;            // 10k ohm series resistor
const double adc_resolution = 1023; // 10-bit adc

const double A = 0.001129148;   // thermistor equation parameters
const double B = 0.000234125;
const double C = 0.0000000876741; 

void setup() {
  WiFi.begin(ssid, password);
  Serial.begin(115200);
  pinMode(pH_Value, INPUT); 

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Conectando ao WiFi...");
  }
  Serial.println("Conectado ao WiFi");

}

void loop() {
  HTTPClient http;
  WiFiClient client;
  http.begin(client, serverName);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  pH_Value = analogRead(A0); 
  Voltage = pH_Value * (5.0 / 1023.0)+ 2.5;
  delay(3000);

  double Vout, Rth, temperature, adc_value; 

  adc_value = analogRead(A0);
  Vout = (adc_value * VCC) / adc_resolution;
  Rth = (VCC * R2 / Vout) - R2;

  temperature = (1 / (A + (B * log(Rth)) - (C * pow((log(Rth)),3))));   

  temperature = temperature - 273.15 - 72;  
  delay(3000);
  
  String s_temp=String(temperature);
  String s_ph=String(Voltage);

  String data = "temperatura="+ s_temp +"&ph=" + s_ph; 
  int httpResponseCode = http.POST(data);

  if (httpResponseCode > 0) {
    Serial.print("Resposta do servidor: ");
    Serial.println(httpResponseCode);
    Serial.print("Requisicao:");
    Serial.println(data);
  } else {
    Serial.print("Erro na solicitação: ");
    Serial.println(httpResponseCode);
  }

  http.end();
  delay(5000);
}