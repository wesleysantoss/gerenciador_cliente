<?php 

namespace App\controllers;
use App\models\Cliente;
use App\models\EnderecoCliente;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

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
	 * Define as regras do microframework Respect/Validator
	 * https://respect-validation.readthedocs.io/en/latest/
	 */
	private function buscarValidatorDadosCliente()
	{
		$validatorDadosCliente = v::ArrayVal()
			->key('nome', v::notEmpty())                                    
			->key('cpf', v::notEmpty()->noWhitespace()->cpf())                                  
			->key('rg', v::notEmpty()->noWhitespace()->length(9,10)) 
			->key('telefone', v::notEmpty()->noWhitespace()->intVal())          
			->key('dataNascimento', v::notEmpty()->noWhitespace()->date());
				
		return $validatorDadosCliente;
	}

	/**
	 * Define as mensagens de erros do microframework Respect/Validator
	 * https://respect-validation.readthedocs.io/en/latest/feature-guide/#custom-messages
	 */
	private function buscarMensagensValidator()
	{
		return [
			'length' => '{{name}} não corresponde ao tamanho exigido',
			'cpf' => '{{name}} não é um CPF valido',
			'noWhitespace' => '{{name}} não pode conter espaços', 
			'notEmpty' => '{{name}} não pode ser vázio',
			'intVal' => '{{name}} não é um valor válido',
			'date' => '{{name}} não é uma data valida',
		];
	}

	/**
	 * Cadastra um novo cliente.
	 */
	public function cadastrar()
	{
		// Busca as regras de validação para validar os dados que veio no POST.
		$validatorDadosCliente = $this->buscarValidatorDadosCliente();          
				 
		try { 
			$validatorDadosCliente->assert($_POST);

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
		}catch (NestedValidationException $e){
			// Busca as mensagens de erros para a validação.
			$mensagens = $this->buscarMensagensValidator();
			$e->findMessages($mensagens);

			echo json_encode(array(
				"status" => "erro",
				"mensagem" => $e->getFullMessage()
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
		try {
			$id = $_POST['id'];
			$Cliente = new Cliente($id);
			echo json_encode($Cliente);
		} catch (\Exception $e){
			echo json_encode(array(
				"status" => "erro",
				"mensagem" => $e->getMessage()
			));
		}
	}

	/**
	 * Atualiza as informa as informações de um cliente.
	 */
	public function atualizar()
	{
		// Busca as regras de validação para validar os dados que veio no POST.
		$validatorDadosCliente = $this->buscarValidatorDadosCliente(); 

		try {
			$validatorDadosCliente->assert($_POST);
			
			$id = $_POST['id'];
			$Cliente = new Cliente($id);
	
			$Cliente->nome = $_POST['nome'];
			$Cliente->cpf = $_POST['cpf'];
			$Cliente->rg = $_POST['rg'];
			$Cliente->telefone = $_POST['telefone'];
			$Cliente->data_nascimento = $_POST['dataNascimento'];
	
			if($Cliente->atualizar()){
				echo json_encode(array(
					"status" => "sucesso",
					"mensagem" => "Dados atualizado com suceso"
				));
			}
			else{
				echo json_encode(array(
					"status" => "erro",
					"mensagem" => "Oops... Ocorreu algum erro."
				));
			}
		} catch (NestedValidationException $e){
			// Busca as mensagens de erros para a validação.
			$mensagens = $this->buscarMensagensValidator();
			$e->findMessages($mensagens);

			echo json_encode(array(
				"status" => "erro",
				"mensagem" => $e->getFullMessage()
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
				"status" => "sucesso",
				"mensagem" => "Cliente excluído com sucesso"
			));
		}
		else{
			echo json_encode(array(
				"status" => "erro",
				"mensagem" => "Oops... Ocorreu algum erro."
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
}
