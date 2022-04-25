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
	$result = $mysqli->query("SELECT * FROM badania WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$wyrzuc2 = $_POST["kosz2"];
	$mysqli->query("DELETE FROM badania WHERE vin_pojazdu = '$wyrzuc' AND data_ost_badania = '$wyrzuc2'");
}
$result = $mysqli->query("call selectBadania");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>VIN</th>
     <th>Data ważności</th>
     <th>Data ostatniego badania</th>
     <th>Kod usterki</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["vin_pojazdu"]; ?></td>
     <td><?php echo $row["data_waznosci_badania"]; ?></td>
     <td><?php echo $row["data_ost_badania"];?></td>
     <td><?php echo $row["kod_usterki"];?></td>
	 <td>
		<form action="badania.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["vin_pojazdu"]; ?>">
		<input type="hidden" name="kosz2" value="<?php echo $row["data_ost_badania"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="badania.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="vin_pojazdu">VIN</option>
<option value="data_waznosci_badania">Ważności badania</option>
<option value="data_ost_badania">Ostatniego badania</option>
<option value="kod_usterki">Kodu usterki</option>

</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>