<?php 

namespace App\controllers;

class ControllerHome extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['usuario'])){
			// Caso o usuário não esteja logado ele é direcionado para a tela de login.
            header('location: /gerenciador-cliente/login');
        }        
    }

	/**
	 * Renderiza a home.
	 */
    public function index()
	{
		// Array utilizado em layouts/header.php
		$array_css = [];    
		
		// Array utilizado em layouts/footer.php
		$array_js = [];  
		
		// Titulo utilizado em layouts/header.php
		$title = 'Controle de clientes - Home'; 

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("home", $title);
	}

}