<?php
require_once "entete.php";

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Etudiant")
{
    if(!empty($_GET["idUtilisateur"]) && $_GET["idUtilisateur"] == $_SESSION["idUtilisateur"])
    {
        ?>
           <h3><?=$_SESSION["nom"];?> <?=$_SESSION["prenom"];?></h3>
           <h4><?=$_SESSION["email"];?></h4>
           <p><?=$_SESSION["dateNaiss"];?></p>
        <?php
    }
    else
    {
        header("location:index.php");
    }
}