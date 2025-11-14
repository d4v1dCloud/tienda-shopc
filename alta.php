<?php
// 1. Iniciar la sesión
session_start();

// 2. Verificar si el usuario NO ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // 3. Si no ha iniciado sesión, redirigir a login.php
    header("Location: login.php");
    exit; // Detener la ejecución del script
}
?>
<?php
include 'conexion.php'; // 1. Incluimos la clase de conexión

// 2. Obtenemos la instancia y la conexión
$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();

// 3. Las consultas
$resultadoProductos = $conn->query("SELECT * FROM productos");
$resultadoClientes = $conn->query("SELECT * FROM clientes");
$resultadoUsuarios = $conn->query("SELECT id, username, rol FROM usuarios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Altas - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>

<body>
    <header>
        <h1>Panel de Altas</h1>
        <nav>
            <a href="index.php" class="btn-home">Volver a Inicio</a>
            <a href="registro_admin.php" class="btn-home">Registrar Admin</a> 
            <a href="logout.php" class="btn-home">Cerrar Sesión</a>
        </nav>
    </header>

    <?php
    // --- Sección de Alertas ---
    if (isset($_GET['status'])) {
        
        // --- ALERTAS DE CLIENTE RESTAURADAS ---
        if ($_GET['status'] == 'ok_cliente') {
            echo "<div class='alerta exito'>Cliente guardado correctamente.</div>";
        }
        if ($_GET['status'] == 'err_cliente') {
            echo "<div class='alerta error'>Error: No se pudo guardar el cliente.</div>";
        }

        // Productos
        if ($_GET['status'] == 'ok_prod') {
            echo "<div class='alerta exito'>Producto guardado correctamente.</div>";
        }
        if ($_GET['status'] == 'err_prod') {
            echo "<div class='alerta error'>Error: No se pudo guardar el producto.</div>";
        }
        
        // Usuarios (Crear)
        if ($_GET['status'] == 'ok_user_create') {
            echo "<div class='alerta exito'>Usuario administrador creado con éxito.</div>";
        }
        if ($_GET['status'] == 'err_user_create') {
            echo "<div class='alerta error'>Error: No se pudo crear el usuario.</div>";
        }

        // Usuarios (Eliminar)
        if ($_GET['status'] == 'ok_user_delete') {
            echo "<div class='alerta exito'>Usuario eliminado correctamente.</div>";
        }
        if ($_GET['status'] == 'err_user_delete') {
            echo "<div class='alerta error'>Error: No se pudo eliminar el usuario.</div>";
        }
        // Usuarios (Modificar)
        if ($_GET['status'] == 'ok_user_update') {
            echo "<div class='alerta exito'>Usuario actualizado correctamente.</div>";
        }
        if ($_GET['status'] == 'err_user_update') {
            echo "<div class='alerta error'>Error: No se pudo actualizar el usuario.</div>";
        }
         // Errores de modificación
        if ($_GET['status'] == 'err_no_id') {
            echo "<div class='alerta error'>Error: No se especificó un ID de usuario.</div>";
        }
        if ($_GET['status'] == 'err_user_not_found') {
            echo "<div class='alerta error'>Error: Usuario no encontrado.</div>";
        }
    }
    ?>

    <section>
        <h2>Alta de Clientes</h2>
        <form id="formCliente" method="POST" action="procesar_alta.php" novalidate>
            <label>Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre completo">
            
            <label>Email:</label>
            <input type="email" name="email" placeholder="ejemplo@correo.com">
            
            <label>Teléfono:</label>
            <input type="tel" name="telefono" placeholder="1234567890">
            
            <button type="submit" name="guardar_cliente">Guardar Cliente</button>
        </form>
    </section>

    <section>
        <h2>Alta de Productos</h2>
         <form id="formProducto" method="POST" action="procesar_alta.php" novalidate>
            <label>Nombre:</label>
            <input type="text" name="nombre_prod" placeholder="Nombre del producto">
            
            <label>Descripción:</label>
            <textarea name="descripcion" placeholder="Descripción del producto"></textarea>
            
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" placeholder="0.00">
            
            <button type="submit" name="guardar_producto">Guardar Producto</button>
        </form>
    </section>

    <section>
        <h2>Lista de Clientes</h2>
        <?php
        if ($resultadoClientes->num_rows > 0) {
            while($fila = $resultadoClientes->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($fila['nombre']) . "</h3>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($fila['email']) . "</p>";
                echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($fila['telefono']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay clientes registrados.</p>";
        }
        ?>
    </section>

    <section>
        <h2>Lista de Productos</h2>
        <?php
        if ($resultadoProductos->num_rows > 0) {
            while($fila = $resultadoProductos->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($fila['nombre']) . "</h3>";
                echo "<p>" . htmlspecialchars($fila['descripcion']) . "</p>";
                echo "<p class='precio'>Precio: $" . number_format($fila['precio'], 2) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay productos registrados.</p>";
        }
        ?>
    </section>
    
    <section>
        <h2>Lista de Usuarios (Administradores)</h2>
        <?php
        if ($resultadoUsuarios->num_rows > 0) {
            while($fila = $resultadoUsuarios->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>Usuario: " . htmlspecialchars($fila['username']) . "</h3>";
                echo "<p><strong>ID:</strong> " . $fila['id'] . "</p>";
                echo "<p><strong>Rol:</strong> " . htmlspecialchars($fila['rol']) . "</p>";
                
                echo '<a href="modificar_usuario.php?id=' . $fila['id'] . '" class="btn-modificar">Modificar</a>';

                echo '<form method="POST" action="procesar_eliminar_usuario.php" onsubmit="return confirm(\'¿Estás seguro de que quieres eliminar a este usuario?\');" style="display: inline-block;">';
                echo '<input type="hidden" name="id_usuario" value="' . $fila['id'] . '">';
                echo '<button type="submit" name="eliminar_usuario" class="btn-eliminar">Eliminar Usuario</button>';
                echo '</form>';
                echo "</div>";
            }
        } else {
            echo "<p>No hay usuarios administradores registrados.</p>";
        }
        ?>
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

    <script src="script.js?v=1.2"></script>
</body>
</html>