<?php
// 1. Iniciar sesión
session_start();

// 2. Si no ha iniciado sesión, lo mandamos al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit; 
}

// 3. SEGURIDAD: Si NO es admin, lo expulsamos al catálogo de productos
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] != 'admin') {
    header("Location: productos.php");
    exit;
}

// --- CORRECCIÓN: Definimos la variable para evitar el Warning ---
// Como ya pasamos el filtro de seguridad de arriba, sabemos seguro que es Admin.
$esAdmin = true; 
// ---------------------------------------------------------------

include 'conexion.php'; 
$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();

// Consultas
$resultadoProductos = $conn->query("SELECT * FROM productos");
$resultadoUsuarios = $conn->query("SELECT id, username, rol FROM usuarios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Gestión - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>

<body>
    <header>
        <h1>Panel de Gestión</h1>
        <p>
            Usuario: <strong><?php echo htmlspecialchars($_SESSION['usuario_username']); ?></strong> 
            | Rol: <span style="text-transform: uppercase; font-weight:bold;"><?php echo htmlspecialchars($_SESSION['usuario_rol']); ?></span>
        </p>
        
        <nav>
            <a href="index.php" class="btn-home">Ir a Inicio</a>
            <a href="registro_admin.php" class="btn-home">Registrar Nuevo Usuario/Admin</a> 
            <a href="logout.php" class="btn-home">Cerrar Sesión</a>
        </nav>
    </header>

    <?php
    // --- SECCIÓN DE ALERTAS ---
    // Nota: Con AJAX, las alertas de producto saldrán por JavaScript, 
    // pero dejamos esto aquí por si acaso para usuarios y otros mensajes.
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'ok_user_create') echo "<div class='alerta exito'>Usuario creado con éxito.</div>";
        if ($_GET['status'] == 'err_user_create') echo "<div class='alerta error'>Error al crear usuario.</div>";
        if ($_GET['status'] == 'ok_user_delete') echo "<div class='alerta exito'>Usuario eliminado correctamente.</div>";
        if ($_GET['status'] == 'err_user_delete') echo "<div class='alerta error'>Error al eliminar usuario.</div>";
        if ($_GET['status'] == 'ok_user_update') echo "<div class='alerta exito'>Usuario actualizado correctamente.</div>";
        if ($_GET['status'] == 'err_user_update') echo "<div class='alerta error'>Error al actualizar usuario.</div>";
    }
    ?>

    <?php if ($esAdmin): ?>
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
    <?php endif; ?>

   <section>
        <h2>Catálogo de Productos</h2>
        
        <div id="contenedor-productos">
            <?php
            if ($resultadoProductos->num_rows > 0) {
                while($fila = $resultadoProductos->fetch_assoc()) {
                    echo "<div class='card'>";
                    echo "<h3>" . htmlspecialchars($fila['nombre']) . "</h3>";
                    echo "<p>" . htmlspecialchars($fila['descripcion']) . "</p>";
                    echo "<p class='precio'>$" . number_format($fila['precio'], 2) . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p id='msg-vacio'>No hay productos registrados.</p>";
            }
            ?>
        </div>
    </section>
    
    <section>
        <h2>Usuarios del Sistema</h2>
        <?php
        if ($resultadoUsuarios->num_rows > 0) {
            while($fila = $resultadoUsuarios->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($fila['username']) . "</h3>";
                echo "<p><strong>Rol:</strong> " . htmlspecialchars($fila['rol']) . "</p>";
                
                // BOTONES DE ACCIÓN (Siempre visibles porque solo entran admins)
                if ($esAdmin) {
                    echo '<div style="margin-top:10px;">';
                    
                    echo '<a href="modificar_usuario.php?id=' . $fila['id'] . '" class="btn-modificar">Modificar</a>';

                    echo '<form method="POST" action="procesar_eliminar_usuario.php" onsubmit="return confirm(\'¿Estás seguro de borrar este usuario?\');" style="display: inline-block;">';
                    echo '<input type="hidden" name="id_usuario" value="' . $fila['id'] . '">';
                    echo '<button type="submit" name="eliminar_usuario" class="btn-eliminar">Eliminar</button>';
                    echo '</form>';
                    
                    echo '</div>';
                }
                echo "</div>";
            }
        } else {
            echo "<p>No hay usuarios registrados.</p>";
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

    <script src="script.js?v=2.0"></script>
</body>
</html>