<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="./javascript/javascript.js"></script>
    <title>Login</title>
</head>
<body>
    <form action="./php/login.php" method="post" onsubmit="return validarFormulario()">
        <label for="email" id="email">Usuario</label>
        <input type="email" name="email" id="email" onblur="validarCampo(this, 'pwd')">
        <br>
        <label for="pwd">Contraseña</label>
        <input type="password" name="pwd" id="pwd" onblur="validarCampo(this, 'loginBtn')">
        <br>
        <div id="mensajeError" class="error"></div>
        <input type="submit" value="Login" id="loginBtn" disabled>
    </form>
    
</body>
</html>