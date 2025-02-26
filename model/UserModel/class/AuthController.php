<?php
require_once 'UserRepository.php';

class AuthController
{
    private $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function login(string $username, string $password): ?User
    {
        $user = $this->userRepository->validateCredentials($username, $password);
        if ($user) {
            $_SESSION['user'] = serialize($user); // Stockage dans la session
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_level'] = $user->getUserLevel();
            return $user;
        }
        return null; // Identifiants invalides
    }
    public function logout(): void
    {
        session_destroy();
        unset($_SESSION['user']);
    }
    public function checkPermission(int $requiredLevel): bool
    {
        if (!isset($_SESSION['user'])) return false;

        $user = unserialize($_SESSION['user']);
        return $user->getUserLevel() <= $requiredLevel;
    }
    public function getPermissions(): int
    {
        if (!isset($_SESSION['user'])) return 0;
        return unserialize($_SESSION['user'])->getUserLevel();
    }
    public static function checkOwnership(int $id_aut): bool
    {
        if (!isset($_SESSION['user'])) return false;
        $user = unserialize($_SESSION['user']);
        return $user->getId() == $id_aut;
    }
}