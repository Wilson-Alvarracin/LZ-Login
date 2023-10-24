<?php
// Incluir el archivo de conexión a la base de datos

// Función para verificar el usuario y contraseña
function verificarCredenciales($user, $pwd) {
    include 'connection.php';
    $new = hash("sha256",$pwd);
    // Consulta preparada

    $sql = "SELECT * FROM tbl_login WHERE nombre_login =".$new." AND password_login = ".$user;
    $stmt = $connection->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("ss", $user, $new);

    // Ejecutar la consulta
    $stmt->execute();

    // Almacenar el resultado
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Usuario y contraseña coinciden
        return true;
    } else {
        // Usuario y contraseña no coinciden
        return false;
    }

    // Cerrar la consulta
    $stmt->close();
    $connection->close();
}

// Cerrar la conexión a la base de datos


// function usr($user, $pwd){
    
//     //CONSULTA DE LOGIN
//     $select = "SELECT * FROM tbl_login where nombre_login = '$user'";

//     //ENCRIPTAMOS LA CONTRASEÑA Y LA GUARDAMOS EN UNA VARIABLE
//     $pwd1 = hash("sha256", $pwd);


