<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'sportif') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../classes/Seance.php';

$db = new Database();
$pdo = $db->getConnection();
$seanceObj = new Seance($pdo);

$sportifId = $_SESSION['user']['id'];

// Get statistics
$reservees = $seanceObj->countReservationsSportif($sportifId);
$disponibles = $seanceObj->countSeanceDisponible();
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
            <button class="nav-tab active">
                <i class="fas fa-home"></i>
                Tableau de bord
            </button>
            <a href="mes-reservation.php">
                <button class="nav-tab">
                    <i class="fas fa-calendar-check"></i>
                    Mes réservations
                </button>
            </a>
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

        <!-- Dashboard Tab -->
        <div id="dashboard" class="tab-content active">
            <!-- Stats Cards -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?= $reservees ?></h3>
                        <p>Séances réservées</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-fire"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?= $disponibles ?></h3>
                        <p>Séances disponibles</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="main.js"></script>
</body>
</html>