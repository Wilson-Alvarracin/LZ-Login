<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Enlaza a Bootstrap CSS a través de un CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Registro</title>
</head>
<body class="background bg">
<div class="container">
    <div class="row justify-content-center">
        <div class="custom-form-container">
            <form action="./proceder_registrar.php" method="post" onsubmit="return validarFormularioRegistro()">
            <img src="../img/zorrito_logo.png" alt="">
                <!-- Nombre de usuario -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="email"><b>Correo electrónico</b></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Inserta tu correo..." onblur="validarCampo(this)" />
                </div>

                <!-- Contraseña -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="pwd_reg"><b>Contraseña</b></label>
                    <input type="password" name="pwd_reg" id="pwd_reg" class="form-control" placeholder="Inserta tu contraseña..." onblur="validarCampo(this)" />
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="confirm_pwd"><b>Confirmar Contraseña</b></label>
                    <input type="password" name="confirm_pwd" id="confirm_pwd" class="form-control" placeholder="Confirma tu contraseña..." onblur="validarCampo(this)" />
                    <div id="mensajeError" class="error"></div>
                </div>

                <!-- Botón de registro -->
                <input type="submit" name="registrar" value="Registrarse" class="btn btn-primary btn-block mb-4" id="regBtn" disabled>

                <!-- Login button -->
                <div class="text-center">
                    <p>¿Ya eres miembro? <a href="../index.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var usuarioInput = document.getElementById('email');
    var contraseñaInput = document.getElementById('pwd_reg');
    var confirmarContraseñaInput = document.getElementById('confirm_pwd');

    confirmarContraseñaInput.addEventListener('blur', validarCampo);
    contraseñaInput.addEventListener('blur', validarCampo);
    usuarioInput.addEventListener('blur', validarCampo);

    function validarCampo() {
        var usuario = usuarioInput.value;
        var contraseña = contraseñaInput.value;
        var confirmarContraseña = confirmarContraseñaInput.value;
        var mensajeUser = document.getElementById('email');
        var mensajeContra = document.getElementById('pwd_reg');
        var mensajeContraFir = document.getElementById('confirm_pwd');
        var mensajeError = document.getElementById('confirm_pwd');
        var regBtn = document.getElementById('regBtn');

        if (usuario === '') {
            mensajeUser.classList.add('error');
            mensajeUser.placeholder = 'Rellena el usuario.';
            regBtn.disabled = true;
        } else if (contraseña === '')  {;
            mensajeContra.classList.add('error');
            mensajeContra.placeholder = 'Rellena la contraseña.';
            regBtn.disabled = true;
        } else if (confirmarContraseña === '') {
            mensajeContraFir.classList.add('error');
            mensajeContraFir.palce = 'Confirma tu contraseña.';
            regBtn.disabled = true;
        } else if (contraseña !== confirmarContraseña) {
            mensajeUser.classList.add('error');
            mensajeError.placeholder = 'Las contraseñas no coinciden.';
            regBtn.disabled = true;
        } else {
            mensajeError.placeholder = '';
            regBtn.disabled = false;
        }
    }
});
</script>

</body>
</html>
