<?php
include 'conexion.php'; 

$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();

// --- PROCESAR ALTA DE PRODUCTO (Vía AJAX) ---
if (isset($_POST['guardar_producto'])) {
    
    // Indicamos que la respuesta será JSON
    header('Content-Type: application/json');

    $nombre_prod = $_POST['nombre_prod'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nombre_prod, $descripcion, $precio);

    if ($stmt->execute()) {
        // Devolvemos éxito y los datos para pintarlos en JS
        echo json_encode([
            'status' => 'ok',
            'nombre' => $nombre_prod,
            'descripcion' => $descripcion,
            'precio' => number_format($precio, 2)
        ]);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Error en BD']);
    }

    $stmt->close();
    exit; // Importante salir para no imprimir nada más
} 

// --- (Si hubiera otros formularios normales, irían aquí) ---
else {
    // Si alguien entra directo
    header("Location: alta.php");
}
?>