<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require '../dane/conn.php';
if(!empty($_POST["VIN"])){
	$vin = ($_POST["VIN"]);
	$od = ($_POST["od"]);
	$do = ($_POST["do"]);
	$usterka = ($_POST["usterka"]);
	
	if(!($mysqli->query("INSERT INTO badania VALUES ('$vin' , '$od' , '$do','$usterka' )"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo("Dodano pomyślnie");
	}		
}
$result = $mysqli->query("SELECT VIN FROM `samochod`;");
$result2 = $mysqli->query("SELECT * FROM `usterki`");

?>

<form action="formBadania.php" method="post">
Dodaj:<br>
VIN pojazdu: <select name="VIN">
		<?php while ($row = $result->fetch_assoc()) { ?>
		<option value="<?php echo $row["VIN"];?>"><?php echo $row["VIN"];?>
		</option>
		<?php } ?>
		</select><br>
Data badania: <input type="date" id="od" name="od"
       > 
	   Ważność badania: <input type="date" id="do" name="do"
      > 
usterka: <select name="usterka">
		<?php while ($row = $result2->fetch_assoc()) { ?>
		<option value="<?php echo $row["kod_usterki"];?>">
		<?php echo $row["opis_usterki"];?>
		</option>
		<?php } ?>
		</select><br>

<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>