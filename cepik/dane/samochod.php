<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("call selectSamochod");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
?>
<table>
   <tr>
     <th>Nr rejestracji</th>
     <th>VIN</th>
     <th>Pojemność</th>
     <th>Data pierwszej rejestracji</th>
     <th>Kategoria</th>
     <th>Model</th>
     <th>Kolor</th>
     <th>Data ważności badania</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["nr_rejestracyjny"]; ?></td>
     <td><?php echo $row["VIN"]; ?></td>
     <td><?php echo $row["pojemnosc"];?></td>
     <td><?php echo $row["data_pierwszej_rejestracji"];?></td>
     <td><?php echo $row["kategoria"];?></td>
     <td><?php echo $row["model"];?></td>
     <td><?php echo $row["kolor"];?></td>
     <td><?php echo $row["data_waznosci_badania"];?></td>
     <td> 
     <form name="rej" action="wlascicieleByRej.php" method="GET">
      <!-- Then add a submit value & close your form -->
      <input type="submit" name="rej" value="<?php echo $row["nr_rejestracyjny"]; ?>" />
      </form>
      </td>
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>