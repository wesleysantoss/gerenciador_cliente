<?php 

$array_routes['/gerenciador-cliente/endereco/listar'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",      // Controller 
    "action"     => "listarEndereco"                           // Função 
);

$array_routes['/gerenciador-cliente/endereco/editar'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",      // Controller 
    "action"     => "editarEndereco"                           // Função 
);

$array_routes['/gerenciador-cliente/endereco/excluir'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",       // Controller 
    "action"     => "excluirEndereco"                           // Função 
);

$array_routes['/gerenciador-cliente/endereco/adicionar'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",         // Controller 
    "action"     => "adicionarEndereco"                           // Função 
);

return $array_routes;