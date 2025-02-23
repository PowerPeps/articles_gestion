<?php

$message = '';

$commentId = $_GET['id'] ?? null;
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    die('Vous devez être connecté pour modifier ce commentaire.');
}

$controller = new CommentController();
$comment = $controller->viewComment($commentId);

if (!$comment || $comment['id_us'] != $userId) {
    die('Vous n\'êtes pas autorisé à modifier ce commentaire.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    if ($controller->editOwnComment($comment['id'], $userId, $content)) {
        $message = 'Commentaire modifié avec succès.';
    } else {
        $message = 'Une erreur est survenue lors de la modification.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Commentaire</title>
</head>
<body>
<h1>Modifier un Commentaire</h1>
<p style="color: red;"><?= htmlspecialchars($message) ?></p>
<form method="POST">
    <label>Contenu:</label>
    <textarea name="content" required><?= htmlspecialchars($comment['content']) ?></textarea>
    <br>
    <button type="submit">Modifier</button>
</form>
<a href="/comments?article_id=<?= urlencode($comment['article_id']) ?>">Retour</a>
</body>
</html>