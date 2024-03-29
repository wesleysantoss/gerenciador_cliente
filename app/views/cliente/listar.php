<div class="container">
    <div class="row d-flex justify-content-center mt-5">
      <div class="col-12 col-md-10 painel">
        <div class="painel-titulo">
            <h2>
            <i class="fas fa-users"></i> Listar clientes
            </h2>
            <p>
            <i class="fas fa-info"></i> Veja abaixo todos os clientes cadastrado
            </p>
        </div>
      
        <div id="lista-clientes"></div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal-editar-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title titulo-principal">Editar dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="painel-editar-dados">
        <input type="hidden" id="editar-id">
        <div class="form-row">
          <div class="col-12 col-md-12">
            <label><b>*</b> Nome</label>
            <input type="text" id="editar-nome" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-12">
            <label><b>*</b> CPF</label>
            <input type="text" id="editar-cpf" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-12">
            <label><b>*</b> RG</label>
            <input type="text" id="editar-rg" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-12">
            <label><b>*</b> Telefone</label>
            <input type="text" id="editar-telefone" class="form-control" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-12">
            <label><b>*</b> Data de nascimento</label>
            <input type="date" id="editar-data-nascimento" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" id="btn-salvar-editar-dados">Salvar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-adicionar-endereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title titulo-principal">Adicionar novo endereço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="painel-adicionar-endereco">
        <input type="hidden" id="painel-adicionar-id-cliente">

        <div class="form-row">
          <div class="col-12 col-md-12">
            <label>* CEP</label>
            <input type="number" placeholder="Insira o CEP" class="form-control" id="painel-adicionar-cep" maxlength="10" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-6">
            <label>* Rua</label>
            <input type="text" placeholder="Insira a rua" class="form-control" id="painel-adicionar-rua" maxlength="100" required>
          </div>

          <div class="col-12 col-md-6">
            <label>* Número</label>
            <input type="number" placeholder="Insira o número" class="form-control" id="painel-adicionar-numero" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-5">
            <label>* Bairro</label>
            <input type="text" placeholder="Insira o bairro" class="form-control" id="painel-adicionar-bairro" maxlength="100" required>
          </div>

          <div class="col-12 col-md-5">
            <label>* Cidade</label>
            <input type="text" placeholder="Insira a idade" class="form-control" id="painel-adicionar-cidade" maxlength="50" required>
          </div>

          <div class="col-12 col-md-2">
            <label>* UF</label>
            <input type="text" placeholder="Insira o UF" class="form-control" id="painel-adicionar-uf" maxlength="2" required>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-12">
            <label>Complemento</label>
            <input type="text" placeholder="Insira o complemento" class="form-control" id="painel-adicionar-complemento" maxlength="200">
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-md-12">
            <input type="checkbox" id="painel-adicionar-endereco-principal">
            <label>Endereço principal</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-success" id="btn-adicionar-endereco">Salvar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-listar-endereco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title titulo-principal" id="exampleModalLabel">Endereços</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="painel-listar-endereco">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>