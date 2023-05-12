<?php
$servername = "univesp.mysql.uhserver.com";
$username = "univesp";
$password = "Pr@jeto4";
$database = "univesp";

$db= mysqli_connect($servername, $username, $password, $database);

if (!mysqli_set_charset($db, 'utf8')) {
    printf('Error ao usar utf8: %s', mysqli_error($db));
    exit;
}
