<?php

class Classes extends Modele
{
    private $idEtude;
    private $classe;
    private $nom;
    private $eleves = [];
    private $devoirs = [];
    private $examens = [];

    public function __construct($idEtude = null)
    {
        if(!empty($idEtude))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM etudes");
            $requete -> execute();
            $classes = $requete ->fetch(PDO::FETCH_ASSOC);

            $this -> idEtude = $classes["idEtude"];
            $this -> classes = $classes["classe"];
            $this -> nom = $classes["nom"];

            $requete = $this -> getBdd() -> prepare("SELECT * FROM eleve WHERE idEtude = ? ORDER BY nom ASC");
            $requete -> execute([$idEtude]);
            $listeEleves = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($listeEleves as $eleves)
            {
                $this -> eleves[] = new Eleves($eleves["idUtilisateur"]);
            }

            $requete = $this -> getBdd() -> prepare("SELECT * FROM devoirs WHERE idEtude = ?");
            $requete -> execute([$idEtude]);
            $devoirs = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($devoirs as $devoir)
            {
                $this -> devoirs[] = new Devoir($devoir["idDevoir"]);
            }

            $requete = $this -> getBdd() -> prepare("SELECT * FROM examen WHERE idEtude = ?");
            $requete -> execute([$idEtude]);
            $examens = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($examens as $examen)
            {
                $this -> examens[] = new Examen($examen["idExamen"]);
            }
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

    public function verifClasse($id)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idEtude FROM etudes WHERE idEtude = ?");
        $requete -> execute([$id]);
        
        if($requete -> rowCount() === 1)
        {
            return true;
        }
        else
        {
            return false;
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
    public function getEleve()
    {
        return $this -> eleves;
    }
    public function getDevoir()
    {
        return $this -> devoirs;
    }
    public function getExamen()
    {
        return $this -> examens;
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



