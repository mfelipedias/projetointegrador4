<?php
// Conecta ao banco de dados
$servername = "univesp.mysql.uhserver.com";
$username = "univesp";
$password = "Pr@jeto4";
$dbname = "univesp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa se a conexão está ok
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Insere os dados na tabela 'dados_sensor'
$temperatura = $_POST['temperatura'];
$ph = $_POST['ph'];
$sql = "INSERT INTO dados_sensor (temperatura, ph) VALUES ('$temperatura', '$ph')";
if ($conn->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso";
    http_response_code(100);
} else {
    echo "Erro ao inserir dados: " . $conn->error;
}

$conn->close();
?>