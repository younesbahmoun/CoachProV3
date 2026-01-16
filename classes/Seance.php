<?php
class Seance {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // public function creerSeance(array $data): int
    public function creerSeance(array $data) {
        $sql = "INSERT INTO seances (coach_id, date_seance, heure, duree, statut)
                VALUES (:coach_id, :date_seance, :heure, :duree, :statut)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":coach_id"    => $data["coach_id"],
            ":date_seance" => $data["date_seance"],
            ":heure"       => $data["heure"],
            ":duree"       => (int)$data["duree"],
            ":statut"      => $data["statut"] ?? "disponible"
        ]);
        // return (int)$this->pdo->lastInsertId(); // return id this seance cree
    }

    public function modifierSeance(int $id, array $data): bool {
        $sql = "UPDATE seances
                SET date_seance = :date_seance,
                    heure = :heure,
                    duree = :duree,
                    statut = :statut
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":date_seance" => $data["date_seance"],
            ":heure"       => $data["heure"],
            ":duree"       => (int)$data["duree"],
            ":statut"      => $data["statut"] ?? "disponible",
            ":id"          => $id
        ]);
    }

    public function supprimerSeance(int $id): bool {
        $sql = "DELETE FROM seances WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":id" => $id
        ]);
    }

    public function seancesDisponibles (int $coachId): array {
        $sql = "SELECT * FROM seances WHERE statut = :statut ORDER BY date_seance";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":statut" => "disponible"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // coach seance
    public function seancesDisponiblesCoach(int $coachId): array {
        $sql = "SELECT
            s.id, s.date_seance , s.heure, s.duree, s.statut,
            c.discipline,
            u.nom, u.prenom
            FROM seances s
            JOIN users u ON u.id = s.coach_id
            JOIN coachs c ON c.user_id = u.id
            WHERE s.statut = :statut AND s.coach_id = $coachId
            ORDER BY s.date_seance, s.heure
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":statut"=>"disponible"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function seancesDisponiblesAvecCoach(): array {
        $sql = "SELECT
            s.id, s.date_seance , s.heure, s.duree, s.statut,
            c.discipline,
            u.nom, u.prenom
            FROM seances s
            JOIN users u ON u.id = s.coach_id
            JOIN coachs c ON c.user_id = u.id
            WHERE s.statut = :statut
            ORDER BY s.date_seance, s.heure
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":statut"=>"disponible"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function changeStatutSeance (int $seanceId): bool {
        // $sql = "UPDATE FROM seances SET statut WHERE id = :id";
        $sql = "UPDATE seances SET statut = 'reservee' WHERE id = :id AND statut = 'disponible'";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([":id"=> $seanceId]);
    }

    public function reserverSeance (int $seanceId, int $sportifId): bool {
        $sql = "INSERT INTO reservations (seance_id, sportif_id) VALUES (:seance_id, :sportif_id)";
        // $sql = "UPDATE seances SET statut = 'reservee' WHERE id = :id AND statut = 'disponible'";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":seance_id" => $seanceId,
            ":sportif_id" => $sportifId
        ]);
    }


    // dashboard coach
    public function countSeancesCoach(int $coachId): int {
        $sql = "SELECT COUNT(*) FROM seances WHERE coach_id = :coach_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":coach_id" => $coachId]);
        return (int)$stmt->fetchColumn();
    }

    public function countSeancesReservees(int $coachId): int {
        $sql = "SELECT COUNT(*) FROM seances WHERE coach_id = :coach_id AND statut = 'reservee'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":coach_id" => $coachId]);
        return (int)$stmt->fetchColumn();
    }

    public function countSeancesDisponibles(int $coachId): int {
        $sql = "SELECT COUNT(*) FROM seances WHERE coach_id = :coach_id AND statut = 'disponible'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":coach_id" => $coachId]);
        return (int)$stmt->fetchColumn();
    }

    // sportif dashboard
    public function countSeanceDisponible(): int {
        $sql = "SELECT COUNT(*) FROM seances WHERE statut = 'disponible' AND date_seance >= CURDATE()";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

    public function countReservationsSportif(int $sportifId): int {
        $sql = "SELECT COUNT(*) FROM reservations WHERE sportif_id = :sportif_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':sportif_id' => $sportifId]);
        return (int)$stmt->fetchColumn();
    }

}