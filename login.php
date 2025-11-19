<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Administrativo - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>
<body> 
    <header>
        <h1>Panel Administrativo</h1>
        <nav>
            <a href="index.php" class="btn-home">Volver a Inicio</a>
        </nav>
    </header>

    <?php
    if (isset($_GET['error'])) {
        echo "<div class='alerta error' style='max-width: 500px; margin: 20px auto;'>";
        if ($_GET['error'] == 'datos') echo "Usuario o contraseña incorrectos.";
        if ($_GET['error'] == 'permisos') echo "ACCESO DENEGADO: Esta zona es solo para Administradores.";
        echo "</div>";
    }
    ?>

    <section style="max-width: 500px; margin: 0 auto;">
        <h2>Solo Personal Autorizado</h2>
        <form id="formLoginAdmin" method="POST" action="procesar_login.php">

            <input type="hidden" name="origen" value="admin">

            <label>Usuario Admin:</label>
            <input type="text" name="username" placeholder="Usuario administrador" required>

            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit" name="login">Entrar al Panel</button>
        </form>

        <div style="text-align: center; margin-top: 15px;">
            <p>¿Eres cliente? <a href="login_cliente.php">Entra al catálogo aquí</a></p>
        </div>
    </section>
    
    <footer>
        <p>© 2025 ShoPC</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js?v=1.2"></script>
</body>
</html>