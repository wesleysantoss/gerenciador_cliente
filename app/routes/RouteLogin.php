<?php 

$array_routes[PATH . '/login'] = array(    // Rota
    "controller" => "App\controllers\ControllerLogin",  // Controller 
    "action"     => "index"                             // Função 
);

$array_routes[PATH . '/login/autenticar'] = array(  // Rota
    "controller" => "App\controllers\ControllerLogin",           // Controller 
    "action"     => "autenticar"                                 // Função 
);

$array_routes[PATH . '/login/sair'] = array(  // Rota
    "controller" => "App\controllers\ControllerLogin",     // Controller 
    "action"     => "sair"                                 // Função 
);

return $array_routes;