<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../mostrar.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../javascript/javascript.js"></script>
    <link rel="stylesheet" href="../../css/test.css">
    <title>Modificar</title>
</head>
<body>
<div class="login-card center-mostrar">
    <div class="row custom-form-container container">
<?php
include '../connection.php';

    if (isset($_GET['id']) && isset($_GET['materia'])) {
        // Recuperar el ID del alumno y la materia de la URL
        $idAlumno = $_GET['id'];
        $materia = $_GET['materia'];

        if (isset($_POST['nuevaNota'])) {
            // Manejar el formulario de modificación de calificación
            $nuevaNota = $_POST['nuevaNota'];
            if ($nuevaNota < 0 || $nuevaNota > 10) {
                header("Location: ./modificar.php?id=$idAlumno&materia=$materia&error=no");
            } else {
            // Actualizar la calificación en la base de datos
            $sql = "UPDATE tbl_notas SET nota = ? WHERE id_alumno = ? AND materia = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "dss", $nuevaNota, $idAlumno, $materia);
            mysqli_stmt_execute($stmt);
            header('Location: ../mostrar.php');
            }
        } else {
            // Consulta para obtener la calificación actual
            
            $sql = "SELECT nota FROM tbl_notas WHERE id_alumno = ? AND materia = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $idAlumno, $materia);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $NotaActual = $row['nota'];
            // Formulario para modificar la calificación
            echo "<p>Modificando la calificación en la materia: $materia</p >";
            echo "<form method='post'>";
            echo "<label for='nuevaNota'>Nueva Calificación:</label>";
            echo "<input type='text' name='nuevaNota' value='$NotaActual'>";
            echo "<button type='submit'>Guardar</button>";
            echo "</form>";
            if (isset($_GET['error'])) {
                echo "La nota que has puesto no es valida";
            }
        }
    } else {
        // Manejar el error si los parámetros no están presentes en la URL
        echo "Parámetros faltantes en la URL.";
    }
?>
</div>
</div>
</body>
</html>

