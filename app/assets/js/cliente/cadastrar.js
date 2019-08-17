/**
 * Gera um HTML com as informações do endereço
 * A função deve ser chamada pelo metodo call, passando por parametro um elemento do dom que contenha os
 * inputs para gerar um novo endereço
 */
const gerarHtmlPainelEndereco = function(){
    const cep = this.querySelector("#cep").value;
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
                    <b>CEP:</b> <span data-elemento="cep">${cep}</span> 
                </p>

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
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    `;

    return html;
}

document.querySelector("#cpf").onkeypress = validarNumero;
document.querySelector("#rg").onkeypress = validarNumero;
document.querySelector("#telefone").onkeypress = validarNumero;

/**
 * Sempre que é clicado para gravar um novo endereço.
 */
document.querySelector("#btn-novo-endereco").addEventListener("click", function(){
    const $painelNovoEndereco = document.querySelector("#painel-novo-endereco");
    const $modalEndereco = $("#modal-endereco");

    // Valida se todos os campos foram preenchidos.
    const resultadoValidarForm = validarFormulario.call($painelNovoEndereco);

    if(resultadoValidarForm){
        const $painelEndereco = document.querySelector("#painel-endereco");

        // Gera um HTML a partir da div#painel-endereco
        const html = gerarHtmlPainelEndereco.call($painelNovoEndereco);

        // Insere o novo endereço no fim da div#painel-endereco
        $painelEndereco.insertAdjacentHTML('beforeend', html);

        // Limpa o formulario de novos endereços.
        limparFormulario.call($painelNovoEndereco);

        // Fecha o modal.
        $modalEndereco.modal('hide');
    }
    else{
        Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: 'Preencha todos os campos',
        });
    }
})

/**
 * Sempre que o foco sair do CEP
 */
document.querySelector("#cep").addEventListener("change", async function(){
    // Consome a API do via cep para completar o endereço.
    const cep = this.value;

    try {
        const resultado = await buscarEnderecoPorCep(cep);
        if(resultado !== false){
            const {bairro, localidade, logradouro, uf} = resultado;
            const $painelNovoEndereco = document.querySelector("#painel-novo-endereco");
            
            $painelNovoEndereco.querySelector("#bairro").value = bairro;
            $painelNovoEndereco.querySelector("#cidade").value = localidade;
            $painelNovoEndereco.querySelector("#rua").value = logradouro;
            $painelNovoEndereco.querySelector("#uf").value = uf;
        }
    } catch (e){
        console.log('Error: ', e);
    }
})

/**
 * Identifica quando é clicado na opção de excluir um endereço
 */
document.querySelector("#painel-endereco").addEventListener("click", function(e){
    const $this = e.target;

    if($this.id === 'btn-excluir-endereco'){
        Swal.fire({
            title: 'Oops',
            text: "Deseja realmente excluir o endereço?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Não',
        }).then((result) => {
            if (result.value) {
                $this.parentNode.parentNode.remove();
            }
        })
    }
})

/**
 * Quando é clicado para gravar o cliente
 */
document.querySelector("#btn-cadastrar").addEventListener("click", async function(){
    const $painelEndereco = document.querySelector("#painel-endereco");
    const $painelDadosCliente = document.querySelector("#painel-dados-cliente");

    // Consulta o total de endereço que foi cadastrado.
    const totalEndereco = $painelEndereco.children.length;

    // Valida se todos os campos do formulario foi preenchido.
    const validarFormularioDadosCliente = validarFormulario.call($painelDadosCliente);

    if(validarFormularioDadosCliente){
        if(totalEndereco === 0){
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Preencha ao menos um endereço',
            });

            $("#modal-endereco").modal('show');
        }
        else{
            // Captura os dados para o form.
            const dados = new FormData();
            const nome = $painelDadosCliente.querySelector("#nome").value;
            const cpf = $painelDadosCliente.querySelector("#cpf").value;
            const rg = $painelDadosCliente.querySelector("#rg").value;
            const telefone = $painelDadosCliente.querySelector("#telefone").value;
            const dataNascimento = $painelDadosCliente.querySelector("#data-nascimento").value;
            const $dadosEndereco = $painelEndereco.querySelectorAll("#dados-endereco");

            dados.append('nome', nome);
            dados.append('cpf', cpf);
            dados.append('rg', rg);
            dados.append('telefone', telefone);
            dados.append('dataNascimento', dataNascimento);

            $dadosEndereco.forEach(elem => {
                // Percorre por todos elemento de endereço do dom e captura as info.

                const cep = elem.querySelector("span[data-elemento=cep]").innerHTML;
                const rua = elem.querySelector("span[data-elemento=rua]").innerHTML;
                const numero = elem.querySelector("span[data-elemento=numero]").innerHTML;
                const bairro = elem.querySelector("span[data-elemento=bairro]").innerHTML;
                const cidade = elem.querySelector("span[data-elemento=cidade]").innerHTML;
                const uf = elem.querySelector("span[data-elemento=uf]").innerHTML;
                const complemento = elem.querySelector("span[data-elemento=complemento]").innerHTML;
                const principal = elem.querySelector("span[data-elemento=principal]").innerHTML;

                dados.append('cep[]', cep);
                dados.append('rua[]', rua);
                dados.append('numero[]', numero);
                dados.append('bairro[]', bairro);
                dados.append('cidade[]', cidade);
                dados.append('uf[]', uf);
                dados.append('complemento[]', complemento);
                dados.append('principal[]', principal);
            });

            try {
                const {data} = await axios({
                    method: 'POST',
                    url: '/gerenciador-cliente/cliente/cadastrar',
                    data: dados,
                    responseType: 'json'
                });
        
                if(data.status == 'sucesso'){
                    Swal.fire({
                        type: 'success',
                        title: 'Sucesso',
                        text: 'Cadastro realizado com sucesso, aguarde... estamos atualizando.',
                    });

                    setTimeout(() => location.reload(), 2500);
                }
                else{
                    Swal.fire({
                        type: 'danger',
                        title: 'Oops...',
                        text: 'Ocorreu algum erro, tente novamente mais tarde.',
                    });
                }
            } catch(e) {
                Swal.fire({
                    type: 'danger',
                    title: 'Oops...',
                    text: 'Ocorreu algum erro, tente novamente mais tarde.',
                });
            }
        }
    }
    else{
        Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: 'Preencha todos os campos',
        });
    }
})