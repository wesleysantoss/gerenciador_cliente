/**
 * Gera um HTML com as informações do endereço a partir da div #painel-novo-endereco
 * A função deve ser chamada pelo metodo call
 */
const gerarHtmlPainelEndereco = function(){
    const rua = this.querySelector("#rua").value;
    const numero = this.querySelector("#numero").value;
    const bairro = this.querySelector("#bairro").value;
    const cidade = this.querySelector("#cidade").value;
    const uf = this.querySelector("#uf").value;
    const complemento = this.querySelector("#complemento").value;
    const enderecoPrincipal = this.querySelector("#endereco-principal").checked == true ? 'Sim' : 'Não';

    const html = `
        <div class="card mt-2" id="dados-endereco">
            <div class="card-body">
                <p>
                    <b>Rua:</b> <span data-elemento="rua">${rua}</span> 
                    <b>Número:</b> <span data-elemento="numero">${numero}</span>
                </p>
                <p>
                    <b>Bairo:</b> <span data-elemento="bairro">${bairro}</span> 
                    <b>Cidade:</b> <span data-elemento="cidade">${cidade}</span> 
                    <b>UF:</b> <span data-elemento="uf">${uf}</span>
                </p>
                <p>
                    <b>Complemento:</b> <span data-elemento="complemento">${complemento}</span>
                </p>

                <p>
                    <b>Principal:</b> <span data-elemento="principal">${enderecoPrincipal}</span>
                </p>

                <button id="btn-excluir-endereco" type="button" class="btn btn-danger btn-sm">
                    Excluir
                </button>
            </div>
        </div>
    `;

    return html;
}

/**
 * Sempre que é clicado para gravar um novo endereço.
 */
document.querySelector("#btn-novo-endereco").addEventListener("click", function(){
    const $painelNovoEndereco = document.querySelector("#painel-novo-endereco");
    const $modalEndereco = $("#modal-endereco");
    const resultadoValidarForm = validarFormulario.call($painelNovoEndereco);

    if(resultadoValidarForm){
        const $painelEndereco = document.querySelector("#painel-endereco");
        const html = gerarHtmlPainelEndereco.call($painelNovoEndereco);

        $painelEndereco.insertAdjacentHTML('beforeend', html);
        limparFormulario.call($painelNovoEndereco);
        $modalEndereco.modal('hide');
    }
    else{
        alert('Preencha todos os campos relacionado a endereço');
    }
})

/**
 * Identifica quando é clicado na opção de excluir um endereço
 */
document.querySelector("#painel-endereco").addEventListener("click", function(e){
    const $this = e.target;

    if($this.id === 'btn-excluir-endereco'){
        $this.parentNode.parentNode.remove();
    }
})

/**
 * Quando é clicado para gravar o cliente
 */
document.querySelector("#btn-cadastrar").addEventListener("click", async function(){
    const $painelEndereco = document.querySelector("#painel-endereco");
    const $painelDadosCliente = document.querySelector("#painel-dados-cliente");
    const totalEndereco = $painelEndereco.children.length;

    const validarFormularioDadosCliente = validarFormulario.call($painelDadosCliente);

    if(validarFormularioDadosCliente){
        if(totalEndereco === 0){
            alert('Oops, é necessário preencher um endereço');
            $("#modal-endereco").modal('show');
        }
        else{
            // Captura os dados para o form.
            const formData = new FormData();
            const nome = $painelDadosCliente.querySelector("#nome").value;
            const cpf = $painelDadosCliente.querySelector("#cpf").value;
            const rg = $painelDadosCliente.querySelector("#rg").value;
            const telefone = $painelDadosCliente.querySelector("#telefone").value;
            const dataNascimento = $painelDadosCliente.querySelector("#data-nascimento").value;
            const $dadosEndereco = $painelEndereco.querySelectorAll("#dados-endereco");

            // let arrEnderecos = [];

            formData.append('nome', nome);
            formData.append('cpf', cpf);
            formData.append('rg', rg);
            formData.append('telefone', telefone);
            formData.append('dataNascimento', dataNascimento);

            $dadosEndereco.forEach(elem => {
                const rua = elem.querySelector("span[data-elemento=rua]").innerHTML;
                const numero = elem.querySelector("span[data-elemento=numero]").innerHTML;
                const bairro = elem.querySelector("span[data-elemento=bairro]").innerHTML;
                const cidade = elem.querySelector("span[data-elemento=cidade]").innerHTML;
                const uf = elem.querySelector("span[data-elemento=uf]").innerHTML;
                const complemento = elem.querySelector("span[data-elemento=complemento]").innerHTML;
                const principal = elem.querySelector("span[data-elemento=principal]").innerHTML;

                formData.append('rua[]', rua);
                formData.append('numero[]', numero);
                formData.append('bairro[]', bairro);
                formData.append('cidade[]', cidade);
                formData.append('uf[]', uf);
                formData.append('complemento[]', complemento);
                formData.append('principal[]', principal);
                
                // arrEnderecos.push({rua, numero, bairro, cidade, uf, complemento, principal});
            });

            // formData.append('arrEnderecos', arrEnderecos);

            try {
                const resultado = await axios({
                    method: 'POST',
                    url: '/gerenciador-cliente/cliente/cadastrar',
                    data: formData,
                    responseType: 'json'
                });
    
                const {data} = resultado;
    
                console.log(data);
            } catch(e) {
                console.log("Error: ", e);
            }

        }
    }
    else{
        alert('Oops, preencha todos os campos');
    }
})