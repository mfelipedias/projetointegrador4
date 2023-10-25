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
$alimento = $_POST['alimento'];
include 'db.php';
$sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC LIMIT 1";
$busca = mysqli_query($db, $sql);

while ($array = mysqli_fetch_array($busca)) {
    $id = $array['id'];
    $analisetemperatura = $array['temperatura'];
    $analiseregistro = $array['registro'];
    $analisealimento = $array['alimento'];
}

$sqlupdate = "UPDATE dados_sensor SET alimento = '$alimento' WHERE id = '$id'";

if ($conn->query($sqlupdate) === TRUE) {
    echo "Registro atualizado com sucesso!";
} else {
    echo "Erro na atualização: " . $conn->error;
}

// Feche a conexão com o banco de dados
$conn->close();
?>
