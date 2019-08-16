/**
 * Função percorre todos os input marcado como required de uma div/form
 * E verifica quais estão em branco e adiciona a classe "is-invalid"
 * Retorna true se caso todos os inputs estiver preenchido e false caso algum estiver em branco
 * Invocar a função com o metodo call do JS passando como parametro a div que tem o form
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
 * Invocar a função com o metodo call do JS passando como parametro a div que tem o form
 */
const limparFormulario = function(){
    const $input = this.querySelectorAll('input');
    $input.forEach(function(elem){
        elem.value = '';
    });
}

/**
 * Consome a API do viacep para buscar os dados do endereço
 * @param cep - CEP a ser pesquisado.
 */
const buscarEnderecoPorCep = async function(cep){
    cep = cep.replace('.', '').replace('-', '').replace('/', '');

    try {
        const {data} = await axios(`https://viacep.com.br/ws/${cep}/json/`);
        return data;
    } catch (e){
        return false;
    }
}
