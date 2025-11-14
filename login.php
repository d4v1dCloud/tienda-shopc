<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>

<body> 
    <header>
        <h1>Acceso al Panel</h1>
    </header>

    <?php
    if (isset($_GET['error'])) {
        echo "<div class='alerta error' style='max-width: 500px; margin: 20px auto;'>";
        echo "Error: Usuario o contraseña incorrectos.";
        echo "</div>";
    }
    ?>

    <section style="max-width: 500px; margin: 0 auto;">
        <h2>Iniciar Sesión</h2>
        <form id="formLogin" method="POST" action="procesar_login.php">

            <label>Usuario (username):</label>
            <input type="text" name="username" placeholder="Tu usuario admin" required>

            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Tu contraseña" required>

            <button type="submit" name="login">Entrar</button>
        </form>
    </section>
    
    <footer>
        <p>© 2025 ShoPC - Todos los derechos reservados</p>
        <p>
            <a href="https://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px"
                    src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
                    alt="¡CSS Válido!" />
            </a>
        </p>
        <p>
            <a href="https://validator.w3.org/nu/#textarea">
                <img style="border:0;width:88px;height:31px"
                    src="https://www.w3.org/Icons/valid-html401"
                    alt="¡HTML Válido!" />
            </a>
        </p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js?v=1.2"></script>
</body>
</html>