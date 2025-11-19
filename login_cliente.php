<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso al Catálogo - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>
<body> 
    <header>
        <h1>Acceso a Productos</h1>
        <nav>
            <a href="index.php" class="btn-home">Volver a Inicio</a>
        </nav>
    </header>

    <?php
    if (isset($_GET['error'])) {
        echo "<div class='alerta error' style='max-width: 500px; margin: 20px auto;'>";
        if ($_GET['error'] == 'datos') echo "Usuario o contraseña incorrectos.";
        echo "</div>";
    }
    ?>

    <section style="max-width: 500px; margin: 0 auto;">
        <h2>Iniciar Sesión (Clientes)</h2>
        <form id="formLoginCliente" method="POST" action="procesar_login.php">
            
            <input type="hidden" name="origen" value="cliente">

            <label>Usuario:</label>
            <input type="text" name="username" placeholder="Tu usuario" required>

            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Tu contraseña" required>

            <button type="submit" name="login">Ver Catálogo</button>
        </form>
        
        <div style="text-align: center; margin-top: 15px;">
            <p>¿Eres administrador? <a href="login.php">Entra por aquí</a></p>
        </div>
    </section>
    
    <footer>
        <p>© 2025 ShoPC</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js?v=1.2"></script>
</body>
</html>