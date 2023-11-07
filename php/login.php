<?php
session_start();
include 'connection.php';

if (!isset($_POST['login'])) {
    header('Location: ../index.php');
} else {
    $user = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    $sql = "SELECT * FROM tbl_usuarios WHERE nombre_usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $login = mysqli_fetch_assoc($result);
        $stored_pwd = $login['contrasena'];

        if (password_verify($pwd, $stored_pwd)) {
            $_SESSION['user'] = $user;
            header('Location: ./mostrar.php');
        } else {
            header('Location: ../index.php?exist=0');
        }
    } else {
        header('Location: ../index.php?exist=0');
    }
}