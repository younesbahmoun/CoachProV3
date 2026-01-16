<?php
class Reservation {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function allReservation (int $sportifId): array {
        $sql = "SELECT s.*,
            c.discipline,
            u.nom, u.prenom
            FROM reservations r
            JOIN seances s ON s.id = r.seance_id
            JOIN users u ON u.id = s.coach_id
            JOIN coachs c ON c.user_id = u.id
            WHERE r.sportif_id = :sportifId
            ORDER BY r.reserved_at DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":sportifId" => $sportifId 
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countSeanceReserver (int $sportifId): int {
        $sql = "SELECT COUNT(*) AS total
        FROM reservations
        WHERE sportif_id = :sportifId
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":sportifId" => $sportifId
        ]);
        return (int) $stmt->fetchColumn();
    }

    public function getReservationsCoach(int $coachId): array {
        $sql = "SELECT
                    s.date_seance, s.heure, s.duree,
                    c.discipline,
                    u.nom AS sportif_nom,
                    u.prenom AS sportif_prenom,
                    u.email AS sportif_email
                FROM reservations r
                JOIN seances s ON s.id = r.seance_id
                JOIN coachs c ON c.user_id = s.coach_id
                JOIN sportifs sp ON sp.user_id = r.sportif_id
                JOIN users u ON u.id = sp.user_id
                WHERE s.coach_id = :coach_id
                AND s.date_seance >= CURDATE()
                ORDER BY s.date_seance, s.heure";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":coach_id" => $coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}