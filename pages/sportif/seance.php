<?php
session_start();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../classes/Seance.php";

// echo $_SESSION["user"]["id"];

$db = new Database();
$pdo = $db->getConnection();
$seance = new Seance($pdo);

$data = [
    "coach_id" => 2,
    "date_seance" => "2025-12-31",
    "heure" => "10:00:00",
    "duree" => "60"
];

// echo $seance->creerSeance($data);
// print_r($seance->SeancesDisponibles());
$seances = $seance->seancesDisponiblesAvecCoach();
// echo "<pre>";
// print_r($seances);
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
            <a href="mes-reservation.php">
                <button class="nav-tab">
                    <i class="fas fa-calendar-check"></i>
                    Mes réservations
                </button>
            </a>
            <button class="nav-tab active">
                <i class="fas fa-search"></i>
                Séances disponibles
            </button>
            <a href="nos-coachs.php">
                <button class="nav-tab">
                    <i class="fas fa-users"></i>
                    Nos coachs
                </button>
            </a>
        </div>

        <!-- Dashboard Tab -->

        <!-- Séances Disponibles Tab -->
        <div id="seances-disponibles">
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-search"></i>
                        Séances disponibles
                    </h2>
                    <div style="display: flex; gap: 0.5rem;">
                        <select class="btn" style="padding: 0.5rem 1rem;">
                            <option>Toutes les disciplines</option>
                            <option>Musculation</option>
                            <option>Yoga</option>
                            <option>CrossFit</option>
                            <option>Pilates</option>
                        </select>
                    </div>
                </div>

                <div class="seance-grid">

                
                    <?php if (empty($seances)): ?>
                        <p>Aucune séance.</p>
                    <?php else: ?>
                        <?php foreach ($seances as $s): ?>
                        <div class="seance-card">
                            <div class="seance-info">
                                <div class="seance-header">
                                    <span class="coach-name"><?php echo $s["prenom"] . " " . $s["nom"] ?></span>
                                    <span class="discipline-badge"><?php echo $s["discipline"] ?></span>
                                    <span class="status-badge status-disponible"><?php echo $s["statut"] ?></span>
                                </div>
                                <div class="seance-details">
                                    <div class="seance-detail">
                                        <i class="fas fa-calendar"></i>
                                        <span><?php echo $s["date_seance"] ?></span>
                                    </div>
                                    <div class="seance-detail">
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo $s["heure"] ?></span>
                                    </div>
                                    <div class="seance-detail">
                                        <i class="fas fa-hourglass-half"></i>
                                        <span><?php echo $s["duree"] ?> min</span>
                                    </div>
                                    <div class="seance-detail">
                                        <i class="fas fa-euro-sign"></i>
                                        <span>55€</span>
                                    </div>
                                </div>
                            </div>
                            <div class="seance-actions">
                                <button class="btn btn-outline btn-sm">
                                    <i class="fas fa-eye"></i>
                                    Détails
                                </button>
                                <a href="action/reservation.php?id=<?php echo htmlspecialchars((int)$s['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i>
                                        Réserver
                                    </button>
                                </a>
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