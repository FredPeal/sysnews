<?php

require_once __DIR__ . '/../core/bootstrap.php';
require_once __DIR__ . '/../routes.php';
$router = new \App\Core\Router;
\App\Core\Request::method();

if(isset($_SERVER["REQUEST_URI"]) && isset($_SERVER["REQUEST_METHOD"]))
{
    $router->direct(\App\Core\Request::uri(),\App\Core\Request::method());
}

 
