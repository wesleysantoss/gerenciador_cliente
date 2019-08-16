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
                    <a href="#">Visualizar</a>
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