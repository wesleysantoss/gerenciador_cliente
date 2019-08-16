window.onload = function(){
    buscarDados();
}

/**
 * Gera uma tabela com os dados do clientes
 */
const gerarHtmlDados = dados => {
    const {data} = dados;
    let html = ``;

    if(data.length > 0){
        html += `
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Telefone</th>
                    <th>Data de nasc.</th>
                    <th>Data cadastrado</th>
                    <th>Endereços</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
        `;
    
        for(let cliente of data){
            html += `
            <tr>
                <th>${cliente.nome}</th>
                <td>${cliente.cpf}</td>
                <td>${cliente.rg}</td>
                <td>${cliente.telefone}</td>
                <th>${cliente.data_nascimento}</th>
                <td>${cliente.data_cadastro}</td>
                <td>
                    <a href="#" id="btn-visualizar-endereco" data-id="${cliente.id}">Visualizar</a>
                    <a href="#" id="btn-adicionar-endereco" data-id="${cliente.id}">Adicionar</a>
                </td>
                <td>
                    <a href="#" id="btn-editar" data-id="${cliente.id}">Editar</a> <br>
                    <a href="#" id="btn-excluir" data-id="${cliente.id}">Excluir</a>
                </td>
            </tr>
            `;
        }
        
        html += `  
            </tbody>
        </table>`;
    }
    else{
        html = `<h4>Nenhum cliente cadastrado</h4>`;
    }

    return html;
}

/**
 * Busca todos os clientes
 */
const buscarDados = async function(){
    try {
        const $listaClientes = document.querySelector('#lista-clientes');
        const resultado = await axios('/gerenciador-cliente/cliente/listarTodos');
        const html = gerarHtmlDados(resultado);

        $listaClientes.innerHTML = html;
    } catch(e){
        alert('Oops, ocorreu algum erro. Tente novamente mais tarde');
    }
}

document.querySelector("#lista-clientes").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-editar'){
        const idCliente = $this.dataset.id;
        const formData = new FormData();
        const $painelEditarDados = document.querySelector("#painel-editar-dados");

        formData.append('id', idCliente);

        try {
            const resultado = await axios({
                method: 'POST',
                url: '/gerenciador-cliente/cliente/listar',
                data: formData,
                responseType: 'json'
            });
    
            const {data} = resultado;
            
            let html = `
                <input type="hidden" id="editar-id" value="${idCliente}">

                <input type="text" id="editar-nome" class="form-control" value="${data.nome}">
    
                <input type="text" id="editar-cpf" class="form-control" value="${data.cpf}">
    
                <input type="text" id="editar-rg" class="form-control" value="${data.rg}">
    
                <input type="text" id="editar-telefone" class="form-control" value="${data.telefone}">
    
                <input type="date" id="editar-data-nascimento" class="form-control" value="${data.dataNascimento}">
            `;
    
            $painelEditarDados.innerHTML = html;
            $("#modal-editar-cliente").modal('show');
        } catch(e){
            console.log(e);
        }

    }
})

document.querySelector("#btn-salvar-editar-dados").addEventListener("click", async function(){
    const $modal = document.querySelector("#modal-editar-cliente");
    const id = $modal.querySelector("#editar-id").value;
    const nome = $modal.querySelector("#editar-nome").value;
    const cpf = $modal.querySelector("#editar-cpf").value;
    const rg = $modal.querySelector("#editar-rg").value;
    const telefone = $modal.querySelector("#editar-telefone").value;
    const dataNascimento = $modal.querySelector("#editar-data-nascimento").value;

    const formData = new FormData();

    formData.append('id', id);
    formData.append('nome', nome);
    formData.append('cpf', cpf);
    formData.append('rg', rg);
    formData.append('telefone', telefone);
    formData.append('dataNascimento', dataNascimento);

    try {
        const resultado = await axios({
            method: 'post',
            url: '/gerenciador-cliente/cliente/atualizar',
            data: formData,
            responseType: 'json'
        });

        const {data} = resultado;
        console.log(data);
    } catch(e){
        console.log(e);
    }
})

document.querySelector("#lista-clientes").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-excluir'){
        const idCliente = $this.dataset.id;
        const formData = new FormData();

        formData.append('id', idCliente);
        
        try {
            const resultado = await axios({
                method: 'post',
                url: '/gerenciador-cliente/cliente/excluir',
                data: formData,
                responseType: 'json'
            });
    
            const {data} = resultado;
            console.log(data);
        } catch(e){
            console.log(e);
        }
    }
})

document.querySelector("#lista-clientes").addEventListener("click", function(e){
    const $this = e.target;

    if($this.id === 'btn-adicionar-endereco'){
        const idCliente = $this.dataset.id;
        const $modal = $("#modal-adicionar-endereco");

        document.querySelector('#painel-adicionar-id-cliente').value = idCliente;
        $modal.modal('show');
    }
})

document.querySelector("#btn-adicionar-endereco").addEventListener("click", async function(){
    const $painelAdicionarEndereco = document.querySelector("#painel-adicionar-endereco");
    const validarAdicionarEndereco = validarFormulario.call($painelAdicionarEndereco);

    if(validarAdicionarEndereco){
        const idCliente = $painelAdicionarEndereco.querySelector("#painel-adicionar-id-cliente").value;
        const rua = $painelAdicionarEndereco.querySelector("#painel-adicionar-rua").value;
        const numero = $painelAdicionarEndereco.querySelector("#painel-adicionar-numero").value;
        const bairro = $painelAdicionarEndereco.querySelector("#painel-adicionar-bairro").value;
        const cidade = $painelAdicionarEndereco.querySelector("#painel-adicionar-cidade").value;
        const uf = $painelAdicionarEndereco.querySelector("#painel-adicionar-uf").value;
        const complemento = $painelAdicionarEndereco.querySelector("#painel-adicionar-complemento").value;
        const enderecoPrincipal = $painelAdicionarEndereco.querySelector("#painel-adicionar-endereco-principal").checked == true ? 'Sim' : 'Não';

        const formData = new FormData();

        formData.append('idCliente', idCliente);
        formData.append('rua', rua);
        formData.append('numero', numero);
        formData.append('bairro', bairro);
        formData.append('cidade', cidade);
        formData.append('uf', uf);
        formData.append('complemento', complemento);
        formData.append('enderecoPrincipal', enderecoPrincipal);

        try {
            const resultado = await axios({
                method: 'post',
                url: '/gerenciador-cliente/cliente/endereco/adicionar',
                data: formData,
                responseType: 'json'
            });

            const {data} = resultado;
            console.log(data);

        } catch (e){
            console.log('Error: ', e);
        }
    }
    else{
        alert('Oops, preencha todos os campos');
    }
})

document.querySelector("#lista-clientes").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-visualizar-endereco'){
        const $modal = $("#modal-listar-endereco");
        const $painelEndereco = document.querySelector("#painel-listar-endereco");
        const idCliente = $this.dataset.id;
        const formData = new FormData();

        formData.append('id', idCliente);
        
        try {
            const resultado = await axios({
                method: 'post',
                url: '/gerenciador-cliente/cliente/endereco/listar',
                data: formData,
                responseType: 'json'
            });
    
            const {data} = resultado;
            let html = ``;

            for(let dados of data){
                html += `
                <div id="painel-enderecos" style="background: #ecf0f1 ; padding: 5px ; margin-top: 10px ; border-radius: 5px">
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

            $painelEndereco.innerHTML = html;
            $modal.modal('show');
        } catch(e){
            console.log(e);
        }
    }
})

document.querySelector("#modal-listar-endereco").addEventListener("click", async function(e){
    const $this = e.target;

    if($this.id === 'btn-editar-endereco'){
        const idEndereco = $this.dataset.id;
        const $painelEditarDados = $this.parentNode.parentNode.parentNode;
        const validarFormularioEditarDados = validarFormulario.call($painelEditarDados);

        if(validarFormularioEditarDados){
            const rua = $painelEditarDados.querySelector("#painel-lista-rua").value;
            const numero = $painelEditarDados.querySelector("#painel-lista-numero").value;
            const bairro = $painelEditarDados.querySelector("#painel-lista-bairro").value;
            const cidade = $painelEditarDados.querySelector("#painel-lista-cidade").value;
            const uf = $painelEditarDados.querySelector("#painel-lista-uf").value;
            const complemento = $painelEditarDados.querySelector("#painel-lista-complemento").value;
            const enderecoPrincipal = $painelEditarDados.querySelector("#painel-lista-endereco-principal").checked == true ? 'Sim' : 'Não';

            const formData = new FormData();

            formData.append('idEndereco', idEndereco);
            formData.append('rua', rua);
            formData.append('numero', numero);
            formData.append('bairro', bairro);
            formData.append('cidade', cidade);
            formData.append('uf', uf);
            formData.append('complemento', complemento);
            formData.append('enderecoPrincipal', enderecoPrincipal);

            try {
                const resultado = await axios({
                    method: 'post',
                    url: '/gerenciador-cliente/cliente/endereco/editar',
                    data: formData,
                    responseType: 'json'
                });
    
                const {data} = resultado;
                console.log(data);
            } catch (e){
                console.log('ERROR', e);
            }
        }
        else{
            alert('Oops, preencha todos os campos para editar');
        }
    }
    else if($this.id === 'btn-excluir-endereco'){
        const idEndereco = $this.dataset.id;
        const formData = new FormData();

        formData.append('idEndereco', idEndereco);

        try {
            const resultado = await axios({
                method: 'post',
                url: '/gerenciador-cliente/cliente/endereco/excluir',
                data: formData,
                responseType: 'json'
            });

            const {data} = resultado;
            console.log(data);
        } catch (e){
            console.log('ERROR: ', e);
        }
    }


})