<?php
//Datenbankverbindung zur Verfügung stellen
// Enter MySQL infos
$mysqlHost = 'localhost';
$mysqlUsername = 'agricola';
$mysqlPassword = 'IBZ@Agri@2017@Web';
$mysqlDatabase = 'Agricola';

//Datenbankverbindung aufbauen
$conn = mysqli_connect($mysqlHost, $mysqlUsername, $mysqlPassword, $mysqlDatabase);
if (!$conn) {
    echo 'Cant connect to DB, check the settings in the settings file.';
    exit;
}
mysqli_set_charset($conn,"utf8");

?>
