<?php

class Filiere extends Modele
{
    //private $matiere = new Matiere();
    private $idFiliere;
    private $nom;

    public function __construct()
    {
        
    }

    /* SET */
    public function setIdFiliere($idFiliere)
    {
        $this -> idFiliere = $idFiliere;
    }
    public function setNom($nom)
    {
        $this -> nom = $nom;
    }

    /* GET */
    public function getIdFiliere()
    {
        return $this -> idFiliere;
    }
    public function getNom()
    {
        return $this -> nom;
    }
}