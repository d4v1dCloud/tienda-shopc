<?php
session_start();

// Si NO ha iniciado sesión, lo mandamos al login de clientes
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login_cliente.php");
    exit;
}

include 'conexion.php'; 
$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();
$resultadoProductos = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo Exclusivo - ShoPC</title>
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
</head>
<body>
    <header>
        <h1>Catálogo de Productos</h1>
        <p>Hola, <?php echo htmlspecialchars($_SESSION['usuario_username']); ?></p>
        <nav>
            <a href="index.php" class="btn-home">Inicio</a>
            
            <?php if(isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] == 'admin'): ?>
                <a href="alta.php" class="btn-home">Ir a Panel Admin</a>
            <?php endif; ?>
            
            <a href="logout.php" class="btn-home" style="background:#e74c3c;">Salir</a>
        </nav>
    </header>

    <section>
        <h2>Nuestros Productos</h2>
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
            echo "<p>No hay productos disponibles.</p>";
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


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="script.js?v=1.2"></script>
</body>
</html>