<?php
// Incluimos la clase de conexión
include 'conexion.php'; 

// Verificamos que se envió el formulario de eliminación
if (isset($_POST['eliminar_usuario']) && isset($_POST['id_usuario'])) {

    $instanciaDB = Conexion::obtenerInstancia();
    $conn = $instanciaDB->obtenerConexion();

    $id_usuario = $_POST['id_usuario'];

    // Preparamos la consulta DELETE
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");

    // "i" significa que la variable es de tipo Integer (entero)
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        // Éxito: Redirigimos de vuelta a alta.php con un mensaje
        header("Location: alta.php?status=ok_user_delete");
    } else {
        // Error
        header("Location: alta.php?status=err_user_delete");
    }

    $stmt->close();

} else {
    // Si alguien entra directo al archivo, lo regresamos
    header("Location: alta.php");
}
?>