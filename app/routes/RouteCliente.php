<?php 

$array_routes['/gerenciador-cliente/cadastrar-cliente'] = array(   // Rota
    "controller" => "App\controllers\ControllerCliente",           // Controller 
    "action"     => "index"                                        // Função 
);

$array_routes['/gerenciador-cliente/listar-cliente'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
    "action"     => "pageListar"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/cadastrar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",         // Controller 
    "action"     => "cadastrar"                                  // Função 
);

$array_routes['/gerenciador-cliente/cliente/listarTodos'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",      // Controller 
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

$array_routes['/gerenciador-cliente/cliente/endereco/listar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",               // Controller 
    "action"     => "listarEndereco"                                   // Função 
);

$array_routes['/gerenciador-cliente/cliente/endereco/editar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",               // Controller 
    "action"     => "editarEndereco"                                   // Função 
);

$array_routes['/gerenciador-cliente/cliente/endereco/excluir'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",                // Controller 
    "action"     => "excluirEndereco"                                   // Função 
);

$array_routes['/gerenciador-cliente/cliente/endereco/adicionar'] = array( // Rota
    "controller" => "App\controllers\ControllerCliente",                  // Controller 
    "action"     => "adicionarEndereco"                                   // Função 
);

return $array_routes;