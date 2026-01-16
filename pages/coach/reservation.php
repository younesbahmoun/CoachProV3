<?php
session_start();

// if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'coach') {
//     header('Location: ../login.php');
//     exit();
// }

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../classes/Reservation.php';

$db = new Database();
$pdo = $db->getConnection();
$seanceObj = new Reservation($pdo);

$coachId = $_SESSION['user']['id'];
$reservations = $seanceObj->getReservationsCoach($coachId);
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
            <a href="dashboard.php">
                <button class="nav-tab">
                    <i class="fas fa-home"></i>
                    Tableau de bord
                </button>
            </a>
            <a href="seance.php">
                <button class="nav-tab">
                    <i class="fas fa-calendar-alt"></i>
                    Mes séances
                </button>
            </a>
            <button class="nav-tab active">
                <i class="fas fa-calendar-check"></i>
                Réservations
            </button>
            <a href="profile.php">
                <button class="nav-tab">
                    <i class="fas fa-user-circle"></i>
                    Mon profil
                </button>
            </a>
        </div>

        <!-- Réservations Tab -->
        <div id="reservations">
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-calendar-check"></i>
                        Séances réservées par mes clients
                    </h2>
                </div>

                            <?php if (empty($reservations)): ?>
                <p style="text-align: center; color: #64748b; padding: 2rem;">
                    Aucune réservation pour le moment
                </p>
            <?php else: ?>
                <div class="seance-grid">
                    <?php foreach ($reservations as $r): ?>
                        <div class="seance-card">
                            <div class="seance-info">
                                <div class="seance-header">
                                    <span class="seance-title">Séance de <?= htmlspecialchars($r['discipline']) ?></span>
                                    <span class="status-badge status-reservee">Confirmée</span>
                                </div>
                                <div class="seance-details">
                                    <div class="seance-detail">
                                        <i class="fas fa-user"></i>
                                        <span><strong>Client:</strong> <?= htmlspecialchars($r['sportif_prenom'] . ' ' . $r['sportif_nom']) ?></span>
                                    </div>
                                    <div class="seance-detail">
                                        <i class="fas fa-envelope"></i>
                                        <span><?= htmlspecialchars($r['sportif_email']) ?></span>
                                    </div>
                                    <div class="seance-detail">
                                        <i class="fas fa-calendar"></i>
                                        <span><?= date('d/m/Y', strtotime($r['date_seance'])) ?></span>
                                    </div>
                                    <div class="seance-detail">
                                        <i class="fas fa-clock"></i>
                                        <span><?= date('H:i', strtotime($r['heure'])) ?> (<?= $r['duree'] ?> min)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="seance-actions">
                                <button class="btn btn-outline btn-sm">
                                    <i class="fas fa-envelope"></i>
                                    Contacter
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>

    </div>

    <script src="main.js"></script>
</body>
</html>