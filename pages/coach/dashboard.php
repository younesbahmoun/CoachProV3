<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'coach') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../classes/Seance.php';

$db = new Database();
$pdo = $db->getConnection();
$seanceObj = new Seance($pdo);

$coachId = $_SESSION['user']['id'];

$total = $seanceObj->countSeancesCoach($coachId);
$reservees = $seanceObj->countSeancesReservees($coachId);
$disponibles = $seanceObj->countSeancesDisponibles($coachId);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Coach - Dashboard</title>
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
                    <div class="user-avatar">MD</div>
                    <div>
                        <div style="font-weight: 600;">Martin Dupont</div>
                        <div style="font-size: 0.85rem; opacity: 0.9;">Coach Professionnel</div>
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
            <a href="seance.php">
                <button class="nav-tab">
                    <i class="fas fa-calendar-alt"></i>
                    Mes séances
                </button>
            </a>
            <a href="reservation.php">
                <button class="nav-tab">
                    <i class="fas fa-calendar-check"></i>
                    Réservations
                </button>
            </a>
            <a href="profile.php">
                <button class="nav-tab">
                    <i class="fas fa-user-circle"></i>
                    Mon profil
                </button>
            </a>
        </div>

        <!-- Dashboard Tab -->
        <div id="dashboard">
            <!-- Stats Cards -->
            <div class="dashboard-grid">
                                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?= $total ?></h3>
                        <p>Séances créées</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?= $reservees ?></h3>
                        <p>Séances réservées</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fas fa-check-circle"></i>
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