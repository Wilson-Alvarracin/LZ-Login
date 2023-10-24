var usuarioCompleto = false;
var contraseñaCompleta = false;

function validarCampo(input) {
    var valor = input.value.trim();

    if (valor === '') {
        input.classList.add('error');
        input.placeholder = 'Rellena este campo';
        document.getElementById('loginBtn').disabled = true;
        if (input.id === 'email') {
            usuarioCompleto = false;
        } else if (input.id === 'pwd') {
            contraseñaCompleta = false;
        }
    } else {
        input.classList.remove('error');
        input.placeholder = '';
        if (input.id === 'email') {
            usuarioCompleto = true;
        } else if (input.id === 'pwd') {
            contraseñaCompleta = true;
        }
        
        if (usuarioCompleto && contraseñaCompleta) {
            document.getElementById('loginBtn').disabled = false;
        }
    }
}

function validarFormulario() {
    var usuarioInput = document.getElementById('email');
    var contraseñaInput = document.getElementById('pwd');

    if (!usuarioCompleto || !contraseñaCompleta) {
        if (!usuarioCompleto) {
            usuarioInput.classList.add('error');
            usuarioInput.placeholder = 'Rellena este campo';
        }
        if (!contraseñaCompleta) {
            contraseñaInput.classList.add('error');
            contraseñaInput.placeholder = 'Rellena este campo';
        }
        return false;
    }

    return true;
}
