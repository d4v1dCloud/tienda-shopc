<?php
// 1. Incluimos la clase de conexión
include 'conexion.php';

// Verificamos que el formulario se envió
if (isset($_POST['guardar_usuario'])) {
    
    // 2. Obtenemos la conexión
    $instanciaDB = Conexion::obtenerInstancia();
    $conn = $instanciaDB->obtenerConexion();

    // 3. Obtenemos los datos del formulario
    $username = $_POST['username'];
    $password_plana = $_POST['password'];

    // 4. Ciframos la contraseña
    $password_cifrada = password_hash($password_plana, PASSWORD_DEFAULT);

    // 5. Preparamos la consulta
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)");
    
    $rol_default = 'admin';
    
    $stmt->bind_param("sss", $username, $password_cifrada, $rol_default);

    // 6. Ejecutamos y REDIRIGIMOS
    if ($stmt->execute()) {
        // ÉXITO: Redirigir de vuelta con un mensaje
        header("Location: alta.php?status=ok_user_create");
        exit;
    } else {
        // ERROR: Redirigir de vuelta con un mensaje
        header("Location: alta.php?status=err_user_create");
        exit;
    }
    
    $stmt->close();
} else {
    // Si acceden directamente, los regresamos
    header("Location: registro_admin.php");
}
?>