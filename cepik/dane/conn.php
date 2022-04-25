<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "root", "", "cepikv3");

if(mysqli_connect_errno()){
echo mysqli_connect_error();
}else{
echo "Połączono!\r\n";
}
?>