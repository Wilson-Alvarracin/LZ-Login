<?php
session_start();

if (!isset($_SESSION["user"])) {
    header('Location: ./index.php');
    exit();
}


if (isset($_GET['id']) && isset($_GET['materia'])) {
    // Recuperar el ID del alumno y la materia de la URL
    $idAlumno = $_GET['id'];
    $materia = $_GET['materia'];
    include '../connection.php';

            // Desactivamos la autoejecución de consultas
            mysqli_autocommit($conn, false);

            // Iniciamos la transacción
            mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);
            $sqlselect = "SELECT FROM tbl_notas WHERE id_alumno = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sqlselect);
            mysqli_stmt_bind_param($stmt, "i", $idAlumno);
            mysqli_stmt_execute($stmt);
            $resul1 = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resul1) > 1) {
        $sql1 = "DELETE FROM tbl_notas WHERE id_alumno = ? AND materia = ?";
        $stmt1 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt1, $sql1);
            mysqli_stmt_bind_param($stmt1, "is", $idAlumno, $materia);
            mysqli_stmt_execute($stmt1);
            // Confirmamos la transacción con el commit
            mysqli_commit($conn);
            // Cerrar las consultas preparadas (statements) y la conexión
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt1);
            header("Location: ../mostrar.php"); // Redirecciona a la lista de alumnos u otra página
    } else {
        $sql1 = "DELETE FROM tbl_notas WHERE id_alumno = ? AND materia = ?";
        $stmt1 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt1, $sql1);
            mysqli_stmt_bind_param($stmt1, "is", $idAlumno, $materia);
            mysqli_stmt_execute($stmt1);
        $sql2 = "DELETE FROM tbl_alumnos WHERE id_alumno = ?";
        $stmt2 = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt2, $sql2);
            mysqli_stmt_bind_param($stmt2, "i", $idAlumno);
            mysqli_stmt_execute($stmt2);
            // Confirmamos la transacción con el commit
            mysqli_commit($conn);
             // Cerrar las consultas preparadas (statements) y la conexión
            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            mysqli_close($conn);
            header("Location: ../mostrar.php"); // Redirecciona a la lista de alumnos u otra página
    }
    }