<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
if(!empty($_POST["pola_szukaj"])){
	$pola_szuk = ($_POST["pola_szukaj"]);
	$lista_szuk = ($_POST["typ_szukania"]);
	if($lista_szuk == "przebieg"){
	$result = $mysqli->query("SELECT * FROM przebieg WHERE $lista_szuk BETWEEN $pola_szuk AND (SELECT MAX($lista_szuk) FROM przebieg) ORDER BY $lista_szuk ASC");
	}else{
	$result = $mysqli->query("SELECT * FROM przebieg WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
	}
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM przebieg WHERE vin_pojazdu = '$wyrzuc'");
}
$result = $mysqli->query("call selectPrzebieg");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>VIN</th>
     <th>Przebieg</th>
     <th>Data</th>

   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["vin_pojazdu"]; ?></td>
     <td><?php echo $row["przebieg"]; ?></td>
     <td><?php echo $row["data"];?></td>
	 <td>
		<form action="przebieg.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["vin_pojazdu"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>

   </tr>
   <?php } ?>
</table>
<form action="przebieg.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="vin_pojazdu">VIN</option>
<option value="przebieg">Minimalny przebieg</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>