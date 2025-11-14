<?php
// 1. Incluimos la conexión (igual que en alta.php)
include 'conexion.php'; 
$instanciaDB = Conexion::obtenerInstancia();
$conn = $instanciaDB->obtenerConexion();

// 2. Hacemos la consulta SOLO de productos
$resultadoProductos = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuestros Productos - ShoPC</title>
    
    <link rel="stylesheet" href="style_profesional.css?v=1.0">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <header>
        <h1>Nuestros Productos</h1>
        <nav>
            <a href="index.php" class="btn-home">Volver a Inicio</a>
        </nav>
    </header>

    <section>
        <h2>Catálogo</h2>
        <?php
        if ($resultadoProductos->num_rows > 0) {
            // Iteramos sobre los productos y los mostramos en tarjetas
            while($fila = $resultadoProductos->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<h3>" . htmlspecialchars($fila['nombre']) . "</h3>";
                echo "<p>" . htmlspecialchars($fila['descripcion']) . "</p>";
                echo "<p class='precio'>Precio: $" . number_format($fila['precio'], 2) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay productos disponibles en este momento.</p>";
        }
        ?>
    </section>
    
    <footer>
        <p>© 2025 ShoPC - Todos los derechos reservados</p>
        <p>
            <a href="httpsjigsaw.w3.org/css-validator/check/referer">
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