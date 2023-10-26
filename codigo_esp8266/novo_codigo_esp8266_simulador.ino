#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <iostream>
#include <string>
#include <sstream>

const char* ssid = "VIVOFIBRA-845D";
const char* password = "EAEAC1845D";
const char* serverName = "http://projetodemo.com/projetointegrador4/conexao.php";
const char* serverAlimento = "http://projetodemo.com/projetointegrador4/registra_alimento.php";
const int ledPin = 2;

void setup() {

  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, HIGH);

  WiFi.begin(ssid, password);
  Serial.begin(115200);
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


  srand((unsigned)time(0));  //para gerar números aleatórios reais.
  const long max_rand = 1000000L;
  double t_maior = 37;
  double t_menor = 22;
  double t_aleatorio = t_menor + (t_maior - t_menor) * (random() % max_rand) / max_rand;

  double ph_maior = 9.00;
  double ph_menor = 5.00;
  double ph_aleatorio = ph_menor + (ph_maior - ph_menor) * (random() % max_rand) / max_rand;

  double temp = t_aleatorio;
  double ph = ph_aleatorio;
  String s_temp = String(temp);
  String s_ph = String(ph);

  String data = "temperatura=" + s_temp + "&ph=" + s_ph;  // Dados a serem inseridos no banco de dados
  int httpResponseCode = http.POST(data);
  String payload = http.getString();
  int hora = payload.toInt();
  http.end();
  if (httpResponseCode > 0) {

    if (hora >= 91010 && hora <= 91014) {
      if (temp > 25 && temp < 37) {
        digitalWrite(ledPin, LOW);
        delay(3000);
        digitalWrite(ledPin, HIGH);
        http.begin(client, serverAlimento);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        String data = "alimento=1";  // Dados a serem inseridos no banco de dados
        int httpResponseCode = http.POST(data);
        http.end();
      } else if (temp > 22 && temp < 25) {
        digitalWrite(ledPin, LOW);
        delay(1500);
        digitalWrite(ledPin, HIGH);
        http.begin(client, serverAlimento);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        String data = "alimento=2";  // Dados a serem inseridos no banco de dados
        int httpResponseCode = http.POST(data);
        http.end();
      } else {
        digitalWrite(ledPin, HIGH);
      }
    } else if (hora >= 161010 && hora <= 161014) {
      if (temp > 25 && temp < 37) {
        digitalWrite(ledPin, LOW);
        delay(3000);
        digitalWrite(ledPin, HIGH);
        http.begin(client, serverAlimento);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        String data = "alimento=1";  // Dados a serem inseridos no banco de dados
        int httpResponseCode = http.POST(data);
        http.end();
      } else if (temp > 22 && temp < 25) {
        digitalWrite(ledPin, LOW);
        delay(1500);
        digitalWrite(ledPin, HIGH);
        http.begin(client, serverAlimento);
        http.addHeader("Content-Type", "application/x-www-form-urlencoded");
        String data = "alimento=2";  // Dados a serem inseridos no banco de dados
        int httpResponseCode = http.POST(data);
        http.end();
      } else {
        digitalWrite(ledPin, HIGH);
      }
    } else {
      digitalWrite(ledPin, HIGH);
    }
    Serial.println("Hora: " + String(hora));
    Serial.print("Resposta do servidor: ");
    Serial.println(httpResponseCode);
    Serial.print("Requisicao:");
    Serial.println(data);
  } else {
    Serial.print("Erro na solicitação: ");
    Serial.println(httpResponseCode);
  }


  delay(5000);
}