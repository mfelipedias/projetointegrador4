<?php
// Conecta ao banco de dados
$servername = "univesp.mysql.uhserver.com";
$username = "univesp";
$password = "Pr@jeto4";
$dbname = "univesp";
$resposta = 0;
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
   
    include 'db.php';
    $sql = "SELECT * FROM `dados_sensor` ORDER BY registro DESC LIMIT 1";
    $busca = mysqli_query($db, $sql);

    while ($array = mysqli_fetch_array($busca)) {
        $analiseph = $array['ph'];
        $analisetemperatura = $array['temperatura'];
        $analiseregistro = $array['registro'];
        $analisealimento = $array['alimento'];
        }
        $hora=intval(date('G', strtotime($analiseregistro)));
        $minuto = intval(date('i', strtotime($analiseregistro)));
        $segundo = intval(date('s', strtotime($analiseregistro)));
        echo $resposta=$hora.$minuto.$segundo;
        
        } else {
            echo 0;
        }
$conn->close();
?>