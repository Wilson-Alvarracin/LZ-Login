<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ./cerrar.php');
}
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="./javascript/javascript.js"></script>
    <link rel="stylesheet" href="../css/test.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Alumno</title>
</head>
<body>
    <?php
    if ($_SESSION['user'] == "admin@fje.edu") {
        if (isset($_POST["materia"]) && $_POST["materia"] != "Todo") {
            // Filtrar por materia si se ha seleccionado una
            $filtroMateria = $_POST["materia"];
        } else {
            $filtroMateria = null;
        }
        if (isset($_POST["buscar_nombre"])) {
            // Filtrar por nombre si se ha ingresado un nombre
            $filtroNombre = '%' . $_POST["buscar_nombre"] . '%';
        } else {
            $filtroNombre = null;
        }
        if ($filtroMateria || $filtroNombre) {
            // Consulta SQL con filtro de materia y/o nombre
            $sql = "SELECT a.id_alumno, a.nombre, a.apellidos, n.materia, n.nota
                    FROM tbl_alumnos a
                    INNER JOIN tbl_notas n ON a.id_alumno = n.id_alumno
                    WHERE 1=1";
            if ($filtroMateria) {
                $sql .= " AND n.materia = ?";
            }
            if ($filtroNombre) {
                $sql .= " AND a.nombre LIKE ?";
            }
            $stmt = mysqli_prepare($conn, $sql);
            if ($filtroMateria && $filtroNombre) {
                mysqli_stmt_bind_param($stmt, "ss", $filtroMateria, $filtroNombre);
            } elseif ($filtroMateria) {
                mysqli_stmt_bind_param($stmt, "s", $filtroMateria);
            } else {
                mysqli_stmt_bind_param($stmt, "s", $filtroNombre);
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            // Consulta SQL sin filtro (mostrar todos los resultados)
            $sql = "SELECT a.id_alumno, a.nombre, a.apellidos, n.materia, n.nota
                    FROM tbl_alumnos a
                    INNER JOIN tbl_notas n ON a.id_alumno = n.id_alumno";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } 
        ?> 
        <!-- <div class="login-card center"> -->
    <div class="login-card center-mostrar">
    <div class="row custom-form-container container">
        <div class="responsive-img-center">
<form method="post">
    <label for="buscar_nombre">Buscar por Nombre:</label>
    <input type="text" id="buscar_nombre" name="buscar_nombre">
    <label for="materia">Buscar por Materia:</label>
    <select name="materia">
        <option value="Todo">Todo</option>
        <option value="Matemáticas">Matemáticas</option>
        <option value="Historia">Historia</option>
    </select>
    <button type="submit" name="filtro_materia" value="Filtrar">Filtrar</button>
</form>
<!-- Botón de Media -->
<br>
<!--Final-->
<button type="button" class="btn btn-info" onclick="window.location.href='./alumno/crearAlu.php'">Crear Alumno</button> 
<button type="button" class="btn btn-info" onclick="window.location.href='./alumno/media.php'">Media</button>
<br>
<table class="table">
    <thead class="table-dark">
        <tr>
            <th class="azul">Nombre</th>
            <th>Apellidos</th>
            <th>Materia</th>
            <th>Nota</th>
            <th>Modificar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody><?php
    // Recorre los resultados y muestra los datos en la tabla
    foreach ($result as $row) {
        // var_dump($row);
        echo "<tr>";
        echo "<th style='font-size: 14px;'>" . $row['nombre'] ."</th>";
        echo "<td style='font-size: 14px;'>" . $row['apellidos'] ."</td>";
        echo "<td style='font-size: 14px;'>" . $row['materia'] . "</td>";
        echo "<td style='font-size: 14px;'>" . $row['nota'] . "</td>";
        echo '<td> <button type="button" class="btn btn-warning" onclick="window.location.href=\'./alumno/modificar.php?id='.$row['id_alumno'].'&materia='.$row['materia'].'\'">Modificar</button> </td>';        
        echo '<td> <button type="button" class="btn btn-danger" onclick="window.location.href=\'./alumno/eliminar.php?id=' . $row['id_alumno'] . '&materia=' . $row['materia'] . '\'">Eliminar</button> </td>';
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
        </div>
    </div>
</div>

    <?php
    //NO TOCAR
        }
    ?>
</div>
</body>
</html>
