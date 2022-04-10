<?php

class Notes extends Modele
{
    private $idNote;
    private $idUtilisateur;
    private $note;
    private $idMatiere;
    private $designation;
    private $noteMax;
    private $laDate;
    private $commentaire;

    public function __construct($idNote = null)
    {
        if(!empty($idNote))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM notes WHERE idNote = ?");
            $requete -> execute([$idNote]);
            $notes = $requete -> fetch(PDO::FETCH_ASSOC);
            
            $this -> idNote = $notes["idNote"];
            $this -> idUtilisateur = $notes["idUtilisateur"];
            $this -> note = $notes["Note"];
            $this -> idMatiere = $notes["idMatiere"];
            $this -> designation = $notes["designation"];
            $this -> noteMax = $notes["NoteMax"];
            $this -> laDate = $notes["dateNote"];
            $this -> commentaire = $notes["Commentaire"];

        }
    }

    public function noteEleve($idUtilisateur)
    {
        $requete = getBdd() -> prepare("SELECT Note, notes.idUtilisateur,idProf,idNote,NoteMax, matieres.CoefMatiere, matieres.matiere, designation, commentaire, Coef, dateNote, MONTH(dateNote) as moisNote, DAY(dateNote) as jourNote, Coef, utilisateur.nom, utilisateur.prenom 
        FROM notes 
        INNER JOIN matieres USING(idMatiere) 
        INNER JOIN utilisateur ON notes.idUtilisateur = utilisateur.idUtilisateur 
        WHERE notes.idUtilisateur = ?");
        $requete -> execute([$idUtilisateur]);
        $notes = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }
    public function infoNote($idNote)
    {
        $requete = getBdd() -> prepare(
        "SELECT idNote, notes.idUtilisateur, notes.Note, idProf, notes.idMatiere,matieres.matiere, idExamen, designation, NoteMax, Commentaire, dateNote, enseignants.idEnseignant, enseignants.Nom, enseignants.Prenom, enseignants.idMatiere, enseignants.matiere, Coef, CoefMatiere 
        FROM notes 
        INNER JOIN matieres ON matieres.idMatiere = notes.idMatiere 
        INNER JOIN enseignants ON enseignants.idUtilisateur = notes.idProf 
        WHERE idNote = ?");
        $requete -> execute([$idNote]);
        $infoNote = $requete -> fetch(PDO::FETCH_ASSOC);
        return $infoNote;
    }
    
    public function insertionNote($idUtilisateur, $idProf ,$note, $matiere, $idExam, $designation, $noteMax, $coef, $commentaire)
    {
        try
        {
            
            $requete = $this -> getBdd() -> prepare("INSERT INTO notes (idUtilisateur, idProf ,Note, idMatiere, idExamen, designation, NoteMax,Coef, Commentaire, dateNote) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?, NOW())");
            $requete -> execute([$idUtilisateur, $idProf,$note, $matiere,$idExam, $designation, $noteMax,$coef, $commentaire]);
            return true;
        }
        catch(Exception $e)
        {
            return $e -> getMessage();        
        }

    }
    public function modifierNote($idNote, $note, $designation, $noteMax, $commentaire)
    {
        try
        {
            $requete = $this->getBdd()->prepare("UPDATE notes SET Note = ?, designation = ? , NoteMax = ?, Commentaire = ? WHERE idNote = ?");
            $requete -> execute([$note, $designation, $noteMax, $commentaire ,$idNote]);
            return true;
        }catch(Exception $e){
            return $e -> getMessage(); 
        }
    }

    public function NoteClasse($idUtilisateur, $idExam)
    {
        $requete = $this -> getBdd() -> prepare("SELECT examen.idExamen, examen.nom, examen.idProf, examen.idEtude, notes.idUtilisateur, utilisateur.nom, utilisateur.prenom, notes.Note, notes.NoteMax FROM notes INNER JOIN utilisateur ON notes.idUtilisateur = utilisateur.idUtilisateur INNER JOIN examen USING(idExamen) WHERE notes.idProf = ? and idExamen = ?");
        $requete->execute([$idUtilisateur, $idExam]);
        $notes = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }
    public function suppressionNote($idNote)
    {

    }
    public function  suppressionNoteParExam($idExam)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM notes WHERE idExamen = ?");
            $requete -> execute([$idExam]);
            return true;
        }
        catch (Exception $e)
        {
            echo $e -> getMessage();
        }
    }

////////////// GET VARIABLE ///////////////////
public function getidNote()
{
    return $this -> idNote;
}
public function getidUtilisateur()
{
    return $this -> idUtilisateur;
}
public function getNotes()
{
    return $this -> note;
}
public function getidMatiere()
{
    return $this-> idMatiere;
}
public function getDesignation()
{
    return $this-> designation;
}
public function getNoteMax()
{
    return $this->noteMax;
}
public function getLaDate()
{
    return  $this-> laDate;
}
public function getcommentaire()
{
    return $this->commentaire;
}
///////////////////////////////////////////////
////////////// SET VARIABLE ///////////////////
public function setidNote($idNote)
{
    $this -> idNote = $idNote;
}
public function setidUtilisateur($idUtilisateur)
{
    $this-> idUtilisateur = $idUtilisateur;
}
public function setNotes($notes)
{
    $this-> note = $notes;
}
public function setidMatiere($idMatiere)
{
    $this -> idMatiere = $idMatiere;
}
public function setDesignation($designation)
{
    $this -> designation = $designation;
}
public function setNoteMax($noteMax)
{
    $this-> noteMax = $noteMax;
}
public function setLaDate($laDate)
{
    $this-> laDate = $laDate;
}
public function setcommentaire($commentaire)
{
    $this-> commentaire = $commentaire;
}
///////////////////////////////////////////////
}
