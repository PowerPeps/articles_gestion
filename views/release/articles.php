<?php
$articleController = new ArticleController();
$AuthController = new AuthController();
$articles = $articleController->listArticles();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Articles</title>
</head>
<body>

<h1>Liste des Articles</h1>
<div class="articles">
    <?php if (!empty($articles)): ?>
        <?php foreach ($articles as $article): ?>
                <div class="article" onclick="location.href = '/articles/view?id=<?= urlencode($article['id']) ?>';">
                    <div class="article-title">
                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                    </div>
                    <div class="article-summary">
                        <p>
                            <?php
                            $summary = strip_tags($article['content']); // Supprime les balises HTML
                            if (strlen($summary) > 150) {
                                $summary = substr($summary, 0, 150);
                                $lastSpace = strrpos($summary, ' '); // Trouve la dernière occurrence d'un espace
                                if ($lastSpace !== false) {
                                    $summary = substr($summary, 0, $lastSpace); // Coupe avant le dernier mot
                                }
                                $summary .= '...'; // Ajoute des points de suspension
                            }
                            echo htmlspecialchars($summary);
                            ?>
                        </p>
                    </div>
                    <div class="article-actions">
                        <?php if($AuthController::checkOwnership($article['id_aut'])): ?>
                            <a href="/articles/edit?id=<?= urlencode($article['id']) ?>">Modifier</a>
                        <?php endif;?>
                        <?php if(isset($_SESSION['user_level']) && ($_SESSION['user_level'] >= constant('ADMIN_LEVEL') || $AuthController::checkOwnership($article['id_aut']))): ?>
                            <a href="/articles/delete?id=<?= urlencode($article['id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                        <?php endif;?>
                    </div>
                </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-articles">
            <p>Aucun article trouvé.</p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

