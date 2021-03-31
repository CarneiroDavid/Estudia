<?php

require_once "../modeles/modeles.php";

if(isset($_POST["bouton"]) && !empty($_POST["bouton"]) && $_POST["bouton"] == 1)
{
    if(!empty($_POST["identifiant"]) && !empty($_POST["mdp"]))
    {
        if($_POST["mdp"] >= 0)
        {
            $requete = getBdd() -> prepare("SELECT mdp FROM utilisateur WHERE identifiant = ?");
            $requete -> execute([$_POST["identifiant"]]);
            if($requete -> rowCount() > 0)
            {
                $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
                if(password_verify($_POST["mdp"], $utilisateur["mdp"]))
                {
                    if(connexion($_POST["identifiant"], $_POST["mdp"]) == true)
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
                    header("location:../pages/index.php?error=FalseMdp");
                }
            }else{
                    header("location:../pages/index.php?error=FalseId");
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