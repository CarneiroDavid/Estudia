<?php
require_once "entete.php";
print_r($_SESSION);
if(empty($_SESSION["nom"]))
{
    if(isset($_GET["error"]))
    {
        ?>
        <div class="alert alert-danger">
        <?php
        
        switch($_GET["error"])
        {
            case "FalseMdp":
                echo "Le mot de passe saisit ne correspond a aucun mot de passe connue";
                break;
            case "TailleMdp":
                echo "Le mot de passe saisit doit faire 8 caractères ou plus ";
                break;
            case "FalseId" :
                echo "L'identifiant saisit n'existe pas";
                break;
            case "FormConnec" :
                echo "Le formulaire de connexion est vide";
                break;
            case "Connexion" :
                echo "Nous n'arrivons pas a vous connecter";
                break;

        }

        ?>
        </div>
        <?php
    }
    require_once "formulaireConnexion.php";
}else 
{   
    if(!empty($_SESSION) && $_SESSION["statut"] == "Etudiant")
    {
        
        if(isset($_GET["Jour"]))
        {
            $jour = $_GET["Jour"]." day";
        }
        else
        {
            $jour = "+1 day";
        }
        $demain = date("Y-m-d", strtotime($jour));?><br><?php
        $demainn = date("Y-m-d", strtotime("+0 day"));?><br><?php
        // echo $demainn;
        #mise en page pour chaque user
        ?>
        <div style="float:left;border:2px solid;width:35%;margin-left:1%;">
            <?php
            affichageDevoir(2, $demain);
            ?>
        </div>
        
        <div style="float:left;border:2px solid;width:35%;margin-left:10%;">
            <?php
            affichageNote($_SESSION["idUtilisateur"]);
            ?>
        </div>
        <div style="float:left;border:2px solid;width:35%;margin-left:46%; margin-top:2%">
            <?php
            affichagePunition($_SESSION["idUtilisateur"]);
            ?>
        </div>
        <?php
    }
    if(!empty($_SESSION) && $_SESSION["statut"] == "Administration")
    {
        echo "test";
    }
}