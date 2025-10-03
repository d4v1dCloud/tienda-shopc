<?php
$host = "localhost";   // o "localhost"
$usuario = "root";
$password = "";         
$base = "tienda";
$puerto = 3307;         

$conn = new mysqli($host, $usuario, $password, $base, $puerto);

// Revisar conexión
if ($conn->connect_error)
{
    die ("Error de conexión: " . $conn->connect_error);
}
//echo "Conexión exitosa";
?>
