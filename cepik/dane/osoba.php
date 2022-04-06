<html>
<head>
<link rel="stylesheet" href="../style.css" type="text/css" />
</head>
<body>

<?php
require 'conn.php';
$result = $mysqli->query("SELECT * FROM osoba");
printf("Select returned %d rows.\n", $result->num_rows, '\n');
?>
<table>
   <tr>
     <th>Imie</th>
     <th>Nazwisko</th>
     <th>PESEL</th>
     <th>Miejscowość</th>
     <th>Adres</th>
     <th>Nr bloku</th>
     <th>Kod pocztowy</th>
   </tr>
   <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
     <td><?php echo $row["imie"]; ?></td>
     <td><?php echo $row["nazwisko"]; ?></td>
     <td><?php echo $row["PESEL"];?></td>
     <td><?php echo $row["miejscowosc"];?></td>
     <td><?php echo $row["adres"];?></td>
     <td><?php echo $row["nr_blok"];?></td>
     <td><?php echo $row["kod_pocztowy"];?></td>
   </tr>
   <?php } ?>
</table>

<a href="../">Powrót</a>
</body>
</html>