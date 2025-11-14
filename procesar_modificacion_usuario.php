<?php
include 'conexion.php'; // Incluimos la clase de conexión

// 1. Verificamos el botón correcto: 'modificar_usuario'
if (isset($_POST['modificar_usuario'])) {
    
    $instanciaDB = Conexion::obtenerInstancia();
    $conn = $instanciaDB->obtenerConexion();
    
    // 2. Obtener datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $username = $_POST['username'];
    $rol = $_POST['rol'];
    $password_plana = $_POST['password']; // Contraseña (puede estar vacía)

    // 3. Lógica para la contraseña
    if (!empty($password_plana)) {
        // --- Si el usuario escribió una nueva contraseña ---
        // La ciframos y preparamos una consulta para ACTUALIZARLA
        $password_cifrada = password_hash($password_plana, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET username = ?, rol = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $rol, $password_cifrada, $id_usuario);
    } else {
        // --- Si el campo de contraseña está vacío ---
        // Preparamos una consulta que NO ACTUALIZA la contraseña
        $stmt = $conn->prepare("UPDATE usuarios SET username = ?, rol = ? WHERE id = ?");
        $stmt->bind_param("ssi", $username, $rol, $id_usuario);
    }

    // 4. Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: alta.php?status=ok_user_update");
    } else {
        header("Location: alta.php?status=err_user_update");
    }
    
    $stmt->close();
    
} else {
    // Si alguien entra directo, lo regresamos
    header("Location: alta.php");
}
?>