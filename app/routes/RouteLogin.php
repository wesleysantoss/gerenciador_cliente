<?php 

$array_routes['/gerenciador-cliente/login'] = array(    // Rota
    "controller" => "App\controllers\ControllerLogin",  // Controller 
    "action"     => "index"                             // Função 
);

$array_routes['/gerenciador-cliente/login/autenticar'] = array(  // Rota
    "controller" => "App\controllers\ControllerLogin",           // Controller 
    "action"     => "autenticar"                                 // Função 
);

$array_routes['/gerenciador-cliente/login/sair'] = array(  // Rota
    "controller" => "App\controllers\ControllerLogin",     // Controller 
    "action"     => "sair"                                 // Função 
);

return $array_routes;