<?php
session_start();

/**
 * Fake login for testing only.
 * It simulates a logged-in user without checking DB.
 */

$_SESSION["user"] = [
    "id" => 7,
    "nom" => "Lahcen",
    "prenom" => "Rania",
    "email" => "rania@sportif.com",
    "role" => "sportif"
    // "id" => 1,
    // "nom" => "El Amrani",
    // "prenom" => "Youssef",
    // "email" => "youssef@coach.com",
    // "role" => "coach"
];
// $motDePasse =  password_hash("1234", PASSWORD_BCRYPT);
// echo $motDePasse;

// header("Location: pages/coach/dashboard.php");
// header("Location: pages/sportif/dashboard.php");
// exit;

// require_once __DIR__ . "/app/models/Database.php";
// $db = Database::getInstance()->getConnection();
// echo "Connected to PostgreSQL successfully!\n";

require_once __DIR__ . "/app/models/Userr.php";
require_once __DIR__ . "/app/models/Database.php";
$userr = new Userr();
var_dump($userr->allCoachs());
// print_r(PDO::getAvailableDrivers());