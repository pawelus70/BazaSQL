<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
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

   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>