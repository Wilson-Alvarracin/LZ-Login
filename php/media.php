<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
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
    <title>Media</title>
</head>
<body>
<div class="login-card center-mostrar">
        <div class="row custom-form-container container">
            <div class="responsive-img-center">
            <form action="./mostrar.php" method='post' style="text-align: right;">
            <button type="submit" name="Media" value="Media">Volver</button>
            </form>
            </div>
<?php

  if ($_SESSION['user'] == "admin@fje.edu") {
    // Si el usuario es "admin@fje.edu", entramos
    
    // Con esta consulta obtenemos la lista de asignaturas que hay
    $sql = "SELECT DISTINCT materia FROM tbl_notas;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si hay asignaturas en la base de datos, las almacenamos en un array
        $column_names = array();
        while ($row = $result->fetch_assoc()) {
            $column_names[] = $row["materia"];
        }

        // Para cada asignatura calculamos el promedio de las notas
        foreach ($column_names as $column_name) {
            // Preparamos la consulta SQL para calcular el promedio de notas para X asignatura
            $query ="SELECT AVG(nota) AS media FROM tbl_notas WHERE materia = ?;";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $column_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                // Si la consulta se ejecuta correctamente obtendremos aquí el resultado y mostraremos el promedio
                $row = $result->fetch_assoc();
                $media_asignatura = $row["media"];
                echo "<b>Media de " . $column_name . ": " . $media_asignatura . "</b><br>";
            }
            $stmt->close();
        }
    } else {
        // Si no se encontraron asignaturas en la base de datos, mostramos este mensaje
        echo "No se encontraron asignaturas.";
    }
    ?>
        </div>
    </div>
<?php
  }
?>
</body>
</html>