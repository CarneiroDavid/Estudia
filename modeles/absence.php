<?php

class Absence extends Modele
{
    public function absenceEleve($idUser)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM absence INNER JOIN matieres USING(idMatiere) WHERE idUtilisateur = ?");
        $requete -> execute([$idUser]);
        $absences = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $absences;
    }

    public function eleveAbsent($idUser, $idCours, $justification, $verifJustif)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO absence (idUtilisateur, idCours, justification, verifJustification) VALUES(?, ?, ?, ?)");
            $requete ->execute([$idUser, $idCours, $justification, $verifJustif]);
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

}