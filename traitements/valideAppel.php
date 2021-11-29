<?php
require_once "../modeles/modeles.php";

if(!empty($_POST["valideAppel"]) && $_POST["valideAppel"] == 1)
{
    $objetEnseignant = new Enseignant();
    $infoProf =$objetEnseignant -> infoEnseignant($_SESSION["idUtilisateur"]);
    foreach($_POST["Classe"]["eleve"] as $x =>$eleve)
    {
        if($eleve["presence"] == 0)
        {
            $objetPresence = new Presence();
            $objetPresence -> elevePresent($eleve["idUtilisateur"], $eleve["idEtude"], $eleve["idProf"], $infoProf["idMatiere"]);
        }
        if($eleve["presence"]== 1)
        {
            $objetAbsence = new Absence();
            if(empty($eleve["valideJustif"]))
            {
                $objetAbsence -> eleveAbsent($eleve["idUtilisateur"], $eleve["idEtude"], $eleve["idProf"], $infoProf["idMatiere"], $eleve["justification"], 'non');

            }
            if(!empty($eleve["valideJustif"]))
            {
                $objetAbsence -> eleveAbsent($eleve["idUtilisateur"], $eleve["idEtude"], $eleve["idProf"], $infoProf["idMatiere"], $eleve["justification"],'oui' );

            }
        }
        if($eleve["presence"] == 2)
        {
            $objetRetard = new Retard();
            if(empty($eleve["valideJustif"]))
            {
                $objetRetard -> eleveRetard($eleve["idUtilisateur"], $eleve["idEtude"], $eleve["idProf"], $infoProf["idMatiere"], $eleve["justification"], 'non');

            }
            if(!empty($eleve["valideJustif"]))
            {
                $objetRetard -> eleveRetard($eleve["idUtilisateur"], $eleve["idEtude"], $eleve["idProf"], $infoProf["idMatiere"], $eleve["justification"],'oui' );

            }
        }           
    }    
}