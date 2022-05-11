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
	$pesel = ($_POST["pesel"]);
	
	if($typ == 'wlasciciel'){
		//Usuń współwłaścicieli
	if(!($mysqli->query("DELETE FROM typ_wlasciciela WHERE typ='wspolwlasciciel' && vin_pojazdu = '$vin'"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo $vin;
		echo $typ;
		echo $pesel;
		if($typ = 'wlasciciel'){
		echo "Tak jest dobrze";
		}
	}
		//Zaktualizuj właściciela
	if(!($mysqli->query("UPDATE typ_wlasciciela SET pesel_osoby = '$pesel' WHERE vin_pojazdu = '$vin'"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo("Usunieto pomyślnie");
	}		
	}else if($typ == 'wspolwlasciciel'){
		//Zaktualizuj współwłaściciela
		if(!($mysqli->query("UPDATE typ_wlasciciela SET pesel_osoby = '$pesel' WHERE vin_pojazdu = '$vin' && typ = '$typ'"))){
		echo("Error description: " . $mysqli -> error);
	}else{
		echo("Zmieniono pomyślnie");
	}	
	}
}
$result = $mysqli->query("SELECT VIN FROM `samochod`;");
$result2 = $mysqli->query("SELECT PESEL FROM `osoba`;");
?>

<form action="formUpdateWlasciciel.php" method="post">
Zaktualizuj:<br>
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