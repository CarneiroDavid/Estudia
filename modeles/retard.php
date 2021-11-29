<?php

class Retard extends Modele
{
    public function eleveRetard($idUser, $idEtude, $idProf, $idMatiere, $justification, $veifJustif)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO retards (idUtilisateur, idEtude, idProf, idMatiere, laDate, justification, verifJustification) VALUES(?, ?, ?, ?, NOW(), ?, ?)");
            $requete ->execute([$idUser, $idEtude, $idProf, $idMatiere, $justification, $veifJustif]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e ->getMessage();
        }
    }
}