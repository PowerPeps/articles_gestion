<?php
$articleController = new ArticleController();
$AuthController = new AuthController();
$articles = $articleController->listLastArticles(constant('RELEASE_LIMIT_LAST_ARTICLE'));

?>

<!DOCTYPE html>
<html>
<head>
    <title>Articles</title>
</head>
<body>

<h1><span>Art</span><span>icles</span></h1>
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

