<?php

$commentController = new CommentController();

$userId = $_SESSION['user_id'] ?? null; // ID de l'utilisateur connecté
$articleId = $_POST['article_id'] ?? null;
$content = $_POST['content'] ?? '';

if (!$userId) {
    http_response_code(401); // Non autorisé
    echo json_encode(['error' => 'Vous devez être connecté pour ajouter un commentaire.']);
    exit;
}

if (empty($articleId) || empty($content)) {
    http_response_code(400); // Mauvaise requête
    echo json_encode(['error' => 'Données invalides.']);
    exit;
}

if ($commentController->addComment($articleId, $userId, $content)) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500); // Erreur serveur
    echo json_encode(['error' => 'Erreur lors de l\'ajout du commentaire.']);
}
