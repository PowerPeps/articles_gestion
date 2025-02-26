<?php
class ReleaseModel extends DB_PDO
{
    public function __construct()
    {
        parent::__construct(RELEASE_DB_CONNECT, RELEASE_DB_USER, RELEASE_DB_PASSWORD);
    }

    // ===================== Gestion des Articles =====================

    // Ajouter un article
    public function addArticle($idAut, $title, $content)
    {
        $stmt = self::$pdo->prepare("INSERT INTO articles (id_aut, title, content) VALUES (:idAut, :title, :content)");
        $stmt->bindValue(':idAut', $idAut, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Modifier un article
    public function editArticle($id, $title, $content)
    {
        $stmt = self::$pdo->prepare("UPDATE articles SET title = :title, content = :content WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Supprimer un article
    public function deleteArticle($id)
    {
        $stmt = self::$pdo->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer un article (par ID)
    public function getArticle($id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les articles
    public function getAllArticles()
    {
        $stmt = self::$pdo->query("SELECT * FROM articles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastArticles($nb) {
        $stmt = self::$pdo->query("SELECT * FROM articles ORDER BY date_create DESC LIMIT $nb");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les articles d'un auteur
    public function getArticlesByAuthor($idAut)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM articles WHERE id_aut = :idAut");
        $stmt->bindValue(':idAut', $idAut, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===================== Gestion des Commentaires =====================

    // Ajouter un commentaire
    public function addComment($articleId, $idUs, $content)
    {
        $stmt = self::$pdo->prepare("INSERT INTO comments (article_id, id_us, content) VALUES (:articleId, :idUs, :content)");
        $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $stmt->bindValue(':idUs', $idUs, PDO::PARAM_INT);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Modifier un commentaire
    public function editComment($id, $content)
    {
        $stmt = self::$pdo->prepare("UPDATE comments SET content = :content WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Supprimer un commentaire
    public function deleteComment($id)
    {
        $stmt = self::$pdo->prepare("DELETE FROM comments WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Récupérer un commentaire spécifique
    public function getComment($id)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM comments WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer les commentaires d'un article
    public function getCommentsByArticle($articleId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM comments WHERE article_id = :articleId");
        $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les commentaires d'un utilisateur
    public function getCommentsByUser($idUs)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM comments WHERE id_us = :idUs");
        $stmt->bindValue(':idUs', $idUs, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les commentaires
    public function getAllComments()
    {
        $stmt = self::$pdo->query("SELECT c.id, c.article_id, c.content, c.id_us, u.username, c.date_create
                               FROM comments c
                               INNER JOIN users u ON c.id_us = u.id
                               ORDER BY c.date_create DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Récupérer les commentaires d'un utilisateur seulement
    public function getUserComments($userId)
    {
        $stmt = self::$pdo->prepare("SELECT * FROM comments WHERE id_us = :userId");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Vérifier si l'utilisateur est l'auteur d'un commentaire
    public function isCommentOwner($commentId, $userId)
    {
        $stmt = self::$pdo->prepare("SELECT id FROM comments WHERE id = :commentId AND id_us = :userId");
        $stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

// Modifier un commentaire si l'utilisateur est propriétaire
    public function updateComment($commentId, $content)
    {
        $stmt = self::$pdo->prepare("UPDATE comments SET content = :content WHERE id = :commentId");
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':commentId', $commentId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function searchArticles($query)
    {
    }
}