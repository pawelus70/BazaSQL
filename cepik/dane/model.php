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
	$result = $mysqli->query("SELECT * FROM model WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM model WHERE kod_modelu = '$wyrzuc'");
}
$result = $mysqli->query("call selectModel");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>Kod modelu</th>
     <th>Marka</th>
     <th>Dodatkowe informacje</th>

   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["kod_modelu"]; ?></td>
     <td><?php echo $row["marka"]; ?></td>
     <td><?php echo $row["dodatkowe_informacje"];?></td>
	 <td>
		<form action="model.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["kod_modelu"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="model.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="kod_modelu">Kod modelu</option>
<option value="marka">Marka</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>