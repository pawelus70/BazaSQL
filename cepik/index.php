<html>
<head>
</head>
<body>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "root", "", "cepik");

if(mysqli_connect_errno()){
echo mysqli_connect_error();
}else{
echo "Połączono!\r\n";
}
?>

<a href="dane/osoba.php">osoby</a>
<a href="dane/badania.php">badania</a>
<a href="dane/historia.php">historia</a>
<a href="dane/marka.php">marka</a>
<a href="dane/model.php">model</a>
<a href="dane/przebieg.php">przebieg</a>
<a href="dane/samochod.php">samochod</a>
<a href="dane/usterki.php">usterki</a>
<a href="dane/wlasciciele.php">wlasciciele</a>


</body>
</html>