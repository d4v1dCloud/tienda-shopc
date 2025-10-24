<?php
include 'conexion.php'; // conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Tienda de Computadoras</title>
    <link rel="stylesheet" href="estilos.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>
<body>
    <header>
        <h1>Bienvenido a ShoPC</h1>
        <a href="alta.php" class="btn-admin">Panel de Altas</a>
    </header>

    <section>
        <h2>Misión</h2>
        <p>
            En <strong>ShoPC</strong> nuestra misión es ofrecer a cada cliente 
            soluciones tecnológicas confiables y accesibles que impulsen su productividad 
            y mejoren su calidad de vida. Nos esforzamos por brindar un servicio al cliente 
            excepcional, asesoría personalizada y productos de la más alta calidad.
        </p>
    </section>

    <section>
        <h2>Visión</h2>
        <p>
            Ser reconocidos en el mercado nacional como la empresa líder en venta de 
            equipos de cómputo y servicios tecnológicos, destacando por nuestra innovación, 
            compromiso con la satisfacción del cliente y la capacidad de adaptarnos a los 
            constantes cambios del sector tecnológico. Aspiramos a construir relaciones 
            duraderas basadas en la confianza y el valor agregado.
        </p>
    </section>

    <section>
        <h2>Contacto</h2>
        <p><strong>Email:</strong> contacto@Shopc.com</p>
        <p><strong>Teléfono:</strong> 4481663510</p>
        <p><strong>Dirección:</strong> Avenida Tecnológico 1500, 58120 Morelia, Michoacán</p>
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

    <script src="script.js"></script>
</body>
</html>