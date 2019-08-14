<?php

namespace App\controllers;

class Controller
{
	protected $css = []; // Array de CSS
	protected $js = [];  // Array de JS

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }

    public function __get($value)
    {
        return $value;
    }

    /**
     * Renderiza uma view na tela.
     * @param $view  - Nome da view a ser renderizada.
     * @param $title - Titulo da página, que é visivel na página.
     * @param $param - Caso queira mandar algum valor para a view mostrar.
     */
    public function view($view, $title, $param = null)
    {
    	$css = $this->css; // Variavel fica visivel no header.
    	$js = $this->js;  // Variavel fica visivel no footer.

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/' . $view . '.php';
        require_once 'app/views/layouts/footer.php';
    }

}
