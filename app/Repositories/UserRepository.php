<?php
class UserRepository {
    public function __construct(private PDO $db) {}

    // public function findByEmail(string $email): ?array {
    //     $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
    //     $stmt->execute(['email' => $email]);
    //     $user = $stmt->fetch();
    //     return $user ?: null;
    // }


    public function allCoachs()
{
    $sql = "SELECT * FROM coachs";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
    /**
     * Créer un utilisateur
    */
    public function create(array $data): bool {
        $sql = "
            INSERT INTO users 
            (nom, prenom, email, password_hash, role)
            VALUES 
            (:nom, :prenom, :email, :password_hash, :role)
        ";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $data['nom'],
            ':prenom' => $data['prenom'],
            ':email' => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role' => $data['role']
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