<?php

$controller = new ArticleController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!empty($title) && !empty($content)) {
        if ($controller->addArticle(1, $title, $content)) { // Ajout d'un auteur par défaut (ID = 1)
            $message = 'Article ajouté avec succès.';
        } else {
            $message = 'Une erreur est survenue lors de l\'ajout.';
        }
    } else {
        $message = 'Veuillez remplir tous les champs.';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Article</title>
    <link rel="stylesheet" href="/public/css/style.css"
</head>
<body>
<h1>Ajouter un Article</h1>
<p style="color: red;"><?= htmlspecialchars($message) ?></p>
<form method="POST">
    <label for="title">Titre:</label>
    <input type="text" id="title" name="title" required>
    <br>
    <label for="content">Contenu:</label>
    <textarea class="article-content" id="content" name="content" required></textarea>
    <br>
    <button type="submit">Ajouter</button>
</form>
<div id="render" class="article-content">
</div>

<script>
    function updateRenderArticle() {
        document.getElementById('render').innerHTML = document.getElementById('content').value;
    }

    document.getElementById('content').addEventListener('input', updateRenderArticle);
</script>

<a href="/articles">Retour à la liste</a>
</body>
</html>