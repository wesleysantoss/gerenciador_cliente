<?php 

$array_routes[PATH . '/home'] = array(   // Rota
    "controller" => "App\controllers\ControllerHome", // Controller 
    "action"     => "index"                           // Função 
);

return $array_routes;