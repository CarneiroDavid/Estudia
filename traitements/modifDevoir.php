<?php
require_once "../modeles/modeles.php";
$idEnseignant = $_POST["idProf"];
if(!empty($_POST["modifDevoir"]) && $_POST["modifDevoir"] == 1)
{
    if(!empty($_POST["titreDevoir"]))
    {
        if(!empty($_POST["idClasse"]))
        {
            $objetClasse = new Classes();
            $id = $objetClasse -> verifClasse($_POST["idClasse"]);
            if($id === true)
            {
                if(!empty($_POST["idDevoir"]))
                {
                    $objetDevoir = new Devoir();
                    $id = $objetDevoir -> verifDevoir($_POST["idDevoir"]);
                    if($id === true)
                    {
                        if(!empty($_POST["idProf"]))
                        {
                            $objetProf = new Enseignant();
                            $id = $objetProf -> verifProf($_POST["idProf"]);
                            if($id === true)
                            {
                                if(!empty($_POST["infoDevoir"]))
                                {
                                    if(strlen($_POST["titreDevoir"]) < 100)
                                    {
                                        if(strlen($_POST["infoDevoir"]) < 100)
                                        {
                                            $modif = $objetDevoir -> modificationDevoir($_POST["idDevoir"], $_POST["idClasse"], $_POST["titreDevoir"], $_POST["infoDevoir"]);
                                            if($modif == true)
                                            {
                                                header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&success=modifDevoir");
                                            }
                                            else
                                            {
                                                header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=pbModif");
                                            }
                                        }
                                        else
                                        {
                                            header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=infoDevoirLong");
                                        }
                                    }
                                    else
                                    {
                                        header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=titreDevoirLong");
                                    }
                                }
                                else
                                {
                                    header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=pbInfoDevoir");
                                }
                            }
                            else
                            {
                                header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=idProfFaux");
                            }
                        }
                        else
                        {
                            header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=pbIdProf");
                        }
                    }
                    else
                    {
                        header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=idDevoirFaux");
                    }
                
                }
                else
                {
                    header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=pbDevoir");
                }
            }
            else
            {
                header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=idClasseFaux");
            }
        }
        else
        {
            header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=classeNonselect");
        }
    }
    else
    {
        header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=pbTitre");
    }
}
else
{
    header("location:../pages/infoUtilisateur.php?idEnseignant=$idEnseignant&error=pb");
}