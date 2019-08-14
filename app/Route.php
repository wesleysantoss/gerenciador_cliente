<?php

class Route 
{
	private $routes;         
	private $https = false; 

	/**
	 * Inicia a aplicação
	 */
	public function initApp()
	{
		$this->initRoutes();
		$this->run($this->getUrl());
	}
	
	/**
	 * Busca todas as rotas possíveis do sistema e coloca no atributo $routes
	 */
	private function initRoutes()
	{	
		$RouteLogin = require_once(__DIR__ . "/routes/RouteLogin.php");

		$array_routes = array_merge($RouteLogin);
		$this->routes = $array_routes;
	}

	/**
	 * Identifica qual é o controller responsavel pela URL passada por parametro 
	 * e invoca a função do controller.
	 * @param $url
	 */
	private function run($url)
	{	
		if(!empty($this->routes[$url])){
			$Controller = new $this->routes[$url]['controller'];
			$action     = $this->routes[$url]['action'];
			$Controller->$action();
		}
		else{
			echo "<br>";
			echo "Erro ao acessar a url <b>{$url}</b> <br>";
			echo "ERRO 404";
		}
	}

	/**
	 * Retorna a URL que o usuário tentou acessar.
	 * @return String url.
	 */
	private function getUrl()
	{
		if($this->https){
			if (isset($_SERVER['HTTPS'])) {
				return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			}
			else{
				header('location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			}
		}
		else{
			if (isset($_SERVER['HTTPS'])){
				header('location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
			}
			else{
				return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
			}
		}
	}
}
