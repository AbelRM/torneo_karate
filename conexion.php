<?php
$hostname = "localhost";
//$hostname="192.160.0.75";
$username = "siuuvupi_micox";
$password = "bocasuelta123";
$dbname = "siuuvupi_karate";
// $root = '3306';

$con = mysqli_connect($hostname, $username, $password, $dbname);
mysqli_set_charset($con, 'utf8');
if (!$con) {
  echo "<p>Error de conexion</p>";
} else {
  //echo "Conexion exitosa";
}
// mysqli_close($con);
