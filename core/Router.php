<?php
declare(strict_types = 1);
class Router {
    private array $routes = [];
    public function add (string $path, Closure $handler): void {
        $this->routes[$path] = $handler;
    }
    public function dispatch(string $path): void {
        // if (array_key_exists($path, $this->routes)) {
        //     $handler = $this->routes[$path];
        //     call_user_func($handler);
        // } else {
        //     http_response_code(404);
        //     echo 'Page non trouvée';
        // }
        foreach ($this->routes as $route => $handler) {
            $pathern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);
            if (preg_match("#^$pathern$#", $path, $matches)) {
                array_shift($matches);
                call_user_func_array($handler, $matches);
                var_dump($matches);
                return;
            }
        }
        http_response_code(404);
        echo 'Page non trouvée';
    }
}

// class Router
// {
//     private array $routes = [];

//     public function get(string $path, callable $handler): void
//     {
//         $this->routes['GET'][$path] = $handler;
//     }

//     public function post(string $path, callable $handler): void
//     {
//         $this->routes['POST'][$path] = $handler;
//     }

//     public function dispatch(): void
//     {
//         $method = $_SERVER['REQUEST_METHOD'];
//         $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//         foreach ($this->routes[$method] ?? [] as $pattern => $handler) {
//             // Convertit /user/{id} en regex
//             $regex = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $pattern);
            
//             if (preg_match("#^{$regex}$#", $uri, $matches)) {
//                 $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
//                 call_user_func_array($handler, $params);
//                 return;
//             }
//         }

//         http_response_code(404);
//         echo "404 - Page non trouvée";
//     }
// }