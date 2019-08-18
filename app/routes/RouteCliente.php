<?php 

$array_routes[PATH . '/cadastrar-cliente'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "index"                                      // Função 
);

$array_routes[PATH . '/listar-cliente'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "pageListar"                              // Função 
);

$array_routes[PATH . '/cliente/cadastrar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "cadastrar"                                  // Função 
);

$array_routes[PATH . '/cliente/listarTodos'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",           // Controller 
    "action"     => "listarTodos"                                  // Função 
);

$array_routes[PATH . '/cliente/listar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "listar"                                  // Função 
);

$array_routes[PATH . '/cliente/atualizar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "atualizar"                                  // Função 
);

$array_routes[PATH . '/cliente/excluir'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",       // Controller 
    "action"     => "excluir"                                  // Função 
);

$array_routes[PATH . '/cliente/endereco/listar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "listarEndereco"                           // Função 
);

return $array_routes;