<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../mostrar.php');
}
include_once('../connection.php');

if (isset($_POST['crear_alumno'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
    $correo_electronico = mysqli_real_escape_string($conn, $_POST['correo_electronico']);

    // Verificar si ya existe un alumno con el mismo correo electrónico
    $sql_verificar_correo = "SELECT * FROM tbl_alumnos WHERE correo_electronico = ?";
    $stmt_verificar_correo = mysqli_prepare($conn, $sql_verificar_correo);
    mysqli_stmt_bind_param($stmt_verificar_correo, "s", $correo_electronico);
    mysqli_stmt_execute($stmt_verificar_correo);
    $result_verificar_correo = mysqli_stmt_get_result($stmt_verificar_correo);

    if (mysqli_num_rows($result_verificar_correo) > 0) {
        header('Location: ./crearAlu.php?exist=1');
        // Puedes redirigir a una página de error o manejar de otra manera
        exit();
    }

    // Inserción de Datos
    $sql_insertar = "INSERT INTO tbl_alumnos (nombre, apellidos, fecha_nacimiento, correo_electronico) VALUES (?, ?, ?, ?)";
    $stmt_insertar = mysqli_prepare($conn, $sql_insertar);
    mysqli_stmt_bind_param($stmt_insertar, "ssss", $nombre, $apellidos, $fecha_nacimiento, $correo_electronico);

    if (mysqli_stmt_execute($stmt_insertar)) {
        // Obtener el ID del alumno recién insertado
        $id_alumno = mysqli_insert_id($conn);

        // Insertar notas con un valor predeterminado de 0
        $materias = ['Matemáticas', 'Historia'];
        $nota_predeterminada = 0;
        foreach ($materias as $materia) {
            $sql = "INSERT INTO tbl_notas (id_alumno, materia, nota) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $id_alumno, $materia, $nota_predeterminada);
            mysqli_stmt_execute($stmt);
        }

        header('Location: ../mostrar.php');
    } else {
        echo "Error al crear el alumno: " . mysqli_error($conn);
    }
}
?>