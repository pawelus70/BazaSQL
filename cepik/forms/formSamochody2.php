<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require '../dane/conn.php';
if(!empty($_POST["VIN"])){
	$rej = ($_POST["nr_rejestracyjny"]);
	$vin = ($_POST["VIN"]);
	$poj = ($_POST["pojemnosc"]);
	$pierw = ($_POST["data_pierwszej_rejestracji"]);
	$kat = ($_POST["kategoria"]);
	$mod = ($_POST["model"]);
	$kol = ($_POST["kolor"]);
	$wazn = ($_POST["data_waznosci_badania"]);
	
	if(!($mysqli->query("INSERT INTO samochod VALUES ('$rej' , '$vin' , '$poj' , '$pierw' , '$kat' , '$mod' , '$kol' , '$wazn' )"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo("Dodano pomyślnie");
	}		
}
$result = $mysqli->query("SELECT * FROM `model`");

?>

<form action="formSamochody.php" method="post">
Dodaj:<br>
Numer rejestracyjny: <input type="text" name="nr_rejestracyjny" required><br>
VIN pojazdu: <input type="text" name="VIN" required><br>
Pojemność: <input type="text" name="pojemnosc" required><br>
Data pierwszej rejestracji: <input type="text" name="data_pierwszej_rejestracji" required><br>
Kategoria: <input type="text" name="kategoria" required><br>

Marka Model <select name="model">
		<?php while ($row = $result->fetch_assoc()) { ?>
		<option value="<?php echo $row["kod_modelu"];?>">
		<?php echo $row["marka"];?> <?php echo $row["kod_modelu"];?>
		</option>
		<?php } ?>
		</select><br>
		
		

Kolor: <input type="text" name="kolor" required><br>
Data ważności badania: <input type="text" name="data_waznosci_badania"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>