<?php
/* session_start();

if (!isset($_SESSION["user"])) {
    header('Location: ../../index.php');
    exit();
}

include '../connection.php'; */

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../javascript/enviarCorreo.js"></script>
    <title>Enviar Correo Electrónico</title>
</head>
<body>
    <form action="./proc_enviarCorreo.php" method="post">
        <label for="asunto">Asunto:</label>
        <input type="text" name="asunto" id="asunto" placeholder="Añade un asunto..." required>
        <br>
        <label for="mensaje">Cuerpo del correo:</label>
        <textarea name="mensaje" id="mensaje" placeholder="Añade un mensaje..." rows="4" required></textarea>
        <br>
        //Campo oculto para almacenar los checkboxes seleccionados
        <input type="hidden" name="alumnos_seleccionados" id="alumnos_seleccionados" value="">
        <input type="submit" value="Enviar Correo" onclick="prepararEnvio()">
    </form>
</body>
</html> -->

<?php
// Verificar si se ha hecho clic en el botón "Enviar Correo"
/* if (isset($_POST['alumnos_seleccionados'])) {
    // Obtener los IDs de los alumnos seleccionados
    $alumnosSeleccionados = explode(',', $_POST['alumnos_seleccionados']);

    // Verificar si al menos un checkbox está seleccionado
    if (empty($alumnosSeleccionados)) {
        // No hay checkboxes seleccionados, redirigir a la página de la tabla
        header('Location: ../correo.php');
        exit();
    }
    
    // Después de procesar el envío, puedes redirigir a la página de la tabla
    header('Location: ../correo.php');
    exit();
} else {
    // Si no se ha hecho clic en el botón "Enviar Correo", redirigir a la página de la tabla
    header('Location: ../correo.php');
    exit();
} */
?>
