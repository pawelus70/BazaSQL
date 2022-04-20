<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("call selectHistoria");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
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
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>