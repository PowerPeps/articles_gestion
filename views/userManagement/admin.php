<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Requête non autorisée');
    }

    $name = $_POST['name'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $userLevel = $_POST['userLevel'] ?? '';

    if (empty($name) || empty($firstname) || empty($username) || empty($password)) {
        die('Tous les champs sont obligatoires.');
    }

    UserRepository::register(new User(null, $name, $firstname, $username, $password, $userLevel));

}

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$user = unserialize($_SESSION['user']);
echo "<h1>Page Admin</h1>";
echo "<p>Bienvenue {$user->getNom()} {$user->getPrenom()}, vous avez un accès d'administrateur.</p>";
?>

<h2>Création de compte :</h2>
<form id="create-account" action="/admin" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
    <br><br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <label for="userLevel">Niveau d'utilisateur :</label>
    <select form="create-account" name="userLevel" id="userLevel">
        <option value="<?php echo htmlspecialchars(constant('ADMIN_LEVEL')); ?>">Administrateur</option>
        <option value="<?php echo htmlspecialchars(constant('USER_LEVEL')); ?>">Utilisateur</option>
        <option value="<?php echo htmlspecialchars(constant('GUEST_LEVEL')); ?>">Invité</option>
    </select>
    <br><br>
    <label for="name">Nom :</label>
    <input type="text" id="name" name="name" required>
    <br><br>
    <label for="firstname">Prenom :</label>
    <input type="text" id="firstname" name="firstname" required>
    <br><br>
    <button type="submit">Créer le compte</button>
</form>

<hr>

<h2>Suppression de compte</h2>



<a href="../../index.php">Retour au tableau de bord</a>