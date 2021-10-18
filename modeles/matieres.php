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
}