<?php
/* session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
}
include 'connection.php'; */
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="./javascript/javascript.js"></script>
    <link rel="stylesheet" href="../css/test.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Correo electronico</title>
</head>
<body> -->
    <?php
    //comentario de prueba
    /* if ($_SESSION['user'] == "admin@fje.edu") {
        if (isset($_POST["buscar_nombre"])) {
            // Filtrar por nombre si se ha ingresado un nombre
            $filtroNombre = '%' . $_POST["buscar_nombre"] . '%';
        } else {
            $filtroNombre = null;
        }
        
        if ($filtroNombre) {
            // Consulta SQL con filtro de materia y/o nombre
            $sql = "SELECT a.id_alumno, a.nombre, a.apellidos, a.correo_electronico
                    FROM tbl_alumnos a
                    WHERE 1=1";
            if ($filtroNombre) {
                $sql .= " AND a.nombre LIKE ?";
            }
        
            $stmt = mysqli_prepare($conn, $sql);
        
            if ($filtroNombre) {
                mysqli_stmt_bind_param($stmt, "s", $filtroNombre);
            }
        
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            // Consulta SQL sin filtro (mostrar todos los resultados)
            $sql = "SELECT a.id_alumno, a.nombre, a.apellidos, a.correo_electronico
                    FROM tbl_alumnos a";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        }  */
        ?>
    <!-- <div class="login-card center-mostrar">
    <div class="row custom-form-container container">
        <div class="responsive-img-center">
<form method="post">
    <label for="buscar_nombre">Buscar por Nombre:</label>
    <input type="text" id="buscar_nombre" name="buscar_nombre">
    <button type="submit" name="filtroNombre" value="Filtrar">Filtrar</button>
</form>
<br>
<button type="button" class="btn btn-success" onclick="window.location.href='./alumno/formCorreo.php'">Enviar Correo</button>
<br>
<table class="table">
    <thead class="table-dark">
        <tr>
            <th></th>
            <th class="azul">Nombre</th>
            <th>Apellidos</th>
            <th>Correo</th>
        </tr>
    </thead>
    <tbody> -->
    <?php
    // Recorre los resultados y muestra los datos en la tabla
    /* foreach ($result as $row) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='seleccionados[]' value='" . $row['id_alumno'] . "'></td>";
        echo "<th style='font-size: 14px;'>" . $row['nombre'] ."</th>";
        echo "<td style='font-size: 14px;'>" . $row['apellidos'] ."</td>";
        echo "<td style='font-size: 14px;'>" . $row['correo_electronico'] . "</td>";
        echo "</tr>";

    } */
    ?>
        <!-- </tbody>
    </table>
    <button type="button" class="btn btn-danger" onclick="window.location.href='./mostrar.php'">Volver</button>
        </div>
    </div>
</div> -->

    <?php
    //NO TOCAR
        /* } */
    ?>
<!-- </div>
</body>
</html> -->