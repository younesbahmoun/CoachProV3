<?php
ob_start();
// session_start();
// require_once __DIR__ . "/../../config/database.php";
// require_once __DIR__ . "/../../classes/Seance.php";

// $coachId = $_SESSION["user"]["id"];

// $db = new Database();
// $pdo = $db->getConnection();
// $seance = new Seance($pdo);
// $seances = $seance->seancesDisponiblesCoach($coachId);
echo "<pre>";
print_r($seances);
echo "</pre>";
?>

    <!-- Main Container -->
    <div class="container">

        <!-- Mes Séances Tab -->
        <div id="mes-seances">
            <div class="section">
                <div class="section-header">
                    <h2 class="section-title">
                        <i class="fas fa-calendar-alt"></i>
                        Toutes mes séances
                    </h2>
                    <button class="btn btn-primary" onclick="openModal('addSeanceModal')">
                        <i class="fas fa-plus"></i>
                        Créer une séance
                    </button>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <span>Vous pouvez modifier ou supprimer vos séances disponibles à tout moment.</span>
                </div>

                <div class="seance-grid">

                    <?php if (empty($seances)): ?>
                        <p>aucun seance</p>
                    <?php else: ?>
                        <?php foreach ($seances as $s): ?>
                            <div class="seance-card">
                                <div class="seance-info">
                                    <div class="seance-header">
                                        <span class="seance-title">Séance de <?php echo $s["discipline"] ?></span>
                                        <span class="status-badge status-disponible">Disponible</span>
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
                                    </div>
                                </div>
                                <div class="seance-actions">
                                    <a
                                        href="action/modifier-seance.php?id=<?php echo htmlspecialchars((int) $s['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Modifier
                                        </button>
                                    </a>
                                    <a
                                        href="action/delete-seance.php?id=<?php echo htmlspecialchars((int) $s['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <button class="btn btn-danger btn-sm" onclick="deleteSeance(this)">
                                            <i class="fas fa-trash"></i>
                                            Supprimer
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

    <!-- Modal Ajouter Séance -->
    <div id="addSeanceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Créer une nouvelle séance</h3>
                <button class="modal-close" onclick="closeModal('addSeanceModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="addSeanceForm" action="action/add-seance.php" method="POST">
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
                    <button type="button" class="btn btn-outline" onclick="closeModal('addSeanceModal')">
                        Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        Créer la séance
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); 
include_once __DIR__ . "/layout.php";
// $this->view('coach/layout', ['content' => $content]);
?>