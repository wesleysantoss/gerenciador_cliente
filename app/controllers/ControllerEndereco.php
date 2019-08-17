<?php 

namespace App\controllers;
use App\models\Cliente;
use App\models\EnderecoCliente;

class ControllerEndereco extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['usuario'])){
			// Caso o usuário não esteja logado ele é direcionado para a tela de login.
            header('location: /gerenciador-cliente/login');
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
