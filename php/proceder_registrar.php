<?php
include 'connection.php';

if (isset($_POST['registrar'])) {
    $email = $_POST['email'];
    $pwd_reg = $_POST['pwd_reg'];
    $confirm_pwd = $_POST['confirm_pwd'];
    
    // Verifica si las contraseñas coinciden
    if ($pwd_reg !== $confirm_pwd) {
        header('Location: ./registrar.php?error=pass');
        exit();
    }
    
    $pwdenc = hash("sha256", $pwd_reg);
    
    $sql = "INSERT INTO tbl_login (nombre_login, password_login) VALUES ('$email', '$pwdenc')";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: ./login.php');
        exit();
    } else {
        header('Location: ./registrar.php?error=db');
        exit();
    }
}
?>