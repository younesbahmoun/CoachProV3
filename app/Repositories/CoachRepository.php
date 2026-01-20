<?php
class CoachRepository
{
    public function __construct(private PDO $db)
    {
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO coachs 
            (user_id, discipline, experience, description)
            VALUES 
            (:user_id, :discipline, :experience, :description)
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':discipline' => $data['discipline'],
            ':experience' => $data['experience'],
            ':description' => $data['description']
        ]);
    }

    public function allCoachs()
    {
        $sql = "SELECT * FROM coachs";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM coachs WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function seancesDisponiblesCoach(int $coachId) {
        $sql = "SELECT
            s.id, s.date_seance , s.heure, s.duree, s.statut,
            c.discipline,
            u.nom, u.prenom
            FROM seances s
            JOIN users u ON u.id = s.coach_id
            JOIN coachs c ON c.user_id = u.id
            WHERE s.statut = 'disponible' AND s.coach_id = ?
            ORDER BY s.date_seance, s.heure
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}