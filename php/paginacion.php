<?php
// Conexión a la base de datos
$conexion = mysqli_connect("172.24.1.28", "zorrito", "QWEqwe123", "bd_zorritos");

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

if (isset($_POST['cantidad'])) {
    $cantidad = $_POST['cantidad'];

    // Realizar una consulta SQL para obtener los primeros $cantidad alumnos
    $consulta = "SELECT * FROM tbl_alumnos LIMIT $cantidad";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        // Mostrar los datos de los alumnos
        echo "<h2>Lista de Alumnos</h2>";
        echo "<ul>";
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<li>{$fila['nombre']} {$fila['apellidos']} - Nacido el {$fila['fecha_nacimiento']} - Correo: {$fila['correo_electronico']}</li>";
        }
        echo "</ul>";
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
}
?>

<!-- Formulario para ingresar la cantidad de alumnos a mostrar -->
<form method="post" action="">
    <label for="cantidad">Número de alumnos a mostrar:</label>
    <input type="number" name="cantidad" id="cantidad">
    <input type="submit" value="Filtrar">
</form>
