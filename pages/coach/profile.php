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
            <a href="reservation.php">
                <button class="nav-tab">
                    <i class="fas fa-calendar-check"></i>
                    Réservations
                </button>
            </a>
            <button class="nav-tab active">
                <i class="fas fa-user-circle"></i>
                Mon profil
            </button>
        </div>

        <!-- Profil Tab -->
        <div id="profil">
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-user-circle"></i>
                        Mon profil professionnel
                    </h2>
                </div>

                <form id="profilForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label required">Nom</label>
                            <input type="text" class="form-input" value="Dupont" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label required">Prénom</label>
                            <input type="text" class="form-input" value="Martin" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-input" value="martin.dupont@email.com" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Discipline sportive</label>
                        <select class="form-select" required>
                            <option value="musculation" selected>Musculation</option>
                            <option value="yoga">Yoga</option>
                            <option value="crossfit">CrossFit</option>
                            <option value="pilates">Pilates</option>
                            <option value="cardio">Cardio</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Années d'expérience</label>
                        <input type="number" class="form-input" value="8" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Description courte</label>
                        <textarea class="form-textarea" required>Coach diplômé avec 8 ans d'expérience. Spécialisé en prise de masse et renforcement musculaire.</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="tel" class="form-input" value="06 12 34 56 78">
                    </div>

                    <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                        <button type="button" class="btn btn-outline">
                            <i class="fas fa-times"></i>
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="main.js"></script>
</body>
</html>