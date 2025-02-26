<?php
$message = '';
$userId = (int)$_SESSION['user_id'] ?? null;

$controller = new CommentController();


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $content = $_POST['content'] ?? '';
        $id = $_POST['id_com'] ?? null;
        $comment = $controller->viewComment($id);

        if (empty($content)) {
            $controller->deleteComment($comment['id']);
        } elseif ($controller->editOwnComment($comment['id'], $userId, $content)) {
            $comment = $controller->viewComment($id); // Mise à jour du commentaire après édition
        } else {
            $message = 'Une erreur est survenue lors de la modification.';
        }
        break;

    case 'GET':
        $id = $_GET['id_com'] ?? null;
        $comment = $controller->viewComment($id);

        if ($comment['id_us'] != $userId) {
            die('Vous n\'êtes pas autorisé à modifier ce commentaire.');
        } elseif (!$userId) {
            die('Vous devez être connecté pour modifier des commentaires.');
        } else {
            $comment = $controller->viewComment($id); // Récupération du commentaire
        }
        break;

    default:
        http_response_code(405); // Méthode non autorisée
        die('Méthode HTTP non autorisée.');
}
?>

<div class="comment">
    <?php if ($message): ?>
        <p class="message <?= $message === 'Une erreur est survenue lors de la modification.' ? 'error' : 'success' ?>">
            <?= $message ?>
        </p>
    <?php endif; ?>
    <form method="POST" action="/comments/edit" onsubmit="submitForm(event, this);">
        <input type="hidden" name="id_com" value="<?= $comment['id'] ?>">
        <textarea id="content" name="content" rows="5"><?= htmlspecialchars($comment['content']) ?></textarea>
        <button type="submit">Enregistrer</button>
    </form>

    <div id="responseMessage"></div>
</div>


<script>
    function submitForm(event, form) {
        event.preventDefault(); // Empêche l'envoi classique du formulaire

        const formData = new FormData(form); // Récupère les données du formulaire

        fetch(form.action, { // URL définie dans le champ "action" du formulaire
            method: form.method, // Méthode définie dans le champ "method" du formulaire
            body: formData
        })
            .then(data => {
                console.log(data)
                if (data.status === 200) {
                    console.log("success")
                    window.location.href = '/articles/view?id=<?= $comment['article_id'] ?>';
                }
            })
            .catch(error => {
                console.error('Erreur :', error);
            });
    }
</script>