<?php

$controller = new ArticleController();
$message = '';
$article = $controller->viewArticle($_GET['id'] ?? null);

if (!$article) {
    die('Article non trouvé.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (!empty($title) && !empty($content)) {
        if ($controller->editArticle($article['id'], $title, $content)) {
            $message = 'Article modifié avec succès.';
        } else {
            $message = 'Une erreur est survenue lors de la modification.';
        }
    } else {
        $message = 'Veuillez remplir tous les champs.';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Article</title>
    <link rel="stylesheet" href="/public/css/style.css"/>
</head>
<body>
<h1>Modifier un Article</h1>
<p style="color: red;"><?= htmlspecialchars($message) ?></p>
<form method="POST">
    <label for="title">Titre:</label>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($article['title']) ?>" required>
    <br>
    <label for="content">Contenu:</label>
    <textarea id="content" name="content" required><?= htmlspecialchars($article['content']) ?></textarea>
    <br>
    <button type="submit">Modifier</button>
</form>
<div id="render" class="article"> <!-- Division pour la prévisualisation -->
    <?= htmlspecialchars($article['content']) ?>
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
