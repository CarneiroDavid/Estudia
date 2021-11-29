<?php

class Classes extends Modele
{
    private $idEtude;
    private $classe;
    private $nom;
    private $eleves = [];
    private $professeur;
    private $matiere = [];
    private $devoirs = [];

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

    public function allClasse()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM etudes");
        $requete -> execute();
        $allClasse = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $allClasse;
    }

    public function insertionClasse($numClasse, $nomClasse)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO etudes (classe, nom) VALUES (?, ?)");
            $requete -> execute([$numClasse, $nomClasse]);
            return true;
        }
        catch(Exception $e)
        {
            return $e -> getMessage();
        }
    }

    /* GET*/
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

    /* SET*/
    public function setIdEtude($idEtude)
    {
        $this -> idEtude = $idEtude;
    }
    public function setClasse($classe)
    {
        $this -> classe = $classe;
    }
    public function setNom($nom)
    {
        $this -> nom = $nom;
    }
}



