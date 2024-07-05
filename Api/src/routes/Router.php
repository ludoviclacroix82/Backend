<?php

namespace Api\Routes;

use Exception;
use Closure;

class Router
{
    private array $routes = [];

    public function request(string $method, string $path, Closure $action): void
    {
        $this->routes[$method][$path] = $action;
    }

    public function get(string $path, Closure $action): void
    {
        $this->request('GET', $path, $action);
    }

    public function post(string $path, Closure $action): void
    {
        $this->request('POST', $path, $action);
    }

    public function run(): void
    {       
            $method = $_SERVER['REQUEST_METHOD'];
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
            if (isset($this->routes[$method])) {
                foreach ($this->routes[$method] as $routeUrl => $target) {
                    // Utiliser des sous-modèles nommés dans le modèle d'expression régulière pour capturer chaque valeur de paramètre séparément
                    $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);
                    if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                        // Transmettez les valeurs des paramètres capturés en tant qu'arguments nommés à la fonction cible
                        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                        call_user_func_array($target, $params);
                        return;
                    }
                }
            }        
        
            throw new Exception('Page No Found',404); 
    }
}