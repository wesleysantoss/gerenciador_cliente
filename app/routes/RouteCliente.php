<?php 

$array_routes['/gerenciador-cliente/cliente'] = array(   // Rota
    "controller" => "App\controllers\ControllerCliente", // Controller 
    "action"     => "index"                              // Função 
);

$array_routes['/gerenciador-cliente/cliente/listar'] = array(   // Rota
    "controller" => "App\controllers\ControllerCliente",        // Controller 
    "action"     => "listar"                                    // Função 
);

return $array_routes;