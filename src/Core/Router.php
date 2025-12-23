<?php

namespace App\Core;

class Router{
    private $routes;

    public function __construct(array $routes){
        $this->routes = $routes;
    }

    public function start(){
        $route = $_GET['route'] ?? 'home';

        if(isset($this->routes[$route])){
            // Charge le controller
            $controllerName = "App\Controllers\\".$this->routes[$route]['controller'];
            $methodName = $this->routes[$route]['method'];

            // Instancie le controller
            $controller = new $controllerName();

            // Appelle la méthode correspondante
            $controller->$methodName();
        }
        else {
            // Charger la page 404
            $route = 'error';
            $controllerName = "App\Controllers\\".$this->routes[$route]['controller'];
            $methodName = $this->routes[$route]['method'];

            $controller = new $controllerName();

            $controller->$methodName();
        }
    }
}