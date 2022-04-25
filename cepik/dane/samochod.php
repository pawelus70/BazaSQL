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
	$result = $mysqli->query("SELECT * FROM samochod WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM samochod WHERE VIN = '$wyrzuc'");
}
$result = $mysqli->query("call selectSamochod");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>Nr rejestracji</th>
     <th>VIN</th>
     <th>Pojemność</th>
     <th>Data pierwszej rejestracji</th>
     <th>Kategoria</th>
     <th>Model</th>
     <th>Kolor</th>
     <th>Data ważności badania</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["nr_rejestracyjny"]; ?></td>
     <td><?php echo $row["VIN"]; ?></td>
     <td><?php echo $row["pojemnosc"];?></td>
     <td><?php echo $row["data_pierwszej_rejestracji"];?></td>
     <td><?php echo $row["kategoria"];?></td>
     <td><?php echo $row["model"];?></td>
     <td><?php echo $row["kolor"];?></td>
     <td><?php echo $row["data_waznosci_badania"];?></td>
     <td> 
     <form name="rej" action="wlascicieleByRej.php" method="GET">
      <!-- Then add a submit value & close your form -->
      <input type="submit" name="rej" value="<?php echo $row["nr_rejestracyjny"]; ?>" />
      </form>
      </td>
	 <td>
		<form action="samochod.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["VIN"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="samochod.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="nr_rejestracyjny">Nr rejestracyjny</option>
<option value="VIN">VIN</option>
<option value="pojemnosc">Pojemność</option>
<option value="data_pierwszej_rejestracji">Data pierwszej rejestracji</option>
<option value="kategoria">Kategoria</option>
<option value="model">Model</option>
<option value="kolor">Kolor</option>
<option value="data_waznosci_badania">Data ważności badania</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>