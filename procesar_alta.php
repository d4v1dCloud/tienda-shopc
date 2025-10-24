<?php
// 1. Incluimos la conexión
include 'conexion.php';

// 2. Verificamos qué formulario se envió usando el 'name' del botón

// --- PROCESAR ALTA DE CLIENTE ---
if (isset($_POST['guardar_cliente'])) {
    
    // 3. Obtenemos los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // 4. Preparamos la consulta SQL para evitar inyección SQL
    // Asegúrate de que tu tabla 'clientes' tenga las columnas 'nombre', 'email', 'telefono'
    $stmt = $conn->prepare("INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)");
    
    // 5. Asignamos los valores a los placeholders (?)
    // "sss" significa que las 3 variables son de tipo String (cadena)
    $stmt->bind_param("sss", $nombre, $email, $telefono);

    // 6. Ejecutamos la consulta y redirigimos
    if ($stmt->execute()) {
        // Si fue exitoso, redirigimos a 'alta.php' con un mensaje de éxito
        header("Location: alta.php?status=ok_cliente");
    } else {
        // Si falló, redirigimos con un mensaje de error
        header("Location: alta.php?status=err_cliente");
    }
    
    $stmt->close();
} 

// --- PROCESAR ALTA DE PRODUCTO ---
elseif (isset($_POST['guardar_producto'])) {
    
    // 3. Obtenemos los datos
    $nombre_prod = $_POST['nombre_prod'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // 4. Preparamos la consulta
    // Asegúrate de que tu tabla 'productos' tenga las columnas 'nombre', 'descripcion', 'precio'
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
    
    // 5. Asignamos valores
    // "ssd" = String, String, Double (para números con decimales)
    $stmt->bind_param("ssd", $nombre_prod, $descripcion, $precio);

    // 6. Ejecutamos y redirigimos
    if ($stmt->execute()) {
        header("Location: alta.php?status=ok_prod");
    } else {
        header("Location: alta.php?status=err_prod");
    }

    $stmt->close();
} 

// Si alguien intenta acceder a este archivo directamente sin enviar un formulario
else {
    header("Location: alta.php");
}

// Cerramos la conexión
$conn->close();
?>