<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-12 col-md-10 painel">
            <div class="painel-titulo">
                <h2>
                    <i class="fas fa-user-edit"></i> Cadastro de cliente
                </h2>
                <p>
                    <i class="fas fa-info"></i> Preencha o formulário abaixo para cadastrar um novo cliente no sistema
                </p>
            </div>

            <div id="painel-dados-cliente">
                <div class="form-row mt-2">
                    <div class="col-12 col-md-12">
                        <label><b>*</b> Nome</label>
                        <input type="text" placeholder="Insira o nome" class="form-control" id="nome" maxlength="200" required>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col-12 col-md-6">
                        <label>
                            <b>*</b> CPF
                            <small>(Sem ponto e traço)</small>
                        </label>
                        <input type="text" placeholder="Insira o CPF" class="form-control" id="cpf" maxlength="11" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label>
                            <b>*</b> RG
                            <small>(Sem ponto e traço)</small>
                        </label>
                        <input type="text" placeholder="Insira o RG" class="form-control" id="rg" maxlength="10" required>
                    </div>
                </div>

                <div class="form-row mt-2">
                    <div class="col-12 col-md-6">
                        <label><b>*</b> Telefone</label>
                        <input type="text" placeholder="Insira o telefone" class="form-control" id="telefone" maxlength="11" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label><b>*</b> Data de nascimento</label>
                        <input type="date" class="form-control" id="data-nascimento" required>
                    </div>
                </div>  
            </div> 

            <div id="painel-endereco"></div>

            <div class="form-row mt-2 mt-2 mb-2">
                <div class="col-12 col-md-12">
                    <button id="btn-cadastrar" class="btn btn-principal">Cadastrar</button>
                    <button type="button" data-toggle="modal" data-target="#modal-endereco" class="btn btn-secundario">
                        Adicionar endereço
                    </button>
                </div>
            </div>      
        </div>
    </div>
</div>

<div class="modal fade" id="modal-endereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title titulo-principal">Formulário de endereço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="painel-novo-endereco"> 
            <div class="form-row mt-2">
                <div class="col-12 col-md-12">
                    <label><b>*</b> CEP</label>
                    <input type="number" placeholder="Insira o CEP" class="form-control" id="cep" maxlength="20" required>
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-12 col-md-6">
                    <label><b>*</b> Rua</label>
                    <input type="text" placeholder="Insira a rua" class="form-control" id="rua" maxlength="100" required>
                </div>

                <div class="col-12 col-md-6">
                    <label><b>*</b> Número</label>
                    <input type="number" placeholder="Insira o número" class="form-control" id="numero" required>
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-12 col-md-5">
                    <label><b>*</b> Bairro</label>
                    <input type="text" placeholder="Insira o bairro" class="form-control" id="bairro" maxlength="100" required>
                </div>

                <div class="col-12 col-md-5">
                    <label><b>*</b> Cidade</label>
                    <input type="text" placeholder="Insira a idade" class="form-control" id="cidade" maxlength="50" required>
                </div>

                <div class="col-12 col-md-2">
                    <label><b>*</b> UF</label>
                    <input type="text" placeholder="Insira o UF" class="form-control" id="uf" maxlength="2" required>
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-12 col-md-12">
                    <label>Complemento</label>
                    <input type="text" placeholder="Insira o complemento" class="form-control" id="complemento" maxlength="200">
                </div>
            </div>

            <div class="form-row mt-2">
                <div class="col-12 col-md-12">
                    <input type="checkbox" id="endereco-principal">
                    <label>Endereço principal</label>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" id="btn-novo-endereco" class="btn btn-success">Salvar</button>
      </div>
    </div>
  </div>
</div>