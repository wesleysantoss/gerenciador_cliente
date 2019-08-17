<?php 

namespace App\controllers;
use App\models\Cliente;
use App\models\EnderecoCliente;

class ControllerCliente extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['usuario'])){
			// Caso o usuário não esteja logado ele é direcionado para a tela de login.
            header('location: /gerenciador-cliente/login');
        }        
    }

	/**
	 * Renderiza a tala de cadastrar novos clientes.
	 */
    public function index()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = ['libs/sweetalert/sweetalert.js', 'libs/axios/axios.min.js', 'utils.js', 'cliente/cadastrar.js'];  
		
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Cadastrar'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("cliente/cadastrar", $title);
    }
    
    public function pageListar()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = ['libs/sweetalert/sweetalert.js', 'libs/axios/axios.min.js', 'utils.js', 'cliente/listar.js'];  
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Listar'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("cliente/listar", $title);
	}

	/**
	 * Cadastra um novo cliente
	 */
	public function cadastrar()
	{
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$telefone = $_POST['telefone'];
		$dataNascimento = $_POST['dataNascimento'];

		// Função retorna o ID do cliente que foi criado.
		$idCliente = Cliente::criar($nome, $cpf, $rg, $telefone, $dataNascimento);
 
		if($idCliente > 0 && $idCliente != null){
			// Identifica o total de endereços que existe no array.
			$totalEndereco = count($_POST['rua']);

			$statusEndereco = true;
			for($i = 0; $i <= $totalEndereco - 1; $i++){
				// Percorre todos os endereços.
				$cep = $_POST['cep'][$i];
				$rua = $_POST['rua'][$i];
				$numero = $_POST['numero'][$i];
				$bairro = $_POST['bairro'][$i];
				$cidade = $_POST['rua'][$i];
				$uf = $_POST['uf'][$i];
				$complemento = $_POST['complemento'][$i];
				$enderecoPrincipal = $_POST['principal'][$i];
	
				$retornoEndereco = EnderecoCliente::criar($idCliente, $cep, $rua, $numero, $bairro, $cidade, $uf, $complemento, $enderecoPrincipal);

				if(!$retornoEndereco){
					// Tratamento para identificar se algum endereço falhou na criação.
					$statusEndereco = false;
				}
			}

			$mensagem = "";
			if(!$statusEndereco){
				$mensagem = ", mas ocorreu falha na criação de um dos endereços.";
			}

			echo json_encode(array(
				"status" => "sucesso",
				"mensagem" => "Cadastro realizado com sucesso {$mensagem}"
			));
		}
		else{
			echo json_encode(array(
				"status" => "sucesso",
				"mensagem" => "Ocorreu algum erro ao cadastrar o cliente"
			));
		}
	}

	/**
	 * Busca todos os clientes que existem na base.
	 */
	public function listarTodos()
	{
		$clientes = Cliente::buscarTodos();
		echo json_encode($clientes);
	}

	/**
	 * Busca um cliente especifico pelo seu ID.
	 */
	public function listar()
	{
		$id = $_POST['id'];
		$Cliente = new Cliente($id);
		echo json_encode($Cliente);
	}

	/**
	 * Atualiza as informa as informações de um cliente.
	 */
	public function atualizar()
	{
		$id = $_POST['id'];

		$Cliente = new Cliente($id);

		$Cliente->nome = $_POST['nome'];
		$Cliente->cpf = $_POST['cpf'];
		$Cliente->rg = $_POST['rg'];
		$Cliente->telefone = $_POST['telefone'];
		$Cliente->data_nascimento = $_POST['dataNascimento'];

		if($Cliente->atualizar()){
			echo json_encode(array(
				"status" => "sucesso"
			));
		}
		else{
			echo json_encode(array(
				"status" => "algo de errado"
			));
		}
	}

	/**
	 * Exclui um cliente especifico.
	 */
	public function excluir()
	{
		$id = $_POST['id'];

		if(Cliente::excluir($id)){
			echo json_encode(array(
				"status" => "sucesso"
			));
		}
		else{
			echo json_encode(array(
				"status" => "algo de errado"
			));
		}
	}
}
