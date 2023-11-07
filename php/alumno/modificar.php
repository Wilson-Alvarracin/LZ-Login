<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
}

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
