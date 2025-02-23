<?php
class ArticleController
{
    private $releaseModel;

    public function __construct()
    {
        $this->releaseModel = new ReleaseModel();
    }

    // Liste des articles
    public function listArticles()
    {
        return $this->releaseModel->getAllArticles();
    }

    // Voir un article par ID
    public function viewArticle($id)
    {
        return $this->releaseModel->getArticle($id);
    }

    // Ajouter un article
    public function addArticle($idAut, $title, $content)
    {
        return $this->releaseModel->addArticle($idAut, $title, $content);
    }

    // Modifier un article
    public function editArticle($id, $title, $content)
    {
        return $this->releaseModel->editArticle($id, $title, $content);
    }

    // Supprimer un article
    public function deleteArticle($id)
    {
        return $this->releaseModel->deleteArticle($id);
    }

    // Rechercher des articles
    public function searchArticles($query)
    {
        return $this->releaseModel->searchArticles($query);
    }
}