<?php
require_once 'UserRepository.php';

class AuthController
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Authentifie un utilisateur à l'aide de ses identifiants.
     *
     * @param string $username
     * @param string $password
     * @return User|null
     */
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

    /**
     * Déconnecte un utilisateur en détruisant la session.
     */
    public function logout(): void
    {
        session_destroy();
        unset($_SESSION['user']);
    }

    /**
     * Vérifie les permissions de l'utilisateur connecté.
     *
     * @param int $requiredLevel
     * @return bool
     */
    public function checkPermission(int $requiredLevel): bool
    {
        if (!isset($_SESSION['user'])) return false;

        $user = unserialize($_SESSION['user']);
        return $user->getUserLevel() <= $requiredLevel;
    }
}