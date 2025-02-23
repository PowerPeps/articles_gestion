<?php

class CommentController
{
    private $releaseModel;

    public function __construct()
    {
        $this->releaseModel = new ReleaseModel();
    }

    public function addComment($articleId, $userId, $content)
    {
        return $this->releaseModel->addComment($articleId, $userId, $content);
    }

    public function editOwnComment($commentId, $userId, $content)
    {
        if ($this->releaseModel->isCommentOwner($commentId, $userId)) {
            return $this->releaseModel->updateComment($commentId, $content);
        }
        return false; // L'utilisateur ne possède pas ce commentaire
    }

    public function editComment($id, $content)
    {
        return $this->releaseModel->editComment($id, $content);
    }

    public function deleteComment($id)
    {
        return $this->releaseModel->deleteComment($id);
    }

    public function viewComment($id)
    {
        return $this->releaseModel->getComment($id);
    }

    public function listCommentsByArticle($articleId)
    {
        return $this->releaseModel->getCommentsByArticle($articleId);
    }

    public function getAllComments()
    {
        return $this->releaseModel->getAllComments();
    }
}