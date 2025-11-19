<?php
// 1. Incluir conexión
include 'conexion.php'; // Asegúrate que este sea el nombre correcto

// 2. Verificar que recibimos un ID por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: alta.php?status=err_no_id");
    exit;
}

$id_usuario = $_GET['id'];

// 3. Obtener la conexión
$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();

// 4. Preparar y ejecutar la consulta para OBTENER los datos del usuario
$stmt = $conn->prepare("SELECT username, rol FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();

// 5. Verificar si el usuario existe
if ($resultado->num_rows == 1) {
    $usuario = $resultado->fetch_assoc();
    $username_actual = $usuario['username'];
    $rol_actual = $usuario['rol'];
} else {
    // Si el ID no existe, regresamos
    header("Location: alta.php?status=err_user_not_found");
    exit;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>
<body>
    <header>
        <h1>Modificar Usuario</h1>
        <nav>
            <a href="alta.php" class="btn-home">Volver al Panel</a>
        </nav>
    </header>

    <section>
        <h2>Editando a: <?php echo htmlspecialchars($username_actual); ?></h2>

        <form id="formModificarUsuario" method="POST" action="procesar_modificacion_usuario.php">

            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <label>Nombre de Usuario (username):</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username_actual); ?>" required>

            <label>Rol:</label>
            <select name="rol" required>
                <option value="admin" <?php if($rol_actual == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="editor" <?php if($rol_actual == 'editor') echo 'selected'; ?>>Editor</option>
                <option value="usuario" <?php if($rol_actual == 'usuario') echo 'selected'; ?>>Usuario</option>
            </select>

            <label>Nueva Contraseña (Opcional):</label>
            <input type="password" name="password" placeholder="Dejar en blanco para no cambiar">

            <button type="submit" name="modificar_usuario">Actualizar Usuario</button>
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