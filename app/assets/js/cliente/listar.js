window.onload = function(){
    buscarDados();
}

/**
 * Gera uma tabela com os dados do clientes
 */
const gerarTabelaHtmlClientes = data => {
    let html = ``;

    if(data.length > 0){
        html += `
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="background: #ecf0f1">Nome</th>
                    <th style="background: #ecf0f1">CPF</th>
                    <th style="background: #ecf0f1">RG</th>
                    <th style="background: #ecf0f1">Telefone</th>
                    <th style="background: #ecf0f1">Data nasc.</th>
                    <th style="background: #ecf0f1">Data cadastrado</th>
                    <th style="background: #ecf0f1">Endereços</th>
                    <th style="background: #ecf0f1">Opções</th>
                </tr>
            </thead>
            <tbody>
        `;
    
        for(let cliente of data){
            const dataNascimentoFormatoBr = formatarDataSqlParaBr(cliente.data_nascimento);
            const dataCadastroFormatoBr = formatarTimesTampSqlParaBr(cliente.data_cadastro);

            html += `
            <tr>
                <th>${cliente.nome}</th>
                <td>${cliente.cpf}</td>
                <td>${cliente.rg}</td>
                <td>${cliente.telefone}</td>
                <th>${dataNascimentoFormatoBr}</th>
                <td>${dataCadastroFormatoBr}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="#" id="btn-visualizar-endereco" data-id="${cliente.id}">
                        <i class="fas fa-eye"></i> Visualizar
                    </a>
                    <br>
                    <a class="btn btn-success btn-sm mt-1" href="#" id="btn-adicionar-endereco" data-id="${cliente.id}">
                        <i class="fas fa-plus-circle"></i> Adicionar
                    </a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="#" id="btn-editar" data-id="${cliente.id}">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </a>
                    <br>
                    <a class="btn btn-danger btn-sm mt-1" href="#" id="btn-excluir" data-id="${cliente.id}">
                        <i class="fas fa-trash"></i> Excluir
                    </a>
                </td>
            </tr>
            `;
        }
        
        html += `  
            </tbody>
        </table>
        </div>`;
    }
    else{
        html = `<h4>Nenhum cliente cadastrado</h4>`;
    }

    return html;
}

/**
 * Gera um HTML com todos os endereços do cliente.
 */
const gerarHtmlListaDeEnderecosCliente = data => {
    let html = ``;

    if(data.length > 0){
        for(let dados of data){
            html += `
            <div id="painel-enderecos" style="background: #ecf0f1 ; padding: 10px ; margin-top: 20px ; border-radius: 5px">
                <div class="form-row">
                    <div class="col-12 col-md-12">
                        <label>CEP</label>
                        <input type="text" placeholder="Insira o cep" class="form-control" id="painel-lista-cep" maxlength="100" value="${dados.cep}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-12 col-md-6">
                        <label>Rua</label>
                        <input type="text" placeholder="Insira a rua" class="form-control" id="painel-lista-rua" maxlength="100" value="${dados.rua}" required>
                    </div>
    
                    <div class="col-12 col-md-6">
                        <label>Número</label>
                        <input type="number" placeholder="Insira o número" class="form-control" id="painel-lista-numero" value="${dados.numero}" required>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-12 col-md-5">
                        <label>Bairro</label>
                        <input type="text" placeholder="Insira o bairro" class="form-control" id="painel-lista-bairro" maxlength="100" value="${dados.bairro}" required>
                    </div>
    
                    <div class="col-12 col-md-5">
                        <label>* Cidade</label>
                        <input type="text" placeholder="Insira a idade" class="form-control" id="painel-lista-cidade" maxlength="50" value="${dados.cidade}" required>
                    </div>
    
                    <div class="col-12 col-md-2">
                        <label>UF</label>
                        <input type="text" placeholder="Insira o UF" class="form-control" id="painel-lista-uf" maxlength="2" value="${dados.estado}" required>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-12 col-md-12">
                        <label>Complemento</label>
                        <input type="text" placeholder="Insira o complemento" class="form-control" id="painel-lista-complemento" maxlength="200" value="${dados.complemento}">
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-12 col-md-12">
                        <input type="checkbox" id="painel-lista-endereco-principal" ${dados.endereco_principal == 'Sim' ? 'checked' : ''}>
                        <label>Endereço principal</label>
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="col-12 col-md-12">
                        <button type="button" id="btn-editar-endereco" data-id="${dados.id}" class="btn btn-success btn-sm">Editar</button>
                        <button type="button" id="btn-excluir-endereco" data-id="${dados.id}" class="btn btn-danger btn-sm">Excluir</button>
                    </div>
                </div>
            </div>
            `;
        }
    }
    else{
        html = `Nenhum endereço cadastrado`;
    }

    return html;
}

/**
 * Busca todos os clientes que tem na base de dados
 */
const buscarDados = async function(){
    const $listaClientes = document.querySelector('#lista-clientes');

    $listaClientes.innerHTML = 'Buscando dados...';

    try {
        const {data} = await axios('/gerenciador-cliente/cliente/listarTodos');

        // Gera o html com os dados dos clientes
        const html = gerarTabelaHtmlClientes(data);

        $listaClientes.innerHTML = html;
    } catch(e){
        Swal.fire({
            type: 'warning',
            title: 'Oops...',
            text: 'Ocorreu algum erro.',
        });

        $listaClientes.innerHTML = '';
    }
}


document.querySelector("#editar-cpf").onkeypress = validarNumero;
document.querySelector("#editar-rg").onkeypress = validarNumero;
document.querySelector("#editar-telefone").onkeypress = validarNumero;

/**
 * Sempre que o foco sair do CEP
 */
document.querySelector("#painel-adicionar-cep").addEventListener("change", async function(){
    // Consome a API do via cep para completar o endereço.
    const cep = this.value;

    try {
        const resultado = await buscarEnderecoPorCep(cep);
        if(resultado !== false){
            const {bairro, localidade, logradouro, uf} = resultado;
            const $modalAdicionarEndereco = document.querySelector("#modal-adicionar-endereco");
            
            $modalAdicionarEndereco.querySelector("#painel-adicionar-bairro").value = bairro;
            $modalAdicionarEndereco.querySelector("#painel-adicionar-cidade").value = localidade;
            $modalAdicionarEndereco.querySelector("#painel-adicionar-rua").value = logradouro;
            $modalAdicionarEndereco.querySelector("#painel-adicionar-uf").value = uf;
        }
    } catch (e){
        console.log('Error: ', e);
    }
})

/**
 * Quando é clicado para editar as info de um cliente
 */
document.querySelector("#lista-clientes").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-editar'){
        const idCliente = $this.dataset.id;
        const dados = new FormData();
        
        dados.append('id', idCliente);

        try {
            const {data} = await axios({
                method: 'POST',
                url: '/gerenciador-cliente/cliente/listar',
                data: dados,
                responseType: 'json'
            });

            const $painelEditarDados = document.querySelector("#painel-editar-dados");
            const $modalEditarCliente = $("#modal-editar-cliente");

            $painelEditarDados.querySelector("#editar-id").value = idCliente;
            $painelEditarDados.querySelector("#editar-nome").value = data.nome;
            $painelEditarDados.querySelector("#editar-cpf").value = data.cpf;
            $painelEditarDados.querySelector("#editar-rg").value = data.rg;
            $painelEditarDados.querySelector("#editar-telefone").value = data.telefone;
            $painelEditarDados.querySelector("#editar-data-nascimento").value = data.dataNascimento;

            $modalEditarCliente.modal('show');
        } catch(e){
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Ocorreu algum erro.',
            });
        }
    }
})

/**
 * Quando é clicado para salvar os dados de um cliente que está sendo editado.
 */
document.querySelector("#btn-salvar-editar-dados").addEventListener("click", async function(){
    const $painelEditarDados = document.querySelector("#painel-editar-dados");

    // Valida se todos os campos do formulario foram preenchidos.
    const validarFormularioDados = validarFormulario.call($painelEditarDados);

    if(validarFormularioDados){
        const id = $painelEditarDados.querySelector("#editar-id").value;
        const nome = $painelEditarDados.querySelector("#editar-nome").value;
        const cpf = $painelEditarDados.querySelector("#editar-cpf").value;
        const rg = $painelEditarDados.querySelector("#editar-rg").value;
        const telefone = $painelEditarDados.querySelector("#editar-telefone").value;
        const dataNascimento = $painelEditarDados.querySelector("#editar-data-nascimento").value;
    
        const formData = new FormData();
    
        formData.append('id', id);
        formData.append('nome', nome);
        formData.append('cpf', cpf);
        formData.append('rg', rg);
        formData.append('telefone', telefone);
        formData.append('dataNascimento', dataNascimento);
    
        try {
            const {data} = await axios({
                method: 'post',
                url: '/gerenciador-cliente/cliente/atualizar',
                data: formData,
                responseType: 'json'
            });
    
            if(data.status == 'sucesso'){
                Swal.fire({
                    type: 'success',
                    title: 'Sucesso',
                    text: 'Operação realizada com sucesso, aguarde... estamos atualizando.',
                });

                setTimeout(() => location.reload(), 2100);
            }
            else{
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: data.mensagem,
                });
            }
        } catch(e){
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Ocorreu algum erro',
            });
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

/**
 * Quando é clicado para excluir um cliente.
 */
document.querySelector("#lista-clientes").addEventListener("click", function(e){
    const $this = e.target;

    if($this.id === 'btn-excluir'){
        Swal.fire({
            title: 'Oops',
            text: "Deseja realmente excluir um registro?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Não'
          }).then(async result => {
            if (result.value) {
                const idCliente = $this.dataset.id;
                const formData = new FormData();
        
                formData.append('id', idCliente);
                
                try {
                    const {data} = await axios({
                        method: 'post',
                        url: '/gerenciador-cliente/cliente/excluir',
                        data: formData,
                        responseType: 'json'
                    });
                    
                    if(data.status == 'sucesso'){
                        Swal.fire(
                            'Excluído',
                            'Registro excluído com sucesso, aguarde... estamos atualizando',
                            'success'
                        );

                        setTimeout(() => location.reload(), 2500);
                    }
                    else{
                        Swal.fire({
                            type: 'warning',
                            title: 'Oops...',
                            text: data.mensagem,
                        });
                    }
                } catch(e){
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Ocorreu algum erro.',
                    });
                }
            }
        })
    }
})

/**
 * Quando é clicado para adicionar um novo endereço.
 */
document.querySelector("#lista-clientes").addEventListener("click", function(e){
    const $this = e.target;

    if($this.id === 'btn-adicionar-endereco'){
        const idCliente = $this.dataset.id;
        const $modal = $("#modal-adicionar-endereco");

        // Coloca o ID do elemento clicado em um campo hidden.
        document.querySelector('#painel-adicionar-id-cliente').value = idCliente;
        $modal.modal('show');
    }
})

/**
 * Quando é clicado para adicionar um novo endereço a um cliente.
 */
document.querySelector("#btn-adicionar-endereco").addEventListener("click", async function(){
    const $painelAdicionarEndereco = document.querySelector("#painel-adicionar-endereco");

    // Valida se todos os campos foram preenchidos.
    const validarAdicionarEndereco = validarFormulario.call($painelAdicionarEndereco);

    if(validarAdicionarEndereco){
        const idCliente = $painelAdicionarEndereco.querySelector("#painel-adicionar-id-cliente").value;
        const cep = $painelAdicionarEndereco.querySelector("#painel-adicionar-cep").value;
        const rua = $painelAdicionarEndereco.querySelector("#painel-adicionar-rua").value;
        const numero = $painelAdicionarEndereco.querySelector("#painel-adicionar-numero").value;
        const bairro = $painelAdicionarEndereco.querySelector("#painel-adicionar-bairro").value;
        const cidade = $painelAdicionarEndereco.querySelector("#painel-adicionar-cidade").value;
        const uf = $painelAdicionarEndereco.querySelector("#painel-adicionar-uf").value;
        const complemento = $painelAdicionarEndereco.querySelector("#painel-adicionar-complemento").value;
        const enderecoPrincipal = $painelAdicionarEndereco.querySelector("#painel-adicionar-endereco-principal").checked == true ? 'Sim' : 'Não';

        const dados = new FormData();

        dados.append('idCliente', idCliente);
        dados.append('cep', cep);
        dados.append('rua', rua);
        dados.append('numero', numero);
        dados.append('bairro', bairro);
        dados.append('cidade', cidade);
        dados.append('uf', uf);
        dados.append('complemento', complemento);
        dados.append('enderecoPrincipal', enderecoPrincipal);

        try {
            const {data} = await axios({
                method: 'post',
                url: '/gerenciador-cliente/endereco/adicionar',
                data: dados,
                responseType: 'json'
            });

            if(data.status == 'sucesso'){
                Swal.fire({
                    type: 'success',
                    title: 'Sucesso',
                    text: 'Operação realizada com sucesso, aguarde... estamos atualizando',
                });

                setTimeout(() => location.reload(), 2100);
            }
            else{
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: data.mensagem,
                });
            }
        } catch (e){
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Ocorreu algum erro.',
            });
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

/**
 * Quando é clicado para buscar todos os endereços do cliente.
 */
document.querySelector("#lista-clientes").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-visualizar-endereco'){
        const $modal = $("#modal-listar-endereco");
        const $painelEndereco = document.querySelector("#painel-listar-endereco");
        const idCliente = $this.dataset.id;
        const dados = new FormData();

        dados.append('id', idCliente);
        
        try {
            const {data} = await axios({
                method: 'post',
                url: '/gerenciador-cliente/cliente/endereco/listar',
                data: dados,
                responseType: 'json'
            });
    
            const html = gerarHtmlListaDeEnderecosCliente(data);

            $painelEndereco.innerHTML = html;
            $modal.modal('show');
        } catch(e){
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Ocorreu algum erro.',
            });
        }
    }
})

/**
 * Eventos que ocorrem dentro do modal com todos os endereços do cliente.
 * Usuário pode editar um endereço especifico ou excluir.
 */
document.querySelector("#modal-listar-endereco").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-editar-endereco'){
        // Usuário clicou no botão de editar endereço.

        const idEndereco = $this.dataset.id;
        const $painelEditarDados = $this.parentNode.parentNode.parentNode;

        // Valida se todos os campos foram preenchidos.
        const validarFormularioEditarDados = validarFormulario.call($painelEditarDados);

        if(validarFormularioEditarDados){
            const cep = $painelEditarDados.querySelector("#painel-lista-cep").value;
            const rua = $painelEditarDados.querySelector("#painel-lista-rua").value;
            const numero = $painelEditarDados.querySelector("#painel-lista-numero").value;
            const bairro = $painelEditarDados.querySelector("#painel-lista-bairro").value;
            const cidade = $painelEditarDados.querySelector("#painel-lista-cidade").value;
            const uf = $painelEditarDados.querySelector("#painel-lista-uf").value;
            const complemento = $painelEditarDados.querySelector("#painel-lista-complemento").value;
            const enderecoPrincipal = $painelEditarDados.querySelector("#painel-lista-endereco-principal").checked == true ? 'Sim' : 'Não';

            const dados = new FormData();

            dados.append('idEndereco', idEndereco);
            dados.append('cep', cep);
            dados.append('rua', rua);
            dados.append('numero', numero);
            dados.append('bairro', bairro);
            dados.append('cidade', cidade);
            dados.append('uf', uf);
            dados.append('complemento', complemento);
            dados.append('enderecoPrincipal', enderecoPrincipal);

            try {
                const {data} = await axios({
                    method: 'post',
                    url: '/gerenciador-cliente/endereco/editar',
                    data: dados,
                    responseType: 'json'
                });

                if(data.status == 'sucesso'){
                    Swal.fire({
                        type: 'success',
                        title: 'Sucesso',
                        text: 'Operação realizada com sucesso',
                    });
                }
                else{
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: data.mensagem,
                    });
                }
            } catch (e){
                console.log('Error: ', e);
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: 'Ocorreu algum erro',
                });
            }
        }
        else{
            alert('Oops, preencha todos os campos para editar');
        }
    }
    else if($this.id === 'btn-excluir-endereco'){
        // Usuário clicou na opção de excluir o endereço do cliente.
        Swal.fire({
            title: 'Oops...',
            text: "Deseja realmente excluir o endereço?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Não'
        }).then(async result => {
            if (result.value) {
                const idEndereco = $this.dataset.id;
                const $painelEditarDados = $this.parentNode.parentNode.parentNode;
                const dados = new FormData();
        
                dados.append('idEndereco', idEndereco);
        
                try {
                    const {data} = await axios({
                        method: 'post',
                        url: '/gerenciador-cliente/endereco/excluir',
                        data: dados,
                        responseType: 'json'
                    });

                    if(data.status == 'sucesso'){
                        Swal.fire(
                            'Excluído',
                            'Endereço excluído com sucesso',
                            'success'
                        );

                        $painelEditarDados.remove();
                    }
                    else{
                        Swal.fire({
                            type: 'warning',
                            title: 'Oops...',
                            text: data.mensagem,
                        });
                    }
                } catch (e){
                    Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: 'Ocorreu algum erro',
                    });
                }
            }
        });
    }
})