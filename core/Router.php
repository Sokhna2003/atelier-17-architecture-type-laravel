<?php
declare(strict_types=1);

namespace Core;

// Router = "standard téléphonique". add() enregistre une route (méthode+URL -> action).
// dispatch() reçoit la requête réelle, cherche la route qui correspond,
// et fait construire+appeler le bon contrôleur par le Container

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, array $action): void
    {
        $this->routes[] = ['method' => $method, 'path' => $path, 'action' => $action];
    }

    public function dispatch(string $method, string $path, Container $container): void
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                [$class, $action] = $route['action'];
                $controller = $container->make($class);  // construction via le container
                echo $controller->{$action}();
                return;
            }
        }

        http_response_code(404);
        echo '404 - Page introuvable';
    }
}
