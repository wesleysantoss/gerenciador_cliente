<?php 

$array_routes['/gerenciador-cliente/cadastrar-cliente'] = array(   // Rota
    "controller" => "App\controllers\ControllerCliente",           // Controller 
    "action"     => "index"                                        // Função 
);

$array_routes['/gerenciador-cliente/listar-cliente'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "listar"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/cadastrar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "cadastrar"                                  // Função 
);

return $array_routes;