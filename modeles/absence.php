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

    public function eleveAbsent($idUser, $idEtude, $idProf, $idMatiere, $justification, $veifJustif)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO absence (idUtilisateur, idEtude, idProf, idMatiere, laDate, justification, verifJustification) VALUES(?, ?, ?, ?, NOW(), ?, ?)");
            $requete ->execute([$idUser, $idEtude, $idProf, $idMatiere, $justification, $veifJustif]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e ->getMessage();
        }
    }
}