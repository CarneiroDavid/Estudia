<?php
require_once "../modeles/modeles.php";

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration" || !empty($_SESSION["statut"]) && $_SESSION["statut"] == "Professeur")
{
    $punition = new Punition();
    ?><pre><?= print_r($_POST)?><?= print_r($_SESSION) ?></pre><?php
    if(!empty($_POST["idEleve"]))
    {
        $id = $_POST["idEleve"];
    }
    if(!empty($_POST["motif"]) && !empty($_POST["punition"]) && !empty($_POST["date"]))
    {   
        
        if(strlen($_POST["motif"]) > 0 && strlen($_POST["motif"]) <= 250)
        {
            if(strlen($_POST["punition"]) > 0 && strlen($_POST['punition']) <= 600)
            {
                if(!empty($_POST["envoi"]))
                {
                    $idEleve = $_POST["envoi"];
                    if($punition -> insertionPunition($idEleve ,  $_SESSION["idUtilisateur"], $_POST["motif"] , $_POST["punition"] , $_POST["date"] ) == true)
                    {
                        
                        header("location:../pages/infoUtilisateur.php?id=$id&success=ajoutPunition");
                    }else{
                        header("location:../pages/infoUtilisateur.php?id=$id&erreur=ajoutPunition");
                    }
                }
                else if(!empty($_POST["modif"]))
                {
                    $idPunition = $_POST["modif"];
                    if($punition -> modificationPunition($idPunition, $_POST["motif"] ,$_POST["date"] ,$_POST["punition"]) == true)
                    {
                        
                        header("location:../pages/infoUtilisateur.php?id=$id&success=modifPunition");
                    }else{
                        header("location:../pages/infoUtilisateur.php?id=$id&erreur=modifPunition");
                    }
                }

            }else{
                header("location:../pages/infoUtilisateur.php?id=$id&erreur=lenPunition");
            }



        }else{

            header("location:../pages/infoUtilisateur.php?id=$id&erreur=lenMotif");
        }


    }else{

        header("location:../pages/infoUtilisateur.php?id=$id&erreur=Formvide");
    }


}else{
    header("location:index.php?erreur=statut");
}