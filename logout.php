<?php
// 1. Siempre se debe iniciar la sesión para poderla destruir
session_start();

// 2. Destruir todas las variables de la sesión
session_unset();

// 3. Finalmente, destruir la sesión
session_destroy();

// 4. Redirigir al usuario a la página de login
header("Location: index.php");
exit;
?>