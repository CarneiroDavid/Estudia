<?php
require_once "../modeles/modeles.php";

if(!empty($_POST["ajoutDevoir"]) && $_POST["ajoutDevoir"] == 1)
{   
    if(!empty($_POST["titre"]) && !empty($_POST["date"]))
    {
        if(strlen($_POST["titre"]) <= 100)
        {
            if(strlen($_POST["info"]) <= 250)
            {
                $devoirs = new Devoir();
                if($devoirs -> insertionDevoir($_POST["idEtude"],$_SESSION["idUtilisateur"], $_POST["matiere"], $_POST["titre"], $_POST["info"], $_POST["date"]) == true)
                {
                    header("location:../pages/prof.php?success=Devoir");
                }
                else
                {
                    header("location:../pages/prof.php?error=Devoir");
                }
            }
            else
            {
               header("location:../pages/prof.php?error=InfoLong");
            }
        }
        else
        {
           header("location:../pages/prof.php?error=TitreLong");
        }
    }
    else
    {
       header("location:../pages/prof.php?error=VarVide");
    }
}
else
{
   header("location:../pages/prof.php?error=FormVide");
}