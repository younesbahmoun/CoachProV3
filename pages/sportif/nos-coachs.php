<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'sportif') {
    header('Location: ../login.php');
    exit();
}

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../classes/Utilisateur.php';
require_once __DIR__ . '/../../classes/Coach.php';

$db = new Database();
$pdo = $db->getConnection();

// Get all coaches
$coachs = Coach::getAllCoachs($pdo);
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
            <button class="nav-tab active">
                <i class="fas fa-users"></i>
                Nos coachs
            </button>
        </div>

        <!-- Coachs Tab -->
        <div id="coachs">
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-users"></i>
                        Nos coachs professionnels
                    </h2>
                </div>

                <div class="dashboard-grid">
                    <?php foreach($coachs as $c): ?>
                        <div class="stat-card" style="flex-direction: column; align-items: flex-start;">
                            <div style="width: 100%; display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                <div class="stat-icon blue" style="width: 70px; height: 70px; font-size: 2rem;">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;"><?php echo $c["prenom"] . " " . $c["nom"] ?></h3>
                                    <span class="discipline-badge"><?php echo $c["discipline"] ?></span>
                                </div>
                            </div>
                            <p style="color: var(--text-light); font-size: 0.95rem; margin-bottom: 1rem;">
                                <?php echo $c["description"] ?>
                            </p>
                            <div style="display: flex; gap: 0.5rem; width: 100%;">
                                <button class="btn btn-outline btn-sm" style="flex: 1;">
                                    <i class="fas fa-eye"></i>
                                    Voir profil
                                </button>
                                <button class="btn btn-primary btn-sm" style="flex: 1;">
                                    <i class="fas fa-calendar"></i>
                                    Séances
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

</body>
</html>