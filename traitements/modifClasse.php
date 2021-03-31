<?php
require_once "../modeles/modeles.php";

$id = $_POST["envoi"];
if(!empty($_POST["envoi"]))
{
    if(!empty($_POST["classe"]))
    {
        if(modifClasse($_POST["classe"], $_POST["envoi"]) == true)
        {
            header("location:../pages/infoEleve.php?id=$id&succes=modifClasse");
        }
        else
        {
            header("location:../pages/infoEleve.php?id=$id&erreur=modifClasse");
        }
    }
    else
    {
        header("location:../pages/infoEleve.php?id=$id&erreur=selectClasse");
    }
}
else
{
    header("location:../pages/infoEleve.php?id=$id&erreur=boutonEnvoi");
}