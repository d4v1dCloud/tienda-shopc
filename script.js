$(document).ready(function() {

    // Efecto de Fundido inicial
    $('section').fadeIn(2000);
    $('.card').fadeIn(2000);

    // ===== VALIDACIÓN FORMULARIO PRODUCTO CON AJAX =====
    $("#formProducto").validate({
        rules: {
            nombre_prod: { required: true },
            descripcion: { required: false },
            precio: { required: true, number: true, min: 0.01 }
        },
        messages: {
            nombre_prod: { required: "Por favor, ingresa el nombre del producto" },
            precio: { 
                required: "Por favor, ingresa un precio",
                number: "Ingresa un valor numérico válido",
                min: "El precio debe ser mayor a 0"
            }
        },
        // ESTA ES LA PARTE NUEVA: submitHandler
        submitHandler: function(form) {
            // Serializamos los datos del formulario y agregamos el name del botón
            var datos = $(form).serialize() + "&guardar_producto=true";

            $.ajax({
                url: 'procesar_alta.php',
                type: 'POST',
                data: datos,
                dataType: 'json', // Esperamos JSON de vuelta
                success: function(respuesta) {
                    
                    if (respuesta.status === 'ok') {
                        // 1. Creamos la tarjeta HTML
                        var nuevaCard = `
                            <div class='card' style='display:none; background-color: #d1e7dd;'>
                                <h3>${respuesta.nombre}</h3>
                                <p>${respuesta.descripcion}</p>
                                <p class='precio'>$${respuesta.precio}</p>
                            </div>
                        `;

                        // 2. Si existía el mensaje de "No hay productos", lo quitamos
                        $('#msg-vacio').remove();

                        // 3. Agregamos la tarjeta al principio de la lista y hacemos efecto fade
                        $('#contenedor-productos').prepend(nuevaCard);
                        $('#contenedor-productos .card:first').fadeIn(1000);

                        // 4. Limpiamos el formulario
                        $('#formProducto')[0].reset();

                       
                    } else {
                        alert("Hubo un error al guardar el producto.");
                    }
                },
                error: function() {
                    alert("Error de conexión con el servidor.");
                }
            });
            
            return false; // Evita que el formulario se envíe de forma normal
        }
    });

    // (Si tenías validación de clientes u otros scripts, van aquí abajo)
});