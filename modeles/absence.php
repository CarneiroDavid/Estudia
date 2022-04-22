<?php

class Absence extends Modele
{
    private $idAbsence;
    private $idUtilisateur;
    private $idProf;
    private $justification;
    private $verifJustification;
    private $idCours;
    
    public function absenceEleve($idUser)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM absence INNER JOIN edt ON edt.idCours = absence.idCours WHERE absence.idUtilisateur = ?");
        $requete -> execute([$idUser]);
        $absences = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $absences;
    }

    public function eleveAbsent($idUser, $idCours, $justification, $verifJustif)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO absence (idUtilisateur, idCours,justification, verifJustification, idProf) VALUES(?, ?, ?, ?, ?)");
            $requete ->execute([$idUser, $idCours, $justification, $verifJustif, $_SESSION["idUtilisateur"]]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e ->getMessage();
        }
    }
    public function modifAbsence($idCours, $idUtilisateur, $justification, $verifJustif)
    {
        try{
            $requete = $this -> getBdd() -> prepare("UPDATE absence SET justification = ?, verifJustification = ? WHERE idUtilisateur = ? AND idCours = ?");
            $requete->execute([$justification,$verifJustif,$idUtilisateur, $idCours]);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
        
    }
    function listeAbsents($idCours)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * from absence WHERE idCours = ?");
        $requete->execute([$idCours]);
        $listeAbsents = $requete->fetchALL(PDO::FETCH_ASSOC);
        return $listeAbsents;
    }

    function removeAbsent($idCours, $idUtilisateur)
    {
        try{
            $requete = $this -> getBdd()-> prepare("DELETE FROM absence WHERE idCours = ? AND idUtilisateur = ?");
            $requete->execute([$idCours, $idUtilisateur]);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }

    public function getIdAbsence()
    {
        return $this -> idAbsence;
    }
    public function getIdUtilisateur()
    {
        return $this -> idUtilisateur;
    }
    public function getIdProf()
    {
        return $this -> idProf;
    }
    public function getJustification()
    {
        return $this -> justification;
    }
    public function getVerifJustification()
    {
        return $this -> verifJustification;
    }
    public function getIdCours()
    {
        return $this -> idCours;
    }

    
    public function setIdAbsence($idAbsence)
    {
        $this-> idAbsence = $idAbsence;
    }
    public function setIdUtilisateur($idUtilisateur)
    {
        $this-> idUtilisateur = $idUtilisateur;
    }
    public function setIdProf($idProf)
    {
        $this-> idProf = $idProf;
    }
    public function setJustification($justification)
    {
        $this-> justification = $justification;
    }
    public function setVerifJustification($verifJustification)
    {
        $this-> verifJustification = $verifJustification;
    }
    public function setIdCours($idCours)
    {
        $this-> idCours = $idCours;
    }

}