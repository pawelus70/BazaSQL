<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
if(!empty($_POST["kosz"])){
	$wyrzuc = $_POST["kosz"];
	$mysqli->query("DELETE FROM marka WHERE nazwa_marki = '$wyrzuc'");
}
$result = $mysqli->query("call selectMarka");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
?>
<table>
   <tr>
     <th>Marka</th>

   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["nazwa_marki"]; ?></td>
	 <td>
		<form action="marka.php" method="POST">
		<input type="hidden" name="kosz" value="<?php echo $row["nazwa_marki"]; ?>">
		<input type="submit" value="usuń">
		</form>
	 </td>

   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>