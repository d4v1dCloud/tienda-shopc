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
    <link rel="stylesheet" href="alta.css">
</head>
<body>
    <header>
        <h1>Panel de Altas</h1>
        <nav>
            <a href="index.php" class="btn-home">Volver a Inicio</a>
        </nav>
    </header>

    <section>
        <h2>Alta de Clientes</h2>
        <form>
            <label>Nombre:</label>
            <input type="text" placeholder="Nombre completo" required>
            
            <label>Email:</label>
            <input type="email" placeholder="ejemplo@correo.com" required>
            
            <label>Teléfono:</label>
            <input type="tel" placeholder="1234567890" required>
            
            <button type="submit">Guardar Cliente</button>
        </form>
    </section>

    <section>
        <h2>Alta de Productos</h2>
        <form>
            <label>Nombre:</label>
            <input type="text" placeholder="Nombre del producto" required>
            
            <label>Descripción:</label>
            <textarea placeholder="Descripción del producto"></textarea>
            
            <label>Precio:</label>
            <input type="number" step="0.01" placeholder="0.00" required>
            
            <button type="submit">Guardar Producto</button>
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
    </footer>
</body>
</html>
