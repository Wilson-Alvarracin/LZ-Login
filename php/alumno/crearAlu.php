<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="../../javascript/javascript.js"></script>
    <link rel="stylesheet" href="../../css/test.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Crear Alumno</title>
</head>

<body>
<div class="login-card center-mostrar">
    <div class="row custom-form-container container">
    <h2>Rellena los siguientes campos para crear un alumno</h2>
    <form action="./proc_crearAlu.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" required>
        <br>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        <br>
        <label for="correo_electronico">Correo Electrónico:</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>
        <br>
        <button type="submit" class="btn btn-info" name="crear_alumno" value="Crear Alumno">Crear</button>
    </form>
    <?php
    if (isset($_GET['exist'])) {
        echo "Ya existe un alumno con este correo electrónico";
    }
    ?>
    <br>
    <button type="button" class="btn btn-info" onclick="window.location.href='../mostrar.php'">Volver</button>  
    </div>
</div>
</body>
</html>