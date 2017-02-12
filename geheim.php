<?php
session_start();
if(!isset($_SESSION['B_id'])) {
 die('Bitte zuerst <a href="login.php">einloggen</a>');
}
 
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['B_id'];
 
echo "Hallo User: ".$userid;
?>