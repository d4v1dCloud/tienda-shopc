<?php
// 1. Incluimos la conexión
include 'conexion.php';

// 2. Iniciamos la sesión
// ¡Esta línea es ESENCIAL para que $_SESSION funcione!
session_start();

if (isset($_POST['login'])) {

    $instanciaDB = Conexion::obtenerInstancia();
    $conn = $instanciaDB->obtenerConexion();

    $username = $_POST['username'];
    $password_plana = $_POST['password']; // La que escribe el usuario

    // 3. Buscamos al usuario en la BD
    $stmt = $conn->prepare("SELECT id, username, password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        // --- Usuario encontrado ---
        $usuario = $resultado->fetch_assoc();
        $password_cifrada_db = $usuario['password']; // La que está en la BD

        // 4. ¡LA MAGIA! Verificamos la contraseña plana contra la cifrada
        if (password_verify($password_plana, $password_cifrada_db)) {

            // --- ¡Contraseña CORRECTA! ---
            // 5. Guardamos los datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_username'] = $usuario['username'];

            // 6. Redirigimos al panel de alta
            header("Location: alta.php");
            exit; // Importante salir después de una redirección

        } else {
            // --- Contraseña INCORRECTA ---
            header("Location: login.php?error=1");
            exit;
        }

    } else {
        // --- Usuario NO encontrado ---
        header("Location: login.php?error=1");
        exit;
    }

} else {
    header("Location: login.php");
    exit;
}
?>