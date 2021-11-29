<?php

class Examen extends Modele
{
    private $idExamen;
    private $nom;
    private $idProf;
    private $matiere;
    private $idEtude;
    private $note = [];

    public function __construct($idExamen = null)
    {
        if($idExamen != null)
        {
            $requete = $this ->getBdd() -> prepare("SELECT * FROM examen WHERE idExamen = ?");
            $requete -> execute([$idExamen]);
            $examen = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> idExamen = $idExamen;
            $this -> nom = $examen["nom"];
            $this -> idProf = $examen["idProf"];
            $this -> matiere = $examen["matiere"];
            $this -> idEtude = $examen["idEtude"];
        }
    }
    public function insertExam($nom, $idProf, $matiere, $idClasse)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO examen (nom, idProf, matiere, idEtude) VALUES (?, ?, ?, ?)");
            $requete -> execute([$nom, $idProf, $matiere, $idClasse]);
            return true;

        }
        catch(Exception $e)
        {

        }
    }
    public function idExam($nom)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM examen WHERE nom = ?");
        $requete -> execute([$nom]);
        $exam = $requete -> fetch(PDO::FETCH_ASSOC);
        return $exam;
    }

    public function examProf($idProf)
    {
        $requete = $this -> getBdd() ->prepare("SELECT * FROM examen WHERE idProf = ?");
        $requete -> execute([$idProf]);
        $exam = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $exam;
    }
}