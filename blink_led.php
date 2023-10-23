<!DOCTYPE html>
<html>
<head>
    <title>Controle do LED</title>
</head>
<body>
    <h1>Controle do LED</h1>
    <form action="http://192.168.15.93:80/ligar_led" method="GET">
        <input type="submit" value="Ligar LED">
    </form>
    <form action="http://192.168.15.93:80/desligar_led" method="GET">
        <input type="submit" value="Desligar LED">
    </form>
</body>
</html>