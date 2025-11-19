<?php
include 'conexion.php';
session_start();

// Protección extra: solo admins pueden procesar registros
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] != 'admin') {
    header("Location: alta.php");
    exit;
}

if (isset($_POST['guardar_usuario'])) {
    
    $instanciaDB = Conexion::obtenerInstancia();
    $conn = $instanciaDB->obtenerConexion();

    $username = $_POST['username'];
    $password_plana = $_POST['password'];
    $rol = $_POST['rol']; // <--- Recibimos el rol seleccionado

    $password_cifrada = password_hash($password_plana, PASSWORD_DEFAULT);

    // Insertamos el rol dinámico
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password_cifrada, $rol);

    if ($stmt->execute()) {
        header("Location: alta.php?status=ok_user_create");
        exit;
    } else {
        header("Location: alta.php?status=err_user_create");
        exit;
    }
    
    $stmt->close();
} else {
    header("Location: registro_admin.php");
}
?>