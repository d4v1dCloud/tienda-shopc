<?php
include 'conexion.php'; // conexión a la base de datos

// Consultar productos
$resultadoProductos = $conn->query("SELECT * FROM productos");

// Consultar clientes
$resultadoClientes = $conn->query("SELECT * FROM clientes");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Altas - ShoPC</title>
    <link rel="stylesheet" href="alta.css?v=1.2"> 
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
</head>

<body>
    <header>
        <h1>Panel de Altas</h1>
        <nav>
            <a href="index.php" class="btn-home">Volver a Inicio</a>
        </nav>
    </header>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'ok_cliente') {
            echo "<div class='alerta exito'>Cliente guardado correctamente.</div>";
        }
        if ($_GET['status'] == 'err_cliente') {
            echo "<div class='alerta error'>Error: No se pudo guardar el cliente.</div>";
        }
        if ($_GET['status'] == 'ok_prod') {
            echo "<div class='alerta exito'>Producto guardado correctamente.</div>";
        }
        if ($_GET['status'] == 'err_prod') {
            echo "<div class='alerta error'>Error: No se pudo guardar el producto.</div>";
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
                echo "<h3>" . $fila['nombre'] . "</h3>";
                echo "<p><strong>Email:</strong> " . $fila['email'] . "</p>";
                echo "<p><strong>Teléfono:</strong> " . $fila['telefono'] . "</p>";
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
                echo "<h3>" . $fila['nombre'] . "</h3>";
                echo "<p>" . $fila['descripcion'] . "</p>";
                echo "<p class='precio'>Precio: $" . number_format($fila['precio'], 2) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No hay productos registrados.</p>";
        }

        $conn->close();
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