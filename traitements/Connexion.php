<?php
require_once "../modeles/modeles.php";

$utilisateur = new User();

if(isset($_POST["bouton"]) && !empty($_POST["bouton"]) && $_POST["bouton"] == 1)
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["mdp"]))
    {
        if($_POST["mdp"] >= 0)
        {
            $verifConnexion = $utilisateur -> verifMdp($_POST["identifiant"], $_POST["mdp"]);
            if($verifConnexion === true)
            {
                if($utilisateur -> connexion($_POST["identifiant"], $_POST["mdp"]) === true)
                {
                    header("location:../pages/index.php?succes=Connexion");
                }
                else
                {
                    header("location:../pages/index.php?error=Connexion");
                }
            }
            else
            {
                header("$verifConnexion");
            }
        }
        else
        {
            header("location:../pages/index.php?error=TailleMdp");
        } 
    }
    else
    {
        header("location:../pages/index.php?error=FormConnec");
    }
}