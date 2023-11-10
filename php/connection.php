<?php
// Conectarse a la base de datos utilizando mysqli
$conn = mysqli_connect("172.24.0.136", "zorrito", "QWEqwe123", "bd_zorritos");

// Verificar si se ha establecido la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}