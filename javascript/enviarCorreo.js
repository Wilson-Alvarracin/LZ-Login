function prepararEnvio() {
    // Obtener todos los checkboxes seleccionados
    var checkboxes = document.getElementsByName('seleccionados[]');
    var seleccionados = [];
    // Recorrer los checkboxes y agregar los valores seleccionados al array
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            seleccionados.push(checkboxes[i].value);
        }
    }
    // Asignar los valores seleccionados al campo oculto
    document.getElementById('alumnos_seleccionados').value = seleccionados.join(',');
    // Enviar el formulario
    document.getElementById('formEnviarCorreo').submit();
}
