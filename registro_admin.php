<?php
// 1. PROTECCIÓN DE SEGURIDAD
session_start();

// Si no está logueado O si el rol NO es 'admin', lo sacamos fuera
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] != 'admin') {
    header("Location: alta.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>
<body>
    <header>
        <h1>Registrar Nuevo Usuario</h1>
        <nav>
            <a href="alta.php" class="btn-home">Volver al Panel</a>
        </nav>
    </header>

    <section>
        <h2>Datos del Nuevo Usuario</h2>
        <form id="formUsuario" method="POST" action="procesar_registro.php">
            
            <label>Nombre de Usuario (username):</label>
            <input type="text" name="username" placeholder="Ej: juan_perez" required>
            
            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Contraseña segura" required>

            <label>Rol / Permisos:</label>
            <select name="rol" required>
                <option value="usuario">Usuario (Cliente) - Solo lectura</option>
                <option value="admin">Administrador - Control total</option>
            </select>
            
            <button type="submit" name="guardar_usuario">Registrar Usuario</button>
        </form>
    </section>
    
    <footer>
        <p>© 2025 ShoPC - Todos los derechos reservados</p>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js?v=1.2"></script>
</body>
</html>