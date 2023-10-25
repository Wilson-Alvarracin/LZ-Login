<?php
session_start();
require_once('./funciones.php');
include 'connection.php';
if (!isset($_POST['login'])) {

    header('Location: ../index.php');

} else {
    $user=$_POST['email'];
    $pwd=$_POST['pwd'];
    
    $pwdenc = hash("sha256", $pwd);
    
    $sql = "SELECT * FROM tbl_login where nombre_login = '$user'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $resul1 = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($resul1) == 1) {
        $login = mysqli_fetch_assoc($resul1);
        if ($login['nombre_login'] == $user && $pwdenc == $login['password_login']) {
            $_SESSION['user']=$user;
            $_SESSION['pwd']=$pwd;
            header('Location: ./mostrar.php');
        } else {
            header('Location: ../index.php?fallo=false');
        }
    } else {
        echo "no Existe";
        header('Location: ../index.php?exist=0');
    }
    
}