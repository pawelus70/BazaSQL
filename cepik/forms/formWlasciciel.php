<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require '../dane/conn.php';
if(!empty($_POST["VIN"])){
	$vin = ($_POST["VIN"]);
	$typ = ($_POST["typ"]);
	$pesel = ($_POST["typ"]);
	
	if(!($mysqli->query("INSERT INTO typ_wlasciciela VALUES ('$vin' , '$typ' , '$pesel' )"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo("Dodano pomyślnie");
	}		
}
$result = $mysqli->query("SELECT VIN FROM `samochod`;");
$result2 = $mysqli->query("SELECT PESEL FROM `osoba`;");
?>

<form action="formSamochody.php" method="post">
Dodaj:<br>
VIN pojazdu: <select name="VIN">
		<?php while ($row = $result->fetch_assoc()) { ?>
		<option value="<?php echo $row["VIN"];?>"><?php echo $row["VIN"];?>
		</option>
		<?php } ?>
		</select><br>
typ: <select name="typ">
		
		<option value="wlasciciel">wlasciciel</option>
		<option value="wspolwlasciciel">wspolwlasciciel</option>
		</select><br>
Pesel: <select name="pesel">
		<?php while ($row = $result2->fetch_assoc()) { ?>
		<option value="<?php echo $row["PESEL"];?>">
		<?php echo $row["PESEL"];?>
		</option>
		<?php } ?>
		</select><br>

<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>