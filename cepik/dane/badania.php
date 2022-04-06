<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("SELECT * FROM badania");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
?>
<table>
   <tr>
     <th>VIN</th>
     <th>Data ważności</th>
     <th>Data ostatniego badania</th>
     <th>Kod usterki</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["vin_pojazdu"]; ?></td>
     <td><?php echo $row["data_waznosci_badania"]; ?></td>
     <td><?php echo $row["data_ost_badania"];?></td>
     <td><?php echo $row["kod_usterki"];?></td>
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>