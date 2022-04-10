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

            $requete = $this -> getBdd() -> prepare("SELECT * FROM notes INNER JOIN eleve ON eleve.idUtilisateur = notes.idUtilisateur WHERE idExamen = ?");
            $requete -> execute([$idExamen]);
            $Notes = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($Notes as $note)
            {
                $this -> note[] = new Notes($note["idNote"]);
            }
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
    public function supprimerExamen($idExam)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM examen WHERE idExamen = ?");
            $requete -> execute([$idExam]);
            return true;
        }
        catch (Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function examProf($idProf)
    {
        $requete = $this -> getBdd() ->prepare("SELECT *, examen.nom, etudes.nom AS nomClasse FROM examen INNER JOIN matieres ON examen.matiere = idMatiere INNER JOIN enseignants ON enseignants.idUtilisateur = examen.idProf INNER JOIN etudes USING(idEtude) WHERE examen.idProf = ?");
        $requete -> execute([$idProf]);
        $exam = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $exam;
    }
    public function getIdExamen()
    {
        return $this -> idExamen;
    }
    public function getNom()
    {
        return $this -> nom;
    }
    public function getNote()
    {
        return $this -> note;
    }
}