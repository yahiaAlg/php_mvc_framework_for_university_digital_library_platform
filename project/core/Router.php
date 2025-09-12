<?php

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch(string $uri, string $method): void
    {
        // Parse URI and remove query string
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        // Find matching route
        foreach ($this->routes as $pattern => $handler) {
            if ($this->matchRoute($pattern, $uri)) {
                $this->executeHandler($handler, $uri, $pattern);
                return;
            }
        }

        // No route found
        throw new Exception('Route not found', 404);
    }

    private function matchRoute(string $pattern, string $uri): bool
    {
        // Convert pattern to regex
        $regex = str_replace('/', '\/', $pattern);
        $regex = preg_replace('/\\\\\(([^)]+)\\\\\)/', '($1)', $regex);
        $regex = "/^{$regex}$/";

        return preg_match($regex, $uri);
    }

    private function executeHandler(array $handler, string $uri, string $pattern): void
    {
        [$controllerName, $method] = $handler;
        
        // Extract parameters from URI
        $params = $this->extractParameters($pattern, $uri);
        
        // Load controller
        $controllerFile = __DIR__ . "/../controllers/{$controllerName}.php";
        if (!file_exists($controllerFile)) {
            throw new Exception("Controller not found: {$controllerName}");
        }

        require_once $controllerFile;
        
        if (!class_exists($controllerName)) {
            throw new Exception("Controller class not found: {$controllerName}");
        }

        $controller = new $controllerName();
        
        if (!method_exists($controller, $method)) {
            throw new Exception("Method not found: {$controllerName}::{$method}");
        }

        // Call controller method with parameters
        call_user_func_array([$controller, $method], $params);
    }

    private function extractParameters(string $pattern, string $uri): array
    {
        $regex = str_replace('/', '\/', $pattern);
        $regex = preg_replace('/\\\\\(([^)]+)\\\\\)/', '($1)', $regex);
        $regex = "/^{$regex}$/";

        preg_match($regex, $uri, $matches);
        
        // Remove the full match, return only captured groups
        array_shift($matches);
        
        return $matches;
    }
}