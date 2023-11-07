<?php
session_start();
include 'connection.php';

if (isset($_POST['crear_alumno'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $fecha_nacimiento = mysqli_real_escape_string($conn, $_POST['fecha_nacimiento']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO tbl_alumnos (nombre, apellidos, fecha_nacimiento, email) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellidos, $fecha_nacimiento, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        // Obtener el ID del alumno recién insertado
        $id_alumno = mysqli_insert_id($conn);
        
        // Insertar notas con un valor predeterminado de 0
        $materias = ['Materia1', 'Materia2', 'Materia3']; // Agrega las materias que necesites
        $nota_predeterminada = 0;
        foreach ($materias as $materia) {
            $sql = "INSERT INTO tbl_notas (id_alumno, materia, nota) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iss", $id_alumno, $materia, $nota_predeterminada);
            mysqli_stmt_execute($stmt);
        }
        
        header('Location: ../php/mostrar.php');
    } else {
        echo "Error al crear el alumno: " . mysqli_error($conn);
    }
}
?>