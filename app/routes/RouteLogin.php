<?php 

$array_routes['/gerenciador-cliente/login'] = array(    // Rota
    "controller" => "App\controllers\ControllerLogin",  // Controller 
    "action"     => "index"                             // Função 
);

return $array_routes;