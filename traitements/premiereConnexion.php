<?php
require_once "../modeles/modeles.php";
if(!empty($_SESSION) && isset($_POST["acceptBoxCGU"]))
{
    $objetUtilisateur = new User();

    if($objetUtilisateur -> accept_CGU($_SESSION["idUtilisateur"]) == true)
    {
        header("location:../traitements/deconnexion.php");

    }
    else
    {
        header("location:../traitements/deconnexion.php?error=CGUnonAccept");

    }
}
else{
    header("location:../traitements/deconnexion.php?error=CGUnonAccept");
}