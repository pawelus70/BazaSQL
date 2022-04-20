<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("call selectUsterki");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
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
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>