<?php
// Initialisation du contrôleur d'authentification
$authController = new AuthController();

// Variable pour stocker les messages d'erreur
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Tentative de connexion
    $user = $authController->login($username, $password);

    if ($user) {
        // Si connexion réussie, rediriger vers le tableau de bord
        header('Location: /');
        exit;
    } else {
        // Si échec, afficher un message d'erreur
        $errorMessage = "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <!-- Erreurs -->
    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>

<!-- Formulaire de connexion -->
<form class="loginform" method="POST" action="/login">
    <div>
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>
</body>
</html>