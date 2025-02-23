<?php

$controller = new ArticleController();

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); // Validation de l'ID
    if (!$id) {
        die('ID invalide.');
    }

    if ($controller->deleteArticle($id)) {
        header('Location: /articles');
        exit;
    } else {
        die('Erreur lors de la suppression.');
    }
} else {
    die('ID non spécifié.');
}