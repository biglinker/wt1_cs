<?php

//Datenbankverbindung zur Verf??g stellen
include("db_connection.php");


$nr = $_GET['nr'];



	$sql = "SELECT * FROM Nachfrage WHERE N_id = $nr";
	echo $sql;
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	echo "<p>Ausgabe der Datenbank Nachfrage</p>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		var_dump($row);
        echo "<br>";
    }
} else {
    echo "<p>0 results in DB Nachfrage</p>";
}




mysqli_close($conn);
?>
