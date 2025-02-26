<?php

$controller = new ArticleController();
$commentController = new CommentController();

$article = $controller->viewArticle($_GET['id'] ?? null);

if (!$article) {
    die('Article non trouvé.');
}

$userId = $_SESSION['user_id'] ?? null; // ID de l'utilisateur connecté
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voir l'Article</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/public/css/style.css"
</head>
<body>
<h1><?= htmlspecialchars($article['title']) ?></h1>
<div class="article-content">
    <?= strip_tags($article['content'], '<b><strong><i><em><u><s><mark><small><code><q><blockquote><hr><sup><p><a>') ?>
</div>


<a href="/articles">Retour à la liste</a>

<hr>

<?php if ($userId): ?>
    <form id="add-comment-form">
        <textarea name="content" id="comment-content" placeholder="Ajouter un commentaire" required></textarea>
        <input type="hidden" id="article-id" value="<?= htmlspecialchars($article['id']) ?>">
        <button type="submit">Poster</button>
    </form>
<?php else: ?>
    <p>Vous devez être connecté pour ajouter un commentaire.</p>
<?php endif; ?>

<h2>Commentaires</h2>
<div id="comments-container">
    <!-- Les commentaires seront chargés ici via JavaScript -->
</div>

<script>
    $(document).ready(function () {
        const articleId = $('#article-id').val();

        // Charger les commentaires via AJAX
        function loadComments() {
            $.get('/comments', { article_id: articleId }, function (data) {
                $('#comments-container').html(data);
            });
        }

        // Charger les commentaires lorsqu'on arrive sur la page
        loadComments();

        // Ajouter un commentaire via AJAX
        $('#add-comment-form').submit(function (e) {
            e.preventDefault();

            const content = $('#comment-content').val();

            if (content.trim() === '') {
                alert('Le commentaire ne peut pas être vide.');
                return;
            }

            $.post('/comments/add', {
                content: content,
                article_id: articleId
            }).done(function (response) {
                $('#comment-content').val(''); // Vider le champ
                loadComments(); // Recharger les commentaires
            }).fail(function () {
                alert('Erreur lors de l\'ajout du commentaire. Veuillez réessayer.');
            });
        });
    });
</script>
</body>
</html>