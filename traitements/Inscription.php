<?php

require_once "../modeles/modeles.php";

$user = new User();

if(!empty($_POST["envoiIns"]) && $_POST["envoiIns"] == 1)
{
    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["dateNaiss"]) && !empty($_POST["statut"]))
    {
        if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) && !empty($_POST["mail"]) || empty($_POST["mail"]))
        {
            if(strlen($_POST["nom"]) < 100 && strlen($_POST["prenom"]) < 100)
            {   
                if($user -> insertionUser($_POST["mail"], $_POST["nom"], $_POST["prenom"], $_POST["dateNaiss"], $_POST["statut"]) == true)
                {
                    if($_POST["statut"] == "Etudiant")
                    {
                        if($user -> getStatut() -> ajouterEleve($_POST["nom"], $_POST["prenom"], $user -> getId()))
                        {
                            header("location:../pages/formulaireInscription.php?succes=InsertionEleve");
                        }
                        else
                        {
                            header("location:../pages/formulaireInscription.php?succes=Inscription");
                        }
                    }
                    if($_POST["statut"] == "Professeur")
                    {
                        if($user -> getStatut() -> ajouterProf($user -> getId()))
                        {
                            
                            header("location:../pages/formulaireInscription.php?succes=InsertionEleve");
                        }
                        else
                        {
                            header("location:../pages/formulaireInscription.php?succes=Inscription");
                        }
                    }
                }
                else
                {
                    header("location:../pages/formulaireInscription.php?error=Inscription");
                }
            }else
            {
                header("location:../pages/formulaireInscription.php?error=StrlenVar");
            }
        }else
        {
            header("location:../pages/formulaireInscription.php?error=AdressMail");
        }
    }else
    {
        header("location:../pages/formulaireInscription.php?error=VarVide");
    }
}else
{
    header("location:../pages/formulaireInscription.php?error=FormulaireVide");
}


