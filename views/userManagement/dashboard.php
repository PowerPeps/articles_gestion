<?php
$user = unserialize($_SESSION['user']);

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    // Validation et filtrage des données reçues
//    $data = filter_input_array(INPUT_POST, [
//        'username' => FILTER_SANITIZE_SPECIAL_CHARS, // Alternative à FILTER_SANITIZE_STRING
//        'nom' => FILTER_SANITIZE_SPECIAL_CHARS,      // Alternative à FILTER_SANITIZE_STRING
//        'prenom' => FILTER_SANITIZE_SPECIAL_CHARS,   // Alternative à FILTER_SANITIZE_STRING
//        'password' => FILTER_DEFAULT,               // Aucune altération du mot de passe ici
//        'id' => FILTER_VALIDATE_INT,
//    ]);
//
//    // Vérification de la validité des données avant de continuer
//    if ($data['username'] && $data['nom'] && $data['prenom']) {
//        $user = new User(
//            $user->getId(),
//            $data['username'],         // Nom d'utilisateur
//            $data['password'],         // Mot de passe (peut être null)
//            $data['nom'],              // Nom
//            $data['prenom'],           // Prénom
//            $user->getUserLevel()        // Niveau d'accès
//        );
//
//        $repo = new UserRepository();
//
//        // Mise à jour de l'utilisateur via le UserRepository
//        if ($repo->updateUser($user)) {
//            echo "<p style='color:green'>Utilisateur mis à jour avec succès !</p>";
//        } else {
//            echo "<p style='color:red'>Échec lors de la mise à jour. Veuillez réessayer.</p>";
//        }
//    } else {
//        echo "<p style='color:red'>Les informations fournies sont incomplètes ou invalides.</p>";
//    }
//}


echo "<h1>Dashboard, {$user->getNom()} {$user->getPrenom()}</h1>";
echo "<p>Niveau d'accès : {$user->getUserLevel()}</p>";

var_dump($user);
if($user->getUserLevel() === constant('ROOT_LEVEL')) {
    var_dump($config);
}
?>


<!--<form action="/dashboard" method="post">-->
<!--    <label for="username">Username:</label>-->
<!--    <input type="text" id="username" name="username" required-->
<!--           value="--><?php //echo htmlspecialchars($user->getUsername()); ?><!--"><br><br>-->
<!---->
<!--    <label for="nom">Nom:</label>-->
<!--    <input type="text" id="nom" name="nom" required value="--><?php //echo htmlspecialchars($user->getNom()); ?><!--"><br><br>-->
<!---->
<!--    <label for="prenom">Prenom:</label>-->
<!--    <input type="text" id="prenom" name="prenom" required-->
<!--           value="--><?php //echo htmlspecialchars($user->getPrenom()); ?><!--"><br><br>-->
<!---->
<!--    <label for="password">Password (optional):</label>-->
<!--    <input type="password" id="password" name="password"><br><br>-->
<!---->
<!--    <input type="hidden" name="id" value="--><?php //echo htmlspecialchars($user->getId()); ?><!--">-->
<!---->
<!--    <button type="submit">Update User</button>-->
<!--</form>-->