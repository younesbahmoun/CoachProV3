<?php
session_start();
$sportifId = (int)$_SESSION["user"]["id"];
require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../../classes/Reservation.php";

$db = new Database();
$reservation = new Reservation($db->getConnection());

$mesReservation = $reservation->allReservation($sportifId);

// echo "<pre>";
// print_r($mesReservation);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace Sportif - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-dumbbell"></i>
                CoachConnect
            </div>
            <div class="user-menu">
                <div class="user-info">
                    <div class="user-avatar">JS</div>
                    <div>
                        <div style="font-weight: 600;">Jean Sportif</div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Sportif</div>
                    </div>
                </div>
                <button class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Déconnexion
                </button>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="container">
        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="dashboard.php">
                <button class="nav-tab">
                    <i class="fas fa-home"></i>
                    Tableau de bord
                </button>
            </a>
            <button class="nav-tab active">
                <i class="fas fa-calendar-check"></i>
                Mes réservations
            </button>
            <a href="seance.php">
                <button class="nav-tab">
                    <i class="fas fa-search"></i>
                    Séances disponibles
                </button>
            </a>
            <a href="nos-coachs.php">
                <button class="nav-tab">
                    <i class="fas fa-users"></i>
                    Nos coachs
                </button>
            </a>
        </div>
        <!-- Mes Séances Tab -->
        <div id="mes-seances">
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-calendar-check"></i>
                        Mes réservations
                    </h2>
                </div>

                <div class="seance-grid">
                    <?php if (empty($mesReservation)): ?>
                        <p>Aucune reservation.</p>
                    <?php else: ?>
                        <?php foreach ($mesReservation  as $r): ?>
                            <div class="seance-card">
                                <div class="seance-info">
                                    <div class="seance-header">
                                        <span class="coach-name"><?php echo $r["prenom"] . " " . $r["nom"] ?></span>
                                        <span class="discipline-badge"><?php echo $r["discipline"] ?></span>
                                        <span class="status-badge status-reservee"><?php echo $r["statut"] ?></span>
                                    </div>
                                    <div class="seance-details">
                                        <div class="seance-detail">
                                            <i class="fas fa-calendar"></i>
                                            <span><?php echo $r["date_seance"] ?></span>
                                        </div>
                                        <div class="seance-detail">
                                            <i class="fas fa-clock"></i>
                                            <span><?php echo $r["heure"] ?></span>
                                        </div>
                                        <div class="seance-detail">
                                            <i class="fas fa-hourglass-half"></i>
                                            <span><?php echo $r["duree"] ?> min</span>
                                        </div>
                                        <div class="seance-detail">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>Salle A - Fitness Center</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="seance-actions">
                                    <button class="btn btn-danger btn-sm" onclick="annulerSeance(this)">
                                        <i class="fas fa-times"></i>
                                        Annuler
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="main.js"></script>
</body>
</html>