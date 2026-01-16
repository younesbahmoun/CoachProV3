<?php
/*
declare(strict_types = 1);
echo "hello index.php";
echo "<br>";
echo $_SERVER["REQUEST_URI"];
echo "<br>";
echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
echo "<br>";
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = "/coachprov3";
// switch($path) {
//     case "$base/index.php":
//     case "$base/":
//         echo "home";
//         break;
//     case "$base/about":
//         echo "about page";
//         break;
//     default:
//         http_response_code(404);
//         echo 'Page non trouvée';
// }
require_once __DIR__ . "/../core/Router.php";
$router = new Router();
// coachprov3
$router->add("$base/", function() {
    echo "This is Home Page";
});
// 
$router->add("$base/", function() {
    echo "This is Home Page";
});

$router->add("$base/index.php", function() {
    echo "This is Home Page";
});

$router->add("$base/about", function() {
    echo "This is About Page";
});

$router->add("$base/products/{id}", function ($id) {
    echo "This page products id = $id";
});
$router->add("$base/products/{id}/orders/{order_id}", function ($id, $order_id) {
    echo "This page products id = $id, order_id = $order_id";
});

$router->dispatch($path);

// require_once __DIR__ . "/../core/Router.php";
// $router = new Router();

// $router->get('/coachprov3/', function () {echo "Accueil";});
// // $router->get('/user/{id}', fn($id) => echo "Utilisateur {$id}");
// // $router->post('/user', fn() => echo "Créer utilisateur");

// $router->dispatch();
*/

// require_once 'controller/stagiaire_controller.php';
// // listeStagiairesAction();
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];
//     switch ($action) {
//         case 'create' : 
//             createAction();
//             break;
//         case 'list' : 
//             listeStagiairesAction();
//             break;
//         case 'destroy' : 
//             destroyAction();
//             break;
//         case 'edit' : 
//             editAction();
//             break;
//         case 'delete' : 
//             deleteMoaadAction();
//             break;
//         case 'update' : 
//             updateAction();
//             break;
//         default:
//             listeStagiairesAction();

//     }
// }