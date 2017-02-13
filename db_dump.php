<?php

//Datenbankverbindung zur Verf??g stellen
include("db_connection.php");



echo "<p>Halli Hallo</p>";

	$sql = "SELECT * FROM Benutzer";
	$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	echo "<p>Ausgabe der Datenbank Benutzer</p>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		var_dump($row);
        echo "<br>";
    }
} else {
    echo "0 results";
}

	$sql = "SELECT * FROM Nachfrage";
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

	$sql = "SELECT * FROM Angebot";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	echo "<p>Ausgabe der Datenbank Angebot</p>";
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		var_dump($row);
        echo "<br>";
    }
} else {
    echo "<p>0 results in DB Angebot</p>";
}


mysqli_close($conn);
?>
