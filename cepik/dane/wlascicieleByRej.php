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
     <th>Imię</th>
     <th>Nazwisko</th>
     <th>typ</th>
     <th>PESEL</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["imie"]; ?></td>
     <td><?php echo $row["nazwisko"]; ?></td>
     <td><?php echo $row["typ"]; ?></td>
     <td><?php echo $row["PESEL"];?></td>
     
     <td><?php echo $row["nr_rejestracyjny"];?></td>
     <td> 
     <form action="osoba.php" method="GET">
      <input type="hidden" name="pola_szukaj" value="<?php echo $row["PESEL"]; ?>" />
      <input type="hidden" name="typ_szukania" value="PESEL" />
      <input type="submit" value="Szczegóły">
      </form>
      
      </td>
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>