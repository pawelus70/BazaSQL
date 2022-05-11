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
	$result = $mysqli->query("SELECT * FROM typ_wlasciciela WHERE $lista_szuk LIKE '$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM typ_wlasciciela WHERE pesel_osoby = '$wyrzuc'");
}
$result = $mysqli->query("call selectWlasciciel");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>VIN</th>
     <th>Typ</th>
     <th>PESEL</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["vin_pojazdu"]; ?></td>
     <td>
     <form action="samochod.php" method="GET">
      <input type="hidden" name="pola_szukaj" value="VIN" />
      <input type="hidden" name="typ_szukania" value="<?php echo $row["vin_pojazdu"]?>" />
      <input type="submit" value="Szczegóły">
      </form>
   </td>
     <td><?php echo $row["typ"]; ?></td>
     <td><?php echo $row["pesel_osoby"];?></td>
     <td>
     <form action="osoba.php" method="GET">
      <input type="hidden" name="pola_szukaj" value="<?php echo $row["pesel_osoby"]; ?>" />
      <input type="hidden" name="typ_szukania" value="PESEL" />
      <input type="submit" value="Szczegóły">
      </form>
    </td>
	 <td>
		<form action="wlasciciele.php" method="POST">
      <input type="hidden" name="kosz" value="<?php echo $row["pesel_osoby"]; ?>">
      <input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="wlasciciele.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="vin_pojazdu">VIN</option>
<option value="pesel_osoby">PESEL</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>