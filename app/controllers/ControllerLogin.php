<?php

namespace App\controllers;
use App\models\Usuario;

class ControllerLogin extends Controller
{
	/**
	 * Renderiza a tela de login.
	 */
	public function index()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = ['libs/sweetalert/sweetalert.js', 'libs/axios/axios.min.js', 'utils.js', 'login.js'];  
		
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Login'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("login", $title);
	}

	/**
	 * Verifica se o usuário existe, caso sim cria a sessão no servidor.
	 */
	public function autenticar()
	{
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		if($this->validarUsuario($email, $senha)){
			if($this->iniciarSessao($email)){
				echo json_encode(array(
					"status" => "sucesso",
					"mensagem" => "Usuário autenticado com sucesso"
				));
			}
			else{
				echo json_encode(array(
					"status" => "erro",
					"mensagem" => "Oops, ocorreu algum erro."
				));
			}
		}
		else{
			echo json_encode(array(
				"status" => "erro",
				"mensagem" => "Usuário ou senha incorreto"
			));
		}
	}

	/**
	 * Inicia uma sessão no servidor para o usuário.
	 * @param $email - E-mail do usuário.
	 * @return Bool.
	 */
	public function iniciarSessao($email)
	{
		try {
			$Usuario = new Usuario($email);

			$_SESSION['usuario']['email'] = $Usuario->email;
			$_SESSION['usuario']['nome'] = $Usuario->nome;
	
			return true;
		} catch (Exception $e){
			return false;
		}
	}

	/**
	 * Valida se o usuário existe.
	 * @param $email - E-mail do usuário.
	 * @param $senha - Senha do usuário.
	 * @return Bool.
	 */
	public function validarUsuario($email, $senha)
	{
		return Usuario::autenticar($email, $senha);
	}

	/**
	 * Faz o logoff do usuário no sistema destruindo a sessão.
	 */
	public function sair()
	{
		session_destroy();
		header('location: /gerenciador-cliente/login');
	}
}