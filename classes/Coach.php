<?php

require_once "Utilisateur.php";

class Coach extends Utilisateur {

    private string $discipline;
    private int $experience;
    private string $description;


    public function __construct(
        string $email,
        string $password,
        string $discipline,
        int $experience,
        string $description,
        int $id = 0
    ) {
        // Appel du constructeur parent
        parent::__construct($email, $password, $id);

        $this->discipline = $discipline;
        $this->experience = $experience;
        $this->description = $description;
    }

    public function getDiscipline(): string
    {
        return $this->discipline;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDiscipline(string $discipline): void
    {
        $this->discipline = $discipline;
    }

    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    public static function getAllCoachs(PDO $pdo): array {
        $sql = "SELECT u.id as user_id, u.nom, u.prenom, u.email, 
                    c.discipline, c.experience, c.description
                FROM users u
                JOIN coachs c ON c.user_id = u.id
                WHERE u.role = 'coach'
                ORDER BY u.prenom, u.nom";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
