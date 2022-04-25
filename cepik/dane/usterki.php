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
	$result = $mysqli->query("SELECT * FROM usterki WHERE $lista_szuk LIKE '%$pola_szuk%' ORDER BY $lista_szuk ASC");
}else{
	if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM usterki WHERE kod_usterki = '$wyrzuc'");
}
$result = $mysqli->query("call selectUsterki");
}
printf("Select returned %d rows.\n", $result->num_rows, '\n');
if($result->num_rows == 0){
	echo "Brak danych";
}
?>
<table>
   <tr>
     <th>Kod usterki</th>
     <th>Opis usterki</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["kod_usterki"]; ?></td>
     <td><?php echo $row["opis_usterki"]; ?></td>
	 <td>
		<form action="usterki.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["kod_usterki"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>
   </tr>
   <?php } ?>
</table>
<form action="usterki.php" method="post">
Szukaj wg: 
<select name="typ_szukania">
<option value="kod_usterki">Kod usterki</option>
<option value="opis_usterki">Opis usterki</option>
</select>
<input type="text" name="pola_szukaj"><br>
<input type="submit">
</form>
<a href="../">Powrót</a>
</body>
</html>