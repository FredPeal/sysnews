<?php 

require __DIR__ . '/../core/bootstrap.php';
require __DIR__ . '/../routes.php';
$router = new \App\Core\Router;
\App\Core\Request::method();

$router->direct(\App\Core\Request::uri(),\App\Core\Request::method());

