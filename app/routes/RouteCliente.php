<?php 

$array_routes['/gerenciador-cliente/cadastrar-cliente'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "index"                                      // Função 
);

$array_routes['/gerenciador-cliente/listar-cliente'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "pageListar"                              // Função 
);

$array_routes['/gerenciador-cliente/cliente/cadastrar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "cadastrar"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/listarTodos'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",           // Controller 
    "action"     => "listarTodos"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/listar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "listar"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/atualizar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "atualizar"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/excluir'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",       // Controller 
    "action"     => "excluir"                                  // Função 
);

return $array_routes;