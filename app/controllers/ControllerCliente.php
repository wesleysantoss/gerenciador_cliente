<?php 

namespace App\controllers;
use App\models\Cliente;
use App\models\EnderecoCliente;
use App\config\ConnectionDB;

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

		$idCliente = Cliente::criar($nome, $cpf, $rg, $telefone, $dataNascimento);
 
		if($idCliente > 0 && $idCliente != null){
			$totalEndereco = count($_POST['rua']);

			for($i = 0; $i <= $totalEndereco - 1; $i++){
				$cep = $_POST['cep'][$i];
				$rua = $_POST['rua'][$i];
				$numero = $_POST['numero'][$i];
				$bairro = $_POST['bairro'][$i];
				$cidade = $_POST['rua'][$i];
				$uf = $_POST['uf'][$i];
				$complemento = $_POST['complemento'][$i];
				$enderecoPrincipal = $_POST['principal'][$i];
	
				EnderecoCliente::criar($idCliente, $cep, $rua, $numero, $bairro, $cidade, $uf, $complemento, $enderecoPrincipal);
			}

			echo json_encode(array(
				"status" => "sucesso",
				"mensagem" => "Cadastro realizado com sucesso"
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
	 * Busca todos os clientes que existe na base
	 */
	public function listarTodos()
	{
		$clientes = Cliente::buscarTodos();
		echo json_encode($clientes);
	}

	/**
	 * Lista um cliente especifico
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

	/**
	 * Busca todos os endereços de um cliente especifico.
	 */
	public function listarEndereco()
	{
		$id = $_POST['id'];

		$Cliente = new Cliente($id);
		$enderecos = $Cliente->buscarTodosEnderecos();

		echo json_encode($enderecos);
	}

	/**
	 * Edita as informações de um endereço especifico.
	 */
	public function editarEndereco()
	{
		$idEndereco = $_POST['idEndereco'];
		$cep = $_POST['cep'];
		$rua = $_POST['rua'];
		$numero = $_POST['numero'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$uf = $_POST['uf'];
		$complemento = $_POST['complemento'];
		$enderecoPrincipal = $_POST['enderecoPrincipal'];

		$resultado = EnderecoCliente::editar($idEndereco, $cep, $rua, $numero, $bairro, $cidade, $uf, $complemento, $enderecoPrincipal);

		if($resultado){
			echo json_encode(array(
				"status" => "sucesso"
			));
		}
		else{
			echo json_encode(array(
				"status" => "erro",
				"mensagem" => "Ocorreu algum erro"
			));
		}
	}

	/**
	 * Exclui um endereço especifico.
	 */
	public function excluirEndereco()
	{
		$idEndereco = $_POST['idEndereco'];

		if(EnderecoCliente::excluir($idEndereco)){
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
	 * Adiciona um novo endereço para um cliente especifico.
	 */
	public function adicionarEndereco()
	{
		$idCliente = $_POST['idCliente'];
		$cep = $_POST['cep'];
		$rua = $_POST['rua'];
		$numero = $_POST['numero'];
		$bairro = $_POST['bairro'];
		$cidade = $_POST['cidade'];
		$uf = $_POST['uf'];
		$complemento = $_POST['complemento'];
		$enderecoPrincipal = $_POST['enderecoPrincipal'];

		$resultado = EnderecoCliente::criar($idCliente, $cep, $rua, $numero, $bairro, $cidade, $uf, $complemento, $enderecoPrincipal);

		if($resultado){
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
