<?php 

namespace App\Core;

class Router 
{
    public static $routes = [
        "GET"=>[],
        "POST"=>[]
    ];

    public static function get($uri, $controller)
    {
        self::$routes["GET"][$uri] = $controller;       
    }

    public static function post($uri, $controller)
    {
        self::$routes["POST"][$uri] = $uri;
    }

    public function direct($uri, $method)
    {
        
        if(array_key_exists($uri,self::$routes[$method]))
        {
            
             $this->callAction(...explode("@", self::$routes[$method][$uri]));
        }else
        {
            echo 'Ruta no encontrada';
            var_dump($uri);
        }
    }
    
    private function callAction($controller, $method)
    {
        $controller = "App\Controllers\\$controller";

        return (new $controller)->$method();
    }
}