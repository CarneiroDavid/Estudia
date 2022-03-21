<?php 
require_once "entete.php";
$objetUser = new User();
$ip = $objetUser -> recupIpAutorise($_SERVER["REMOTE_ADDR"]);
if(isset($_GET["error"]))
    {
        ?>
        <div class="alert alert-danger">
        <?php
        
        switch($_GET["error"])
        {
            case "NoteNonEnvoyee":
                echo "Une erreur est survenue lors de l'enregistrement, veuillez réessayer.";
                break;
            case "ChampVide":
                echo "La matière n'a pas été renseigné. ";
                break;
            case "commentaireTropLong" :
                echo "Le commentaire saisit est trop long.";
                break;
            case "NotePasUnChiffre" :
                echo "La note saisit n'est pas un nombre";
                break;
        }
        ?>
        </div>
        <?php
    }
?>
<br>

<?php
if(!empty($_SESSION["identifiant"]) && $_SESSION["statut"] == "Professeur" && $_SERVER["REMOTE_ADDR"] == $ip["ip"])
{

    ListeClasse();
    ?>
   
    <br>

    <?php

    if(!empty($_POST["ajoutNote"]))
    {
        formulaireNote($_POST["classe"]);
    }
    if(!empty($_POST["ajoutDevoir"]))
    {
        formulaireDevoir($_POST["classe"]);
    }
}   
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
require_once "footer.php";
?>