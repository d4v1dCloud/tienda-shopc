<?php
$host = "localhost";
$usuario = "root";
$password = "";
$base = "tienda";

// 1. Lista de puertos a intentar, en orden de prioridad
$puertos = [3307, 3306]; 

$conn = null; // 2. Variable para guardar la conexión exitosa

// 3. Recorremos la lista de puertos
foreach ($puertos as $puerto) {
    // El @ suprime el warning de conexión fallida para manejarlo nosotros
    $conexionTemporal = @new mysqli($host, $usuario, $password, $base, $puerto);

    // 4. Si la conexión tuvo éxito...
    if (!$conexionTemporal->connect_error) {
        $conn = $conexionTemporal; // ...guardamos la conexión...
        break; // ...y salimos del bucle.
    }
}

// 5. Después del bucle, revisamos si logramos conectarnos
if ($conn === null) {
    die ("Error de conexión: No se pudo conectar a la base de datos en ninguno de los puertos probados.");
}

// echo "Conexión exitosa en el puerto: " . $conn->port;
?>