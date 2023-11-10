<?php
session_start();

if (!isset($_SESSION["user"])) {
    header('Location: ./index.php');
    exit();
}

include '../connection.php';

// Desactivamos la autoejecución de consultas
mysqli_autocommit($conn, false);

// Iniciamos la transacción
mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

// Consulta para obtener los mejores alumnos por materia
$sql = "SELECT materia, nota AS mejor_nota, nombre AS mejor_alumno
FROM (
    SELECT materia, nota, nombre,
           ROW_NUMBER() OVER (PARTITION BY materia ORDER BY nota DESC) AS row_num
    FROM tbl_notas n
    JOIN tbl_alumnos a ON n.id_alumno = a.id_alumno
) ranked
WHERE row_num = 1
ORDER BY materia";

$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
    // Ejecutamos la consulta preparada
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Recorremos los resultados
    foreach ($result as $row) {
        $materia = $row["materia"];
        $mejorNota = $row["mejor_nota"];
        $mejorAlumno = $row["mejor_alumno"];
        // Puedes mostrar los resultados o realizar otras acciones aquí
        echo "Materia: " . $materia . " - Mejor Nota: " . $mejorNota . " - Mejor Alumno: " . $mejorAlumno . "<br>";
    }

    // Confirmamos la transacción con el commit
    mysqli_commit($conn);

    // Cerramos la consulta preparada 
    mysqli_stmt_close($stmt);
// Cerrar la conexión
mysqli_close($conn);
?>
