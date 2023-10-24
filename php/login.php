<?php
session_start();
include 'connection.php';

if (empty($_SESSION['email'])) {
    header('Location: ../index.php');
}
if (!isset($_POST['enviar'])) {
    
    $user=$_POST['email'];
    $pwd=$_POST['pwd'];

$pwdenc = hash("sha256", $pwd);

$select = "SELECT * FROM tbl_login where nombre_login = '$user'";
$sele= mysqli_query($connection, $select);
$seleL = mysqli_num_rows($sele);

if ($seleL == 1) {
    $seleF=mysqli_fetch_array($sele);
    if ($seleF['nombre_login'] == $user && $pwdenc == $seleF['password_login']) {
        $_SESSION['user']=$user;
        $_SESSION['pwd']=$pwd;
        header('Location: ./mostrar.php?alu=1');
    } else {
        header('Location: ../index.php?fallo=false');
    }
} else {
    header('Location: ../index.php?exist=0');
    echo "Rellename el usuario y la contraseña";
}

} 
