// Espera a que todo el documento (DOM) esté cargado
$(document).ready(function() {

    // --- PASO 1: Eventos y Elementos Dinámicos ---

    // Efecto simple de "fade in" para las secciones en index.php
    // y para las tarjetas de producto/cliente en alta.php
    // Esto cumple con "agregar... elementos dinámicos"
    $('section').fadeIn(1000);
    $('.card').fadeIn(1200);


    // --- PASO 2: Validación del Lado del Cliente ---

    // Usamos la librería jQuery Validate (una "librería conocida")
    // para validar los formularios en alta.php

    // Validación para el formulario de Clientes
    $("#formCliente").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true // Regla específica para formato de email
            },
            telefono: {
                required: true,
                digits: true, // Solo permite dígitos
                minlength: 7,
                maxlength: 10
            }
        },
        messages: {
            nombre: {
                required: "Por favor, ingresa tu nombre completo",
                minlength: "Tu nombre debe tener al menos 3 caracteres"
            },
            email: {
                required: "Por favor, ingresa tu correo electrónico",
                email: "Por favor, ingresa un formato de correo válido"
            },
            telefono: {
                required: "Por favor, ingresa tu número de teléfono",
                digits: "Ingresa solo números",
                minlength: "El teléfono debe tener al menos 7 dígitos",
                maxlength: "El teléfono no debe exceder los 10 dígitos"
            }
        }
    });

    // Validación para el formulario de Productos
    $("#formProducto").validate({
        rules: {
            nombre_prod: {
                required: true
            },
            descripcion: {
                required: false // La descripción es opcional
            },
            precio: {
                required: true,
                number: true, // Debe ser un número
                min: 0.01     // Precio debe ser positivo
            }
        },
        messages: {
            nombre_prod: {
                required: "Por favor, ingresa el nombre del producto"
            },
            precio: {
                required: "Por favor, ingresa un precio",
                number: "Ingresa un valor numérico (ej. 1500.50)",
                min: "El precio debe ser mayor a 0"
            }
        }
    });

});