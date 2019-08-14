const validarFormulario = function(){
    const $input = this.querySelectorAll('input');
    let estado = true;

    $input.forEach(function(elem){
        if(elem.value.length == 0){
            elem.classList.add('is-invalid');
            estado = false;
        }
        else{
            elem.classList.remove('is-invalid');
        }
    });

    return estado;
}