<?php
$userId = (int)$_SESSION['user_id'] ?? null;

$controller = new CommentController();
$userController = new AuthController();


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $id = $_GET['id_com'] ?? null;
        $comment = $controller->viewComment($id);
        if ($userController->checkPermission(constant('ADMIN_LEVEL'))) $controller->deleteComment($id);
        header( 'Location: /articles/view?id=' . $comment['article_id']);
        break;

    default:
        http_response_code(405); // Méthode non autorisée
        die('Méthode HTTP non autorisée.');
}
?>