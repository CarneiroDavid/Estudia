<?php

class Retard extends Modele
{
    public function eleveRetard($idUser, $idCours, $justification, $verifJustif)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO retards (idUtilisateur, idCours, justification, verifJustification) VALUES(?, ?, ?, ?)");
            $requete ->execute([$idUser, $idCours, $justification, $verifJustif]);
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
}