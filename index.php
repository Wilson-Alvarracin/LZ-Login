<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="./javascript/javascript.js"></script>
    <link rel="stylesheet" href="./css/test.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
<div class="login-card center">
    <div class="row custom-form-container">
        <div class="column-2 responsive-img-center">
            <img src="./img/zorrito_logo.png" alt="" class="">
        </div>
        <div class="column-2 responsive-form-center">
            <form action="./php/login.php" method="post" onsubmit="return validarFormulario()">
                <label class="form-label" for="email" id="email"><b>Correo electrónico</b></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Inserta aquí tu correo... " onblur="validarCampo(this, 'pwd')" />
                <?php if (isset($_GET['exist'])) {echo "<p class='errorlogin'> Usuario equivocado </p>";} ?>
                <!-- Password input -->
                <label class="form-label" for="pwd"><b>Password</b></label>
                <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Inserta aquí la contraseña..." onblur="validarCampo(this, 'loginBtn')"/>
                <?php if (isset($_GET['fallo'])) {echo "<div id='pwderror'></div>";}?>
                <!-- Botón de enviar -->
                <div id="mensajeError" class="error"></div>
                <br>
                <input type="submit" name="login" value="Login" class="btn btn-primary btn-block mb-4 " id="loginBtn">
            </form>
        </div>
    </div>
</div>
</body>

</html>