<?php

class User
{
    public ?int $id = null;
    public string $name;
    public string $email;
    public ?string $created_at = null;

    private PDO $pdo;

    // Konstruktor – předáme PDO
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    
     //   INSERT – uložení objektu
    
    public function save(): bool
    {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $this->pdo->prepare($sql);

        $ok = $stmt->execute([
            ':name'  => $this->name,
            ':email' => $this->email
        ]);

        if ($ok) {
            // doplníme ID objektu po insertu
            $this->id = (int)$this->pdo->lastInsertId();
        }

        return $ok;
    }

     //   SELECT – načtení podle ID
   
    public static function find(PDO $pdo, int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$data) {
            return null;
        }

        $user = new User($pdo);
        $user->id = $data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->created_at = $data->created_at;

        return $user;
    }


     //   DELETE – smazání objektu

    public function delete(): bool
    {
        if ($this->id === null) {
            return false;
        }

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([':id' => $this->id]);
    }

     //  FIND ALL – načtení všech uživatelů
    public static function findAll(PDO $pdo): array
    {
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        $users = [];
        foreach ($data as $row) {
            $user = new User($pdo);
            $user->id = $row->id;
            $user->name = $row->name;
            $user->email = $row->email;
            $user->created_at = $row->created_at;
            $users[] = $user;
        }

        return $users;
    }
}
?>