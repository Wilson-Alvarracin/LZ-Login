// Función que se ejecutará si el parámetro "fallo" está presente en la URL
function Errorpwd() {
    // Coloca aquí el código que deseas ejecutar cuando "fallo" está presente
    const alertPlaceholder = document.getElementById('pwderror');

    const appendAlert = (mensaje, tipo) => {
        const alerta = document.createElement('div');
        alerta.innerHTML = [
            `<div id="pwderror" class="alert alert-${tipo} alert-dismissible" role="alert">`,
            `   <div>${mensaje}</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`,
        ].join('');
        alertPlaceholder.append(alerta);

        // Desaparecer automáticamente después de 5 segundos
        setTimeout(() => {
            alerta.remove();
        }, 5000); // 5000 milisegundos = 5 segundos
    };

    // Llama a la función appendAlert directamente
    appendAlert('Contraseña incorrecta', 'warning');
}

// Verificar si el parámetro "fallo" existe en la URL
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has("fallo")) {
    // Si "fallo" está presente, ejecuta la función
    Errorpwd();
}