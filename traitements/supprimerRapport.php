<?php
require_once "../modeles/modeles.php";
$objetUser = new User($_GET["id"]);
$idUser = $objetUser -> getIdUser();

if(!empty($_SESSION) && $_SESSION["statut"] === "Administration" || $_SESSION["statut"] === "Professeur")
{
    if(!empty($_POST["Supprimer"]) && $_POST["Supprimer"] == 1)
    {   
        if(!empty($_POST["id"]))
        {
            $objetPunition = new Punition($_POST["id"]);
            $id = $objetPunition -> verificationRapport($_GET ["id"], $_SESSION["idUtilisateur"], $_POST["id"]);

            if(!empty($id))
            {
                if($objetPunition -> suppressionPunition($_POST["id"]) === true)
                {
                    header("location:../pages/infoUtilisateur.php?id=$idUser&success=Suppression");
                }
                else
                {

                    header("location:../pages/infoUtilisateur.php?id=$idUser&error=Suppression");
                }
            }
            else
            {

                header("location:../pages/infoUtilisateur.php?id=$idUser&error=pb");
            }
        }
        else
        {
            header("location:../pages/infoUtilisateur.php?id=$idUser&error=pb");
        }
    }
    else
    {

       header("location:../pages/infoUtilisateur.php?id=$idUser&error=pb");
    }
}
else
{
    header("location:../pages/infoUtilisateur.php?id=$idUser&error=pb");
}
