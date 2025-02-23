<?php

$commentController = new CommentController();
$articleId = $_GET['article_id'] ?? null;

if (!$articleId) {
    http_response_code(400);
    die('ID d\'article non spécifié.');
}

$comments = $commentController->listCommentsByArticle($articleId);
foreach ($comments as $comment): ?>
    <div class="comment">
        <strong><?= UserRepository::getUsernameById($comment['id_us'])['username']?></strong>
        <p class="content"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
        <em class="date">Posté le : <?= htmlspecialchars($comment['date_create']) ?> ; <?= htmlspecialchars("modifié le : " . ($comment['date_modif']) ?? '') ?></em>
    </div>
<?php endforeach; ?>