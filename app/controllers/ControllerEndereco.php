<?php 

namespace App\controllers;
use App\models\EnderecoCliente;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class ControllerEndereco extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['usuario'])){
			// Caso o usuário não esteja logado ele é direcionado para a tela de login.
            header('location: /gerenciador-cliente/login');
        }        
    }
	
	/**
	 * Define as regras do microframework Respect/Validator
	 * https://respect-validation.readthedocs.io/en/latest/
	 */
	private function buscarValidatorDadosEndereco()
	{
		$validatorDadosEndereco = v::ArrayVal()
			->key('cep', v::notEmpty()->intVal())                                  
			->key('rua', v::notEmpty())                                  
			->key('numero', v::notEmpty())
			->key('bairro', v::notEmpty())          
			->key('cidade', v::notEmpty())
			->key('uf', v::notEmpty())
			->key('complemento',  v::notEmpty())
			->key('enderecoPrincipal',  v::notEmpty());
				
		return $validatorDadosEndereco;
	}

	/**
	 * Define as mensagens de erros do microframework Respect/Validator
	 * https://respect-validation.readthedocs.io/en/latest/feature-guide/#custom-messages
	 */
	private function buscarMensagensValidator()
	{
		return [
			'notEmpty' => '{{name}} não pode ser vázio',
			'intVal' => '{{name}} não é um valor válido',
		];
	}

    /**
	 * Edita as informações de um endereço especifico.
	 */
	public function editarEndereco()
	{
		// Busca as regras de validação para validar os dados que veio no POST.
		$validatorDadosEndereco = $this->buscarValidatorDadosEndereco();   

		try {
			$validatorDadosEndereco->assert($_POST);

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
					"status" => "sucesso",
					"mensagem" => "Endereço editado com sucesso"
				));
			}
			else{
				echo json_encode(array(
					"status" => "erro",
					"mensagem" => "Oops... Ocorreu algum erro"
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
	 * Exclui um endereço especifico.
	 */
	public function excluirEndereco()
	{
		$idEndereco = $_POST['idEndereco'];

		if(EnderecoCliente::excluir($idEndereco)){
			echo json_encode(array(
				"status" => "sucesso",
				"mensagem" => "Endereço excluído com sucesso"
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
	 * Adiciona um novo endereço para um cliente especifico.
	 */
	public function adicionarEndereco()
	{
		// Busca as regras de validação para validar os dados que veio no POST.
		$validatorDadosEndereco = $this->buscarValidatorDadosEndereco();   

		try {
			$validatorDadosEndereco->assert($_POST);

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
					"status" => "sucesso",
					"mensagem" => "Endereço adicionado com sucesso"
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
}
