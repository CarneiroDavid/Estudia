<?php

class Retard extends Modele
{
    private $idRetard;
    private $idUtilisateur;
    private $idProf;
    private $justification;
    private $verifJustification;
    private $idCours;


    public function eleveRetard($idUser, $idCours, $justification, $verifJustif)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO retards (idUtilisateur, idCours, justification, verifJustification, idProf) VALUES(?, ?, ?, ?, ?)");
            $requete ->execute([$idUser, $idCours, $justification, $verifJustif, $_SESSION['idUtilisateur']]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e ->getMessage();
        }
    }
    function listeRetards($idCours)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * from retards WHERE idCours = ?");
        $requete->execute([$idCours]);
        $listeAbsents = $requete->fetchALL(PDO::FETCH_ASSOC);
        return $listeAbsents;
    }

    function removeRetard($idCours, $idUtilisateur)
    {
        try{
            $requete = $this -> getBdd()-> prepare("DELETE FROM retards WHERE idCours = ? AND idUtilisateur = ?");
            $requete->execute([$idCours, $idUtilisateur]);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
    function updateRetard($idCours, $idUtilisateur, $justification, $verifJustif)
    {
        try{
            $requete = $this -> getBdd()-> prepare("UPDATE retards SET justification = ? , verifJustification = ? WHERE idCours = ? AND idUtilisateur = ?");
            $requete->execute([$justification,$verifJustif,$idCours, $idUtilisateur]);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
    function retardEleve($idUser)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM retards INNER JOIN edt ON edt.idCours = retards.idCours WHERE retards.idUtilisateur = ?");
        $requete -> execute([$idUser]);
        $retards = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $retards;
    }


    public function getIdRetard()
    {
        return $this-> idRetard;
    }
    public function getIdUtilisateur()
    {
        return $this-> idUtilisateur;
    }
    public function getIdProf()
    {
        return $this -> idProf;
    }
    public function getJustification()
    {
        return $this-> justification;
    }
    public function getVerifJustification()
    {
        return $this-> verifJustification;
    }
    public function getIdCours()
    {
        return $this-> idCours;
    }

/////////////////// SET Variable ////////////////////////////
    public function setIdRetard($idRetard)
    {
        $this-> idRetard = $idRetard;
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