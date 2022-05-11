<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require '../dane/conn.php';
if(!empty($_POST["imie"])){
	$imie = ($_POST["imie"]);
	$nazwisko = ($_POST["nazwisko"]);
	$pesel = ($_POST["pesel"]);
	$miejscowosc = ($_POST["miejscowosc"]);
	$adres = ($_POST["adres"]);
	$nr_blok = ($_POST["nr_blok"]);
	$kod_pocztowy = ($_POST["kod_pocztowy"]);

	
	if(!($mysqli->query("INSERT INTO osoba VALUES ('$imie' , '$nazwisko' , '$pesel' , '$miejscowosc' , '$adres' , '$nr_blok' , '$kod_pocztowy' )"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo("Dodano pomyślnie");
	}		
}


?>

<form action="formOsoby.php" method="post">
	Dodaj:<br>
	Imię: <input type="text" name="imie" required><br>
	Nazwisko: <input type="text" name="nazwisko" required><br>
	Pesel: <input type="text" name="pesel" required><br>
	Miejscowsoc: <input type="text" name="miejscowosc" required><br>
	Adres: <input type="text" name="adres" required><br>
	nr bloku: <input type="text" name="nr_blok" required><br>
	kod_pocztowy: <input type="text" name="kod_pocztowy" required><br>
	<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>