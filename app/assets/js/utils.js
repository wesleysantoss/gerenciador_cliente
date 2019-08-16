/**
 * Função percorre todos os input marcado como required de uma div/form
 * E verifica quais estão em branco e marca como "is-invalid"
 * Retorna true se caso todos os inoputs estiver preenchido e false caso algum estiver em branco
 * Invocar a função com o metodo call do JS
 */
const validarFormulario = function(){
    const $input = this.querySelectorAll('input[required]');
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

/**
 * Função percorre todos os inputs de uma div/form e limpa o value
 */
const limparFormulario = function(){
    const $input = this.querySelectorAll('input');
    $input.forEach(function(elem){
        elem.value = '';
    });
}