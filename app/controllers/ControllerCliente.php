<?php 

namespace App\controllers;
use App\models\Cliente;
use App\models\EnderecoCliente;

class ControllerCliente extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['usuario'])){
            header('location: /gerenciador-cliente/login');
        }        
    }

    public function index()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = ['libs/axios/axios.min.js', 'utils.js', 'cliente/cadastrar.js'];  
		
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Cadastrar'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("cliente/cadastrar", $title);
    }
    
    public function listar()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = [];  
		
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Listar'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("cliente/listar", $title);
	}

	public function cadastrar()
	{
		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$telefone = $_POST['telefone'];
		$dataNascimento = $_POST['dataNascimento'];

		$idCliente = Cliente::criar($nome, $cpf, $rg, $telefone, $dataNascimento);

		$totalEndereco = count($_POST['rua']);

		for($i = 0; $i <= $totalEndereco - 1; $i++){
			$rua = $_POST['rua'][$i];
			$numero = $_POST['numero'][$i];
			$bairro = $_POST['bairro'][$i];
			$cidade = $_POST['rua'][$i];
			$uf = $_POST['uf'][$i];
			$complemento = $_POST['complemento'][$i];
			$enderecoPrincipal = $_POST['principal'][$i];

			EnderecoCliente::criar($idCliente, $rua, $numero, $bairro, $cidade, $uf, $complemento, $enderecoPrincipal);
		}

		echo json_encode(array(
			"status" => "sucesso"
		));
	}
}