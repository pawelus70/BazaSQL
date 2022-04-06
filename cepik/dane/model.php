<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("SELECT * FROM model");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
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

   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>