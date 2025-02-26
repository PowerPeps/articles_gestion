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
        <em class="date">
            Posté le : <?= htmlspecialchars($comment['date_create']) ?> ; <?= htmlspecialchars("modifié le : " . ($comment['date_modif']) ?? '') ?>
            <a class="quiet" href="/comments/delete?id_com=<?= $comment['id'] ?>">Supprimer</a>
            <a class="quiet" href="/comments/edit?id_com=<?= $comment['id'] ?>" onclick="loadComment(event, this)">Modifier</a>
        </em>
    </div>
<?php endforeach; ?>

<script>
    function loadComment(event, link) {
        event.preventDefault(); // Empêche la navigation normale

        const href = link.getAttribute('href'); // Récupère l'URL cible

        // Utilisation de fetch pour charger le contenu
        fetch(href)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Erreur lors du chargement du commentaire");
                }
                return response.text(); // On récupère le texte HTML
            })
            .then(html => {
                // Remplacement du contenu du <div> avec la classe "comment"
                const commentDiv = link.closest('.comment').querySelector('p');
                if (commentDiv) {
                    commentDiv.innerHTML = html; // Injecte le HTML récupéré
                }
            })
            .catch(error => {
                console.error("Erreur : ", error);
            });
    }
</script>

