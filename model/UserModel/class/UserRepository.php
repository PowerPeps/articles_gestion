<?php
class UserRepository extends DB_PDO
{
    public function __construct()
    {
        parent::__construct(constant('USER_DB_CONNECT'), constant('USER_DB_USER'), constant('USER_DB_PASSWORD'));
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function mapUser($result): ?User
    {
        if (!$result || !isset($result['id_aut'], $result['username'])) {
            return null;
        }

        return new User(
            $result['id_aut'],
            $result['username'],
            null,
            $result['nom'] ?? '',
            $result['prenom'] ?? '',
            $result['user_level'] ?? constant('GUEST_LEVEL')
        );
    }

    public function validateCredentials($username, $password): ?User
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && password_verify($password, $result['password'])) {
            return $this->mapUser($result);
        }
        return null;
    }

    public static function register(User $user): bool
    {
        $stmt = self::$pdo->prepare(
            "INSERT INTO users (nom, prenom, username, password, user_level) 
             VALUES (:nom, :prenom, :username, :password, :user_level)"
        );
        $stmt->execute([
            ':nom' => $user->getNom(),
            ':prenom' => $user->getPrenom(),
            ':username' => $user->getUsername(),
            ':password' => self::hashPassword($user->getPassword()),
            ':user_level' => $user->getUserLevel(),
        ]);
        return $stmt->rowCount() > 0;
    }
    public static function getUserById($id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE id_aut = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUsernameById($id)
    {
        $stmt = self::$pdo->prepare("SELECT username FROM users WHERE id_aut = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['username' => 'Inconnu'];
    }

    public function updateUser(User $user): bool
    {
        $passwordClause = $user->getPassword() ? ", password = :password" : "";

        $stmt = self::$pdo->prepare(
            "UPDATE users SET 
                username = :username, nom = :nom, prenom = :prenom, user_level = :user_level
                $passwordClause 
             WHERE id_aut = :id"
        );

        $params = [
            ':username' => $user->getUsername(),
            ':nom' => $user->getNom(),
            ':prenom' => $user->getPrenom(),
            ':user_level' => $user->getUserLevel(),
            ':id' => $user->getId(),
        ];

        if ($user->getPassword()) {
            $params[':password'] = self::hashPassword($user->getPassword());
        }

        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }
}