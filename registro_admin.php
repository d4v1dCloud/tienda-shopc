<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Administradores</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>
<body>
    <header>
        <h1>Registrar Nuevo Administrador</h1>
    </header>

    <section>
        <h2>Alta de Usuario (Admin)</h2>
        <form id="formUsuario" method="POST" action="procesar_registro.php">
            
            <label>Usuario (username):</label>
            <input type="text" name="username" placeholder="admin_user" required>
            
            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Una contraseña segura" required>
            
            <button type="submit" name="guardar_usuario">Guardar Usuario</button>
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