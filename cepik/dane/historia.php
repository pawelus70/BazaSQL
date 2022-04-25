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
	$result = $mysqli->query("SELECT * FROM historia_wlascicieli WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM historia_wlascicieli WHERE vin_pojazdu = '$wyrzuc'");
}
$result = $mysqli->query("call selectHistoria");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>VIN</th>
     <th>PESEL</th>
     <th>Data zmiany</th>

   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["vin_pojazdu"]; ?></td>
     <td><?php echo $row["pesel_wlasciciela"]; ?></td>
     <td><?php echo $row["data_zmiany_wlasciciela"];?></td>
	 <td>
		<form action="historia.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["vin_pojazdu"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="historia.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="vin_pojazdu">VIN</option>
<option value="pesel_wlasciciela">PESEL</option>
<option value="data_zmiany_wlasciciela">Data zmiany właściciela</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>