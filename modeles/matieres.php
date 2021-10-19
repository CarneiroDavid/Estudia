<?php 
class Matieres extends Modele
{
    private $idMatiere;
    private $matiere;

    public function __construct()
    {

    }

    public function ajoutMatiere($matiere)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO matieres (matiere) VALUES (?)");
            $requete -> execute([$matiere]);
        }
        catch(Exception $e)
        {
            return $e -> getMessage();
        }
    }

    /* SET */
    public function setIdMatiere($idMatiere)
    {
        $this -> $idMatiere = $idMatiere;
    }
    public function setNom($matiere)
    {
        $this -> matiere = $matiere;
    }

    /* GET */
    public function getIdFiliere()
    {
        return $this -> idMatiere;
    }
    public function getNom()
    {
        return $this -> matiere;
    }
}