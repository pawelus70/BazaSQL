<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("call selectWlasciciel");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
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
     <td><?php echo $row["typ"]; ?></td>
     <td><?php echo $row["pesel_osoby"];?></td>
     <td><button type="button">Właściciel</button></td>
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>