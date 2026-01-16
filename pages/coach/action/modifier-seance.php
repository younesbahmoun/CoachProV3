<?php
session_start();
require_once __DIR__ . "/../../../config/database.php";
require_once __DIR__ . "/../../../classes/Seance.php";

$coachId = $_SESSION["user"]["id"];

$db = new Database();
$pdo = $db->getConnection();
$seance = new Seance($pdo);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $seanceId = $_GET["id"];
    $data = [
        "coach_id" => $coachId,
        "date_seance" => $_POST["date-seance"],
        "heure" => $_POST["heure"],
        "duree" => $_POST["duree"]
    ];
    $seance->modifierSeance($seanceId, $data);
    header("location: ../seance.php");
    exit();
} else {
    $seanceId = $_GET["id"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
        <div id="addSeanceModal" class="modal active">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">modifier séance</h3>
                <a href="../seance.php">
                    <button class="modal-close">
                        <i class="fas fa-times"></i>
                    </button>
                </a>
            </div>

            <form id="addSeanceForm" action="" method="POST">
                <div class="form-group">
                    <label class="form-label required">Date</label>
                    <input type="date" name="date-seance" class="form-input" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required">Heure de début</label>
                        <input type="time" name="heure" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label required">Durée (minutes)</label>
                        <select class="form-select" name="duree" required>
                            <option value="30">30 minutes</option>
                            <option value="45">45 minutes</option>
                            <option value="60" selected>60 minutes</option>
                            <option value="90">90 minutes</option>
                            <option value="120">120 minutes</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Lieu</label>
                    <input type="text" class="form-input" placeholder="Ex: Salle A - Fitness Center">
                </div>

                <div class="form-group">
                    <label class="form-label">Notes / Instructions</label>
                    <textarea class="form-textarea" placeholder="Instructions pour le client..."></textarea>
                </div>

                <div class="modal-footer">
                    <a href="../seance.php">
                        <button type="button" class="btn btn-outline">
                            Annuler
                        </button>
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        Modifier la séance
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>