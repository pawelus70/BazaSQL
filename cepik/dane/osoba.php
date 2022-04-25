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
	$result = $mysqli->query("SELECT * FROM osoba WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM osoba WHERE PESEL = '$wyrzuc'");
}
	$result = $mysqli->query("call selectOsoba");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>Imie</th>
     <th>Nazwisko</th>
     <th>PESEL</th>
     <th>Miejscowość</th>
     <th>Adres</th>
     <th>Nr bloku</th>
     <th>Kod pocztowy</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["imie"]; ?></td>
     <td><?php echo $row["nazwisko"]; ?></td>
     <td><?php echo $row["PESEL"];?></td>
     <td><?php echo $row["miejscowosc"];?></td>
     <td><?php echo $row["adres"];?></td>
     <td><?php echo $row["nr_blok"];?></td>
     <td><?php echo $row["kod_pocztowy"];?></td>
	 <td>
		<form action="osoba.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["PESEL"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="osoba.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="imie">Imie</option>
<option value="nazwisko">Nazwisko</option>
<option value="PESEL">PESEL</option>
<option value="miejscowosc">Miejscowość</option>
<option value="adres">Adres</option>
<option value="nr_blok">Nr. blok</option>
<option value="kod_pocztowy">Kod pocztowy</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>