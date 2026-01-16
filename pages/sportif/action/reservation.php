<?php
session_start();
$sportifId = $_SESSION["user"]["id"];
require_once __DIR__ . "/../../../config/Database.php";
require_once __DIR__ . "/../../../classes/Seance.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $seanceId = (int)$_GET["id"];
}

$db = new Database();
$pdo = $db->getConnection();
$seances = new Seance($pdo);

$seances->changeStatutSeance($seanceId);
$seances->reserverSeance($seanceId, $sportifId);

header("location: ../seance.php");
exit();

?>