<?php
require_once "../modeles/modeles.php";
$id = $_POST["envoi"];
if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
{
    $prof = new Enseignant();
    $test = $prof -> modifMatiere($_POST["envoi"], $_POST["matiere"]);
    if($test == "success"){
        header("location:../pages/infoUtilisateur.php?success=ModifMatiere&idEnseignant=$id");
    }else{
        header("location:../pages/infoUtilisateur.php?error=$test&idEnseignant=$id");
    }
}else{
    header("location:../pages/infoUtilisateur?error=prof&idEnseignant=$id");
    
}