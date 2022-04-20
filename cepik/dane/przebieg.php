<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("call selectPrzebieg");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
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

   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>