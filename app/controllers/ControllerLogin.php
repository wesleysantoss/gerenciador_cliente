<?php

namespace App\controllers;

class ControllerLogin extends Controller
{
	public function index()
	{
		$array_css = [];                         // Array utilizado em layouts/header.php
		$array_js = ['utils.js', 'login.js'];    // Array utilizado em layouts/footer.php
		$title = 'Controle de clientes - Login'; // Titulo utilizado em layouts/header.php

		$this->css = $array_css;
		$this->js = $array_js;
		$this->view("login", $title);
	}

}