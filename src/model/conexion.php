
<?php
$host 	= 'db';
$nom 	= 'root';
$pass 	= 'rootpassword';
$db 	= 'sistema_asistencia_matema';

$conn = mysqli_connect($host, $nom, $pass, $db);
$conn->set_charset("utf8");
date_default_timezone_set("America/La_Paz");

if (!$conn) 
{
  die("Error en la conexión: " . mysqli_connect_error());
}	

?>
