<?php
include 'conexion.php';
session_start();

if (isset($_POST['login'])) {

    $instanciaDB = Conexion::obtenerInstancia();
    $conn = $instanciaDB->obtenerConexion();

    $username = $_POST['username'];
    $password_plana = $_POST['password'];
    // Recibimos de qué puerta viene (admin o cliente)
    $origen = $_POST['origen']; 

    $stmt = $conn->prepare("SELECT id, username, password, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();
        
        if (password_verify($password_plana, $usuario['password'])) {
            
            // --- VALIDACIÓN DE ROLES SEGÚN LA PUERTA ---

            // CASO 1: Intentan entrar por LOGIN.PHP (Puerta Admin)
            if ($origen == 'admin') {
                if ($usuario['rol'] == 'admin') {
                    // Es admin y está en la puerta correcta
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_username'] = $usuario['username'];
                    $_SESSION['usuario_rol'] = $usuario['rol'];
                    header("Location: alta.php");
                    exit;
                } else {
                    // Es usuario normal intentando entrar a Admin -> DENEGADO
                    header("Location: login.php?error=permisos");
                    exit;
                }
            }

            // CASO 2: Intentan entrar por LOGIN_CLIENTE.PHP (Puerta Catálogo)
            if ($origen == 'cliente') {
                // Aquí dejamos pasar a TODOS (admins y usuarios)
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_username'] = $usuario['username'];
                $_SESSION['usuario_rol'] = $usuario['rol'];
                header("Location: productos.php");
                exit;
            }

        } else {
            // Contraseña incorrecta
            $destino = ($origen == 'admin') ? "login.php" : "login_cliente.php";
            header("Location: $destino?error=datos");
            exit;
        }
    } else {
        // Usuario no encontrado
        $destino = ($origen == 'admin') ? "login.php" : "login_cliente.php";
        header("Location: $destino?error=datos");
        exit;
    }

} else {
    header("Location: index.php");
    exit;
}
?>