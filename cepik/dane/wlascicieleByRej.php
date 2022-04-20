<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$rej = $_GET['rej'];
$result = $mysqli->query("call selectSamochodAndWlascicielByRej('$rej')");
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
     <td><?php echo $row["imie"]; ?></td>
     <td><?php echo $row["nazwisko"]; ?></td>
     <td><?php echo $row["PESEL"];?></td>
     
     <td><?php echo $row["nr_rejestracyjny"];?></td>
     <td> 
     <form name="pesel" action="osobaByPesel.php" method="GET">
      <!-- Then add a submit value & close your form -->
      <input type="submit" name="pesel" value="<?php echo $row["PESEL"]; ?>" />
      </form>
      </td>
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>