<?php

class Classes extends Modele
{
    private $idEtude;
    private $classe;
    private $nom;
    private $eleves = [];
    private $professeur;

    public function __construct($idEtude = null)
    {
        if(!empty($idEtude))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM etudes");
            $requete -> execute();
            $classes = $requete ->fetchAll(PDO::FETCH_ASSOC);

            $this -> idEtude = $classes["idEtude"];
            $this -> classes = $classes["classe"];
            $this -> nom = $classes["nom"];

            $requete = $this -> getBdd() -> prepare("SELECT idUtilisateur FROM eleve WHERE idEtude = ?");
            $requete -> execute([$idEtude]);
            $listeEleves = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($listeEleves as $eleves)
            {
                $this -> eleves[] = new Eleves($eleves["idUtilisateur"]);
            }
            $this -> professeur = new Enseignant();
        }
    }

    public function setEnseignant()
    {
        
    }

    public function getIdEtude()
    {
        return $this -> idEtude;
    }
    public function getClasse()
    {
        return $this -> classe;
    }
    public function getNom()
    {
        return $this -> nom;
    }
}



