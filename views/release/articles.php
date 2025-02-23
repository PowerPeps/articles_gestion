<?php
$controller = new ArticleController();
$articles = $controller->listArticles();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Articles</title>
    <link rel="stylesheet" href="/public/css/style.css"
</head>
<body>
<div class="logout" w3-include-html="\logout"></div>

<h1>Liste des Articles</h1>
<a href="/articles/add">Ajouter un Article</a>
<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= htmlspecialchars($article['id']) ?></td>
                <td><?= htmlspecialchars($article['title']) ?></td>
                <td>
                    <a href="/articles/view?id=<?= urlencode($article['id']) ?>">Voir</a>
                    <a href="/articles/edit?id=<?= urlencode($article['id']) ?>">Modifier</a>
                    <a href="/articles/delete?id=<?= urlencode($article['id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Aucun article trouvé.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>
<script src="/public/js/include-html.js"></script>
<script>includeHTML();</script>
</html>