<?php

namespace App\Core;

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function start(): void
    {
        $route = $_GET['route'] ?? 'home';

        // Route inconnue
        if (!isset($this->routes[$route])) {
            $this->loadError();
            return;
        }

        $controllerClass = 'App\\Controllers\\' . $this->routes[$route]['controller'];
        $method = $this->routes[$route]['method'];

        // Controller inexistant
        if (!class_exists($controllerClass)) {
            $this->loadError();
            return;
        }

        $controller = new $controllerClass();

        // Méthode inexistante
        if (!method_exists($controller, $method)) {
            $this->loadError();
            return;
        }

        // Appel final
        $controller->$method();
    }

    private function loadError(): void
    {
        http_response_code(404);

        if (class_exists('App\\Controllers\\ErrorController')) {
            (new \App\Controllers\ErrorController())->display();
        } else {
            echo '<h1>404 - Page introuvable</h1>';
        }
    }
}
