<?php

class CoachController extends Controller
{

    private $coachRepository;

    public function __construct()
    {
        try {
            $pdo = Database::getInstance()->getConnection();
            $this->coachRepository = new CoachRepository($pdo);
        } catch (Exception $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }

    public function toutSeanceDisponible()
    {
        $seances = $this->coachRepository->seancesDisponiblesCoach(1);
        $this->view('coach/seance', ['seances' => $seances]);
    }

    public function testRoute()
    {
        echo "<h1>Routing Works!</h1>";
        echo "<p>This is a test route from CoachController.</p>";
        echo "<p><a href='/coaches'>View Coaches List</a></p>";
    }

    public function listCoaches()
    {
        try {
            $coaches = $this->coachRepository->allCoachs();
            $this->view('coach/list', ['coaches' => $coaches]);
            // $coaches = $this->coachRepository->seancesDisponiblesCoach(1);
            // $this->view('coach/list', ['coaches' => $coaches]);
            // $this->view('coach/list', ['coaches' => $coaches]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function showCoach($id)
    {
        try {
            $coach = $this->coachRepository->findById($id);

            if (!$coach) {
                echo "Coach not found";
                return;
            }

            // For now, simpler view or just dump
            // $this->view('coach/profile', ['coach' => $coach]); 
            echo "<h1>Coach Profile: " . htmlspecialchars($coach['nom'] ?? 'Unknown') . "</h1>";
            echo "<pre>";
            print_r($coach);
            echo "</pre>";

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function AjouterSeance()
    {
        // Placeholder for adding a session (Form)
        echo "<h1>Ajouter Séance (Formulaire)</h1>";
    }

    public function submitSeance()
    {
        // Placeholder for handling session submission
        echo "<h1>Séance Ajoutée (POST)</h1>";
    }

    // public function toutSeanceDisponible()
    // {
    //     // Placeholder for all available sessions
    //     echo "<h1>Toutes les Séances Disponibles</h1>";
    // }

    public function toutSeanceReserve()
    {
        // Placeholder for all reserved sessions
        echo "<h1>Toutes les Séances Réservées</h1>";
    }
}
