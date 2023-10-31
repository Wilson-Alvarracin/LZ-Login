<?php
session_start();
include 'connection.php';
if (!isset($_POST['login'])) {

    header('Location: ../index.php');

} else {
    $user=$_POST['email'];
    $pwd=$_POST['pwd'];
    //encriptamos
    $pwdenc = hash("sha256", $pwd);
    //cojo todo del usuario $user
    $sql = "SELECT * FROM tbl_login where nombre_login = '$user'";
    $stmt = mysqli_prepare($conn, $sql);
    //Se ejecuta el select en la base de datos
    mysqli_stmt_execute($stmt);
    $resul1 = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($resul1) == 1) {
        //Metemos el resultado en una array
        $login = mysqli_fetch_assoc($resul1);
        //Comprobamos nombre y pwd con el de la base de datos
        if ($login['nombre_login'] == $user && $pwdenc == $login['password_login']) {
            $_SESSION['user']=$user;
            $_SESSION['pwd']=$pwd;
            //SI es entramos
            header('Location: ./mostrar.php');
        } else {
            header('Location: ../index.php?fallo=false');
        }
    } else {
        header('Location: ../index.php?exist=0');
    }
    
}