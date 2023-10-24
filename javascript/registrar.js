var camposValidos = {
    username: false,
    pwd_reg: false,
    confirm_pwd: false
};

function validarCampo(input) {
    var id = input.id;
    var valor = input.value.trim();
    var mensaje = document.getElementById('mensajeErrorRegistro');
    var regBtn = document.getElementById('regBtn');

    if (valor === '') {
        input.classList.add('error');
        input.placeholder = 'Rellena este campo';
        camposValidos[id] = false;
    } else {
        input.classList.remove('error');
        input.placeholder = '';
        camposValidos[id] = true;

        // Verificar si las contraseñas coinciden
        if (id === 'pwd_reg' || id === 'confirm_pwd') {
            var pwd_reg = document.getElementById('pwd_reg').value;
            var confirm_pwd = document.getElementById('confirm_pwd').value;

            if (pwd_reg !== confirm_pwd) {
                mensaje.innerText = 'Las contraseñas no coinciden.';
                regBtn.disabled = true;
            } else {
                mensaje.innerText = '';
                regBtn.disabled = false;
            }
        }
    }

    // Verificar si todos los campos están completos
    if (camposValidos.username && camposValidos.pwd_reg && camposValidos.confirm_pwd) {
        mensaje.innerText = '';
        regBtn.disabled = false;
    } else {
        regBtn.disabled = true;
    }
}

function validarFormularioRegistro() {
    // Validar nuevamente todos los campos antes de enviar el formulario
    validarCampo(document.getElementById('username'));
    validarCampo(document.getElementById('pwd_reg'));
    validarCampo(document.getElementById('confirm_pwd'));

    // Verificar si el formulario es válido
    return camposValidos.username && camposValidos.pwd_reg && camposValidos.confirm_pwd;
}