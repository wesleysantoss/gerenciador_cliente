<?php 

$array_routes[PATH . '/endereco/editar'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",      // Controller 
    "action"     => "editarEndereco"                           // Função 
);

$array_routes[PATH . '/endereco/excluir'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",       // Controller 
    "action"     => "excluirEndereco"                           // Função 
);

$array_routes[PATH . '/endereco/adicionar'] = array( // Rota
    "controller" => "App\controllers\ControllerEndereco",         // Controller 
    "action"     => "adicionarEndereco"                           // Função 
);

return $array_routes;