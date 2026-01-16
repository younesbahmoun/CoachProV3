<?php
session_start();
require_once __DIR__ . "/../../../config/database.php";
require_once __DIR__ . "/../../../classes/Seance.php";

$coachId = $_SESSION["user"]["id"];

$db = new Database();
$pdo = $db->getConnection();
$seance = new Seance($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        "coach_id" => $coachId,
        "date_seance" => $_POST["date-seance"],
        "heure" => $_POST["heure"],
        "duree" => $_POST["duree"]
    ];
    $seance->creerSeance($data);
    header("location: ../seance.php");
    exit();
}

?>