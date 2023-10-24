<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlazar a Bootstrap CSS a través de un CDN -->
    <script src="./javascript/javascript.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<div class="bg">
<body class="background">
<div class="container">
    <div class="row justify-content-center">
            <div class="custom-form-container">
                <form action="./php/login.php" method="post" onsubmit="return validarFormulario()">
                    <img src="./img/zorrito_logo.png" alt="">
                    <!-- Email input -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="email" id="email"><b>Correo electrónico</b></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Inserta aquí tu correo... " onblur="validarCampo(this, 'pwd')" />
                        <?php if (isset($_GET['exist'])) {
                            echo "<p class='errorlogin'> Usuario equivocado </p>";

                        } ?>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="pwd"><b>Password</b></label>
                        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Inserta aquí la contraseña..." onblur="validarCampo(this, 'loginBtn')"/>
                        <?php if (isset($_GET['fallo'])) {
                            echo "<div id='alerta'></div>";
                            }?>
                    </div>

                    <!-- Botón de enviar -->
                    <div id="mensajeError" class="error"></div>
                    <input type="submit" name="login" value="Login" class="btn btn-primary btn-block mb-4 " id="loginBtn" disabled>

                    <!-- Register button -->
                    <div class="text-center">
                        <p>¿No eres miembro? <a href="./php/registrar.php">Regístrate</a></p>
                    </div>
                </form>
            </div>
    </div>
</div>
<script src="./javascript/alerts.js"></script>
</body>
<!-- Final del DIV del Background -->
</div>
</html>