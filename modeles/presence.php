<?php

class Presence extends Modele
{
    public function elevePresent($idUser, $idEtude, $idProf, $idMatiere)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO presence (idUtilisateur, idEtude, idProf, idMatiere, laDate) VALUES(?, ?, ?, ?, NOW())");
            $requete ->execute([$idUser, $idEtude, $idProf, $idMatiere]);
            return true;

        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }
}