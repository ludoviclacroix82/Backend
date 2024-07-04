<?php

class Router
{

    public array $routes;

    public function request(string $path, callable $action): void
    {

        $this->routes[$path] = $action;
        var_dump($this->routes);
    }

    public function run(string $uri): void
    {
        $path = explode('?', $uri)[0];
        $action = $this->routes[$path] ?? null;

        if ($action) 
            call_user_func($action);
        
    }
}
