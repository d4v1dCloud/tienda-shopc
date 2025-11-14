<?php
// 1. Incluimos la clase
include 'conexion.php'; 

// 2. Obtenemos la conexión al inicio
$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();

// 3. Verificamos qué formulario se envió

// --- PROCESAR ALTA DE CLIENTE (Versión SIN AJAX) ---
if (isset($_POST['guardar_cliente'])) {
    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $telefono);

    // 3. Ejecutamos y REDIRIGIMOS
    if ($stmt->execute()) {
        header("Location: alta.php?status=ok_cliente");
    } else {
        header("Location: alta.php?status=err_cliente");
    }
    
    $stmt->close();
} 

// --- PROCESAR ALTA DE PRODUCTO ---
elseif (isset($_POST['guardar_producto'])) {
    
    $nombre_prod = $_POST['nombre_prod'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nombre_prod, $descripcion, $precio);

    if ($stmt->execute()) {
        header("Location: alta.php?status=ok_prod");
    } else {
        header("Location: alta.php?status=err_prod");
    }

    $stmt->close();
} 

// Si alguien intenta acceder a este archivo directamente
else {
    header("Location: alta.php");
}
?>