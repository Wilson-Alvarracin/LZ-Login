<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    
<?php
// Conexión a la base de datos
include('connection.php');

// Obtener el número total de alumnos en la base de datos
$consulta_total_alumnos = "SELECT COUNT(*) as total FROM tbl_alumnos";
$resultado_total = mysqli_query($conexion, $consulta_total_alumnos);
$total_alumnos = mysqli_fetch_assoc($resultado_total)['total'];

// Obtener el número de página actual
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Calcular el índice de inicio para la consulta
$por_pagina = isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : 10; // Puedes ajustar este número por defecto según tus preferencias
$inicio = ($pagina_actual - 1) * $por_pagina;

// Realizar una consulta SQL para obtener los alumnos de la página actual
$consulta = "SELECT * FROM tbl_alumnos LIMIT $inicio, $por_pagina";
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

// Mostrar el formulario para ajustar el número de alumnos por página
echo "<form method='get' action='paginacion.php'>";
echo "Número de alumnos por página: <input type='number' name='cantidad' value='$por_pagina'>";
echo "<input type='submit' value='Actualizar'>";
echo "</form>";

// Mostrar enlaces de paginación
echo "<div class='paginacion'>";
for ($i = 1; $i <= ceil($total_alumnos / $por_pagina); $i++) {
    echo "<a href='paginacion.php?pagina=$i&cantidad=$por_pagina'>$i</a> ";
}
echo "</div>";

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>

</body>
</html>
