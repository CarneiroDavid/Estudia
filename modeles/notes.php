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
            $this -> laDate = $notes["laDate"];
            $this -> commentaire = $notes["Commentaire"];

        }
    }

    public function noteEleve($idUtilisateur)
    {
        // rajouter inner join pour avoir la matiere
        $requete = $this -> getBdd() -> prepare("SELECT * FROM notes WHERE idUtilisateur = ?");
        $requete -> execute([$idUtilisateur]);
        $notes = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $notes;
    }
    
    public function insertionNote($idUtilisateur, $note, $matiere, $designation, $noteMax)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO notes (idUtilisateur, Note, idMatiere, designation, NoteMax) VALUES (?, ?, ?, ?, ?)");
            $requete -> execute([$idUtilisateur, $note, $matiere, $designation, $noteMax]);
            return true;
        }
        catch(Exception $e)
        {
            return $e -> getMessage();        
        }

    }
    public function modifierNote($idNote, $note, $matiere, $designation, $noteMax, $commentaire)
    {
        try
        {
            $requete = $this->getBdd()->prepare("UPDATE notes SET Note = ?, idMatiere = ? , designation = ? , NoteMax = ?, Commentaire = ? WHERE idNote = ?");
            $requete -> execute([$note, $matiere, $designation, $noteMax, $commentaire ,$idNote]);
            return true;
        }catch(Exception $e){
            return $e -> getMessage(); 
        }
    }
    public function suppressionNote($idNote)
    {

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