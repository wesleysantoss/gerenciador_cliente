<?php

namespace App\controllers;
use App\models\Usuario;

class ControllerLogin extends Controller
{
	public function index()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = ['libs/axios/axios.min.js', 'utils.js', 'login.js'];  
		
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Login'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("login", $title);
	}

	public function autenticar()
	{
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		if(Usuario::autenticar($email, $senha)){
			$Usuario = new Usuario($email);

			$_SESSION['usuario']['email'] = $Usuario->email;
			$_SESSION['usuario']['nome'] = $Usuario->nome;

			echo json_encode(array(
				"status" => "sucesso"
			));
		}
		else{
			echo json_encode(array(
				"status" => "erro"
			));
		}
	}

	public function sair()
	{
		session_destroy();
		header('location: /gerenciador-cliente/login');
	}
}