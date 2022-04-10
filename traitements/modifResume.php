<?php
require_once "../modeles/modeles.php";
$objetEdt = new Edt();
if(!empty($_POST["idCours"]))
{
    $edt = $objetEdt ->verifCours($_POST["idCours"], $_POST["idProf"]);
    $idProf = $_POST["idProf"];
    if($edt === true)
    {
        $update = $objetEdt -> postResume($_POST["idCours"], $_POST["resumeCours"]);
        if($update ===true)
        {
            header("location:../pages/infoUtilisateur.php?idEnseignant=$idProf&&success=modifResume");
        }
        else
        {
            header("location:../pages/infoUtilisateur.php?idEnseignant=$idProf&&error=modifResume");
        }
    }
    else
    {
        header("location:../pages/infoUtilisateur.php?idEnseignant=$idProf&&error=donneeCoursFalse");
    }
}
else
{
    header("location:../pages/infoUtilisateur.php?idEnseignant=$idProf&&error=pbresume");
}