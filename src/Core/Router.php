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

        if (isset($this->routes[$route])) {
            $controllerName = "App\\Controllers\\" . $this->routes[$route]['controller'];
            $methodName = $this->routes[$route]['method'];

            // Instanciation dynamique du controller
            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                // Gestion des actions type add/delete
                if (isset($_GET['action'])) {
                    $actionMethod = $_GET['action'] . 'Project';
                    if (method_exists($controller, $actionMethod)) {
                        $controller->$actionMethod();
                        return;
                    }
                }

                // Appel de la méthode par défaut
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                    return;
                }
            }

            // Si controller inexistant
            $this->loadError();
        } else {
            $this->loadError();
        }
    }

    private function loadError(): void
    {
        $errorController = "App\\Controllers\\ErrorController";
        if (class_exists($errorController)) {
            $controller = new $errorController();
            $controller->display();
        } else {
            // fallback simple si ErrorController absent
            http_response_code(404);
            echo "<h1>404 - Page not found</h1>";
        }
    }
}
