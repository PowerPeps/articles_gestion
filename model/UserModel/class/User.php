<?php
class User
{
    private $id;
    private $nom;
    private $prenom;
    private $username;
    private $password;
    private $userLevel;

    public function __construct($id = null, $username = null, $password = null, $nom = null, $prenom = null, $userLevel = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->userLevel = $userLevel;
    }

    // Getters et setters (inchangés)
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getUserLevel() { return $this->userLevel; }

    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setUsername($username) { $this->username = $username; }
    public function setPassword($password) { $this->password = $password; }
    public function setUserLevel($userLevel) { $this->userLevel = $userLevel; }
}