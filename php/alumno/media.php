<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
    exit();
}
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="./javascript/javascript.js"></script>
    <link rel="stylesheet" href="../../css/test.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Media</title>
</head>
<body>
<div class="login-card center-mostrar">
    <div class="row custom-form-container container">
        <!-- Medias de Asignaturas -->
        <h2>Medias de Asignaturas</h2>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th class="azul">Materia</th>
                    <th>Nota media</th>
                </tr>
            </thead>
            <tbody>
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
                            echo "<tr>";
                            echo "<th>" . $column_name . "</th>";
                            echo "<td style='color: " . ($media_asignatura > 5 ? 'green' : 'red') . ";'>" . $media_asignatura . "</td>";
                            echo "</tr>";
                        }
                        $stmt->close();
                    }
                    echo "</tbody>";
                } else {
                    // Si no se encontraron asignaturas en la base de datos, mostramos este mensaje
                    echo "No se encontraron asignaturas.";
                }
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
            }
            ?>
        </table>

        <!-- Medias de Alumnos -->
        <div>
            <h2>Medias de Alumnos</h2>
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th class="azul">Materia</th>
                        <th>Mejor nota</th>
                        <th>Mejor alumno</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Recorremos los resultados
    foreach ($result as $row) {
        $materia = $row["materia"];
        $mejorNota = $row["mejor_nota"];
        $mejorAlumno = $row["mejor_alumno"];
        // Puedes mostrar los resultados o realizar otras acciones aquí
        echo "<tr>";
        echo "<th>". $materia . "</th>";
        echo "<td style='color: " . ($mejorNota >= 5 ? 'green' : 'red') . ";'>" . $mejorNota . "</td>";
        echo "<th>". $mejorAlumno . "</th>";
        echo "<tr>";
    }

    echo "</tbody>";
    // Confirmamos la transacción con el commit
    mysqli_commit($conn);
    // Cerramos la consulta preparada 
    mysqli_stmt_close($stmt);
    // Cerrar la conexión
    mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>

        <br>
        <button type="button" class="btn btn-info" onclick="window.location.href='../mostrar.php'">Volver</button>;
    </div>
</div>
</body>
</html>