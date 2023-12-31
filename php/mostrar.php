<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ./cerrar.php');
    exit();
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
    <style>
    .responsive-img-center {
        padding: 0px;
        margin-left: 0px;
    }

    .center-mostrar {
        padding: 0px;
        margin-left: 0px;
    }
    @media (max-width: 860px) {
    input,
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    button {
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
}


</style>
</head>
<body>
    <style>
        
    </style>
    <?php
    if ($_SESSION['user'] == "admin@fje.edu") {
        // Inicializar variables de paginación
        $por_pagina = 10;
        $pagina_actual = 1;

        // Verificar si se proporcionaron valores en la URL
        if (isset($_GET['por_pagina']) && $_GET['por_pagina'] != NULL) {
            $por_pagina = $_GET['por_pagina'];
        }

        if (isset($_GET['pagina']) && $_GET['pagina'] != NULL) {
            $pagina_actual = $_GET['pagina'];
        }
        // Calcular el inicio de la paginación
        $inicio = ($pagina_actual -1 ) * $por_pagina;

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
                    INNER JOIN tbl_notas n ON a.id_alumno = n.id_alumno LIMIT ?, ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $inicio, $por_pagina);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } 
        $sqlmateria = "SELECT DISTINCT materia FROM tbl_notas;";
        $stmtmateria = mysqli_prepare($conn, $sqlmateria);
        mysqli_stmt_execute($stmtmateria);
        $resultmateria = mysqli_stmt_get_result($stmtmateria);
        ?> 
        <!-- <div class="login-card center"> -->
    <div class="login-card center-mostrar">
    <div class="row custom-form-container container">
    <div class="responsive-img-center">
    <button type="submit" value='Actualizar'><a href="./cerrar.php" style ="text-decoration: none; color: black;">Cerrar Session</a></button>
    <form method='get' action='mostrar.php'>
        <label for="por_pagina">Usuarios por pantalla</label>
        <input type='number' name='por_pagina' value=<?php echo $por_pagina ?> min='1' max='20'>
        <button type="submit" value='Actualizar'>Actualizar</button>
    </form>
    
    <br>
    <form method="post">
    <label for="buscar_nombre">Buscar por Nombre:</label>
    <input type="text" id="buscar_nombre" name="buscar_nombre" required>
    <label for="materia">Buscar por Materia:</label>
    <select name="materia">
        <option value="Todo">Todo</option>
        <?php
        foreach ($resultmateria as $rowmateria) {
            $opmateria = $rowmateria['materia'];
            echo "<option value='$opmateria'>$opmateria</option>";
        }
        ?>
    </select>
    <button type="submit" name="filtro_materia" value="Filtrar">Filtrar</button>
</form>
<br>
<!-- Botón de Media -->
<button type="button" class="btn btn-info" onclick="window.location.href='./alumno/crearAlu.php'">Crear Alumno</button>   
<!-- <button type="button" class="btn btn-success" onclick="window.location.href='./correo.php'">Correo electronico</button>-->
<button type="button" class="btn btn-info" onclick="window.location.href='./alumno/media.php'">Media</button>
<br>
<?php
$sql = "SELECT COUNT(*) as total FROM tbl_alumnos";
$resultado = mysqli_query($conn, $sql);
$total_registros = mysqli_fetch_assoc($resultado)['total'];
$total_paginas = ceil($total_registros / $por_pagina);

echo "<br>Páginas: ";
for ($i = 1; $i <= $total_paginas; $i++) {
    echo "<a href='?pagina=$i&por_pagina=$por_pagina'>$i</a> ";
}
?>
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
        echo "<tr>";
        echo "<th style='font-size: 14px;'>" . $row['nombre'] ."</th>";
        echo "<td style='font-size: 14px;'>" . $row['apellidos'] ."</td>";
        echo "<td style='font-size: 14px;'>" . $row['materia'] . "</td>";
        echo "<td style='font-size: 14px; color: " . ($row['nota'] >= 5 ? 'green' : 'red') . ";'>" . $row['nota'] . "</td>";
        echo '<td> <button type="button" class="btn btn-warning" onclick="window.location.href=\'./alumno/modificar.php?id='.$row['id_alumno'].'&materia='.$row['materia'].'\'">Modificar</button> </td>';        
        echo '<td> <button type="button" class="btn btn-danger" onclick="window.location.href=\'./alumno/eliminar.php?id=' . $row['id_alumno'] . '&materia=' . $row['materia'] . '\'">Eliminar</button> </td>';
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
        </div>
    </div>
    <?php
    //NO TOCAR
    }
    ?>
</div>
</body>
</html>
