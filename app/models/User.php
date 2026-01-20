<?php
// require_once __DIR__ . "/../../config/Database.php";
// require_once __DIR__ . "/Database.php";
// namespace App\Models;

// use PDO;
class User {
    protected string $email;
    protected string $motDePasse;
    protected string $nom;
    protected string $prenom;
    protected string $role;
    protected string $created_at;
    // private PDO $db;

    public function __construct(private PDO $db) {
        // $this->db = Database::getInstance()->getConnection();
        // $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // public function __construct(
    //     string $email,
    //     string $motDePasse,
    //     string $nom,
    //     string $prenom,
    //     string $role,
    //     ?int $id = null
    // ) {
    //     $this->id = $id;
    //     $this->email = $email;
    //     $this->motDePasse = password_hash($motDePasse, PASSWORD_BCRYPT);
    //     $this->nom = $nom;
    //     $this->prenom = $prenom;
    //     $this->role = $role;
    // }

public function allCoachs()
{
    $sql = "SELECT * FROM coachs";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // public function getDb(): PDO { return $this->db; }
    public function getEmail(): string { return $this->email; }
    public function getMotDePasse(): string { return $this->motDePasse; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getRole(): string { return $this->role; }

    // public function setDb(PDO $db): void { $this->db = $db; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setMotDePasse(string $motDePasse): void { $this->motDePasse = $motDePasse; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setRole(string $role): void { $this->role = $role; }
}
