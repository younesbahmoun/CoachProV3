<?php

class Router
{
    private $routes = [];
    private $basePath = '';

    public function __construct($basePath = '')
    {
        $this->basePath = trim($basePath, '/');
    }

    public function get($uri, $controller, $method)
    {
        $this->addRoute('GET', $uri, $controller, $method);
    }

    public function post($uri, $controller, $method)
    {
        $this->addRoute('POST', $uri, $controller, $method);
    }

    private function addRoute($method, $uri, $controller, $methodName)
    {
        $uri = trim($uri, '/');
        $this->routes[$method][$uri] = [
            'controller' => $controller,
            'method' => $methodName
        ];
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $this->getUri();

        // Check for direct match
        if (isset($this->routes[$method][$uri])) {
            return $this->dispatch($this->routes[$method][$uri]);
        }

        // Check for dynamic routes
        foreach ($this->routes[$method] ?? [] as $routeUri => $handler) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $routeUri);

            if (preg_match("#^$pattern$#", $uri, $matches)) {
                array_shift($matches); // Remove full match
                return $this->dispatch($handler, $matches);
            }
        }

        $this->notFound();
    }

    private function dispatch($handler, $params = [])
    {
        $controllerName = $handler['controller'];
        $methodName = $handler['method'];

        // Autoloading should handle the require, but as a fallback/check:
        if (!class_exists($controllerName)) {
            die("Controller class $controllerName not found");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {
            die("Method $methodName not found in $controllerName");
        }

        call_user_func_array([$controller, $methodName], $params);
    }

    private function getUri()
    {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        // Remove base path if it exists (case-insensitive)
        if (!empty($this->basePath) && stripos($uri, $this->basePath) === 0) {
            $uri = substr($uri, strlen($this->basePath));
            $uri = trim($uri, '/');
        }

        return $uri;
    }

    private function notFound()
    {
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p><strong>Debug Info:</strong></p>";
        echo "<ul>";
        echo "<li>Request URI: " . htmlspecialchars($_SERVER['REQUEST_URI']) . "</li>";
        echo "<li>Base Path: " . htmlspecialchars($this->basePath) . "</li>";
        echo "<li>Processed URI: " . htmlspecialchars($this->getUri()) . "</li>";
        echo "<li>Method: " . $_SERVER['REQUEST_METHOD'] . "</li>";
        echo "</ul>";
        echo "<h3>Registered Routes:</h3>";
        echo "<pre>";
        print_r($this->routes);
        echo "</pre>";
    }
}
