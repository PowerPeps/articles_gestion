<?php
$user = unserialize($_SESSION['user']);
echo "<h1>Bienvenue, {$user->getNom()} {$user->getPrenom()}</h1>";
echo "<p>Niveau d'accès : {$user->getUserLevel()}</p>";
?>

<a href="/admin">Accéder à la page admin</a> (pour les administrateurs uniquement)<br>
<a href="/login">Se déconnecter</a>