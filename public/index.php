<?php
// public/index.php

session_start();

// Autoloading
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . "/../core/{$class}.php",
        __DIR__ . "/../app/Controllers/{$class}.php",
        __DIR__ . "/../app/Repositories/{$class}.php",
        __DIR__ . "/../app/Models/{$class}.php",
        __DIR__ . "/../config/{$class}.php"
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Load Configuration
require_once __DIR__ . "/../config/Database.php";

// Initialize Router
// Adjust the base path if your project is in a subdirectory, 
// e.g., if URL is localhost/CoachProV3/public/, base path might be /CoachProV3/public
// For strictly /CoachProV3:
$basePath = '/CoachProV3';
define('BASE_URL', $basePath);
$router = new Router($basePath);

// Load Routes
require_once __DIR__ . "/../routes/web.php";

// Dispatch
$router->resolve();