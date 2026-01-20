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

// require_once __DIR__ . "/app/models/Database.php";
require_once __DIR__ . "/app/Repositories/UserRepository.php";
require_once __DIR__ . "/app/Repositories/CoachRepository.php";
require_once __DIR__ . "/config/Database.php";
$pdo = Database::getInstance()->getConnection();
$user = new UserRepository($pdo);
$coach = new CoachRepository($pdo);

$dataUser = [
    'nom' => 'bahmoun',
    'prenom' => 'younes',
    'email' => 'younss@gmail.com',
    'password' => 'yns1234',
    'role' => 'coach',
];

$dataCoach = [
    'user_id' => 20,
    'discipline' => 'discipline',
    'experience' => 3,
    'description' => 'description',
];

echo "fff";

// $users = $user->create($dataUser);
// $coachs = $coach->create($dataCoach);

// echo "<pre>";
// print_r($users);
// echo "</pre>";
// echo "fdff";
// print_r(PDO::getAvailableDrivers());