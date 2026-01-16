<?php
// require_once __DIR__ . "/../models/Database.php";
require_once __DIR__ . "/Database.php";
class Userr {
    protected string $email;
    protected string $motDePasse;
    protected string $nom;
    protected string $prenom;
    // protected string $role; // 'coach' ou 'sportif'
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    public function getDb(): PDO { return $this->db; }
    public function getEmail(): string { return $this->email; }
    public function getMotDePasse(): string { return $this->motDePasse; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    // public function getRole(): string { return $this->role; }

    public function setDb(PDO $db): void { $this->db = $db; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setMotDePasse(string $motDePasse): void { $this->motDePasse = $motDePasse; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    // public function setRole(string $role): void { $this->role = $role; }

        /**
     * Créer un utilisateur
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO users 
            (nom, prenom, email, password_hash, adresse, age, phone, role_id)
            VALUES 
            (:nom, :prenom, :email, :password_hash, :adresse, :age, :phone, :role_id)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            'adresse' => $data['adresse'] ?? null,
            'age' => $data['age'],
            'phone' => $data['phone'],
            'role_id' => $data['role_id']
        ]);
    }

    /**
     * Trouver user par ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE user_id = ?"
        );
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Trouver user par email
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = ? LIMIT 1"
        );
        $stmt->execute([$email]);

        return $stmt->fetch() ?: null;
    }

    /**
     * Mettre à jour le profil
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE users SET
                nom = :nom,
                prenom = :prenom,
                adresse = :adresse,
                age = :age,
                phone = :phone
            WHERE user_id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'adresse' => $data['adresse'],
            'age' => $data['age'],
            'phone' => $data['phone'],
            'id' => $id
        ]);
    }
}
