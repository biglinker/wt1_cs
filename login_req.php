<?php
// Wie heisst meine Datei?
//echo $_SERVER['SCRIPT_NAME'];
//echo $_SERVER['HTTP_HOST'];
$fwd_file = $_SERVER['SCRIPT_NAME'];

IF( !isset($_SESSION['B_id']) ) {
	header("Location: login.php?fwd=$fwd_file");
	exit();
	
}

?>