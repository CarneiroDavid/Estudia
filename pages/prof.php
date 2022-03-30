<?php 
require_once "entete.php";
// $objetUser = new User();
// $ip = $objetUser -> recupIpAutorise($_SERVER["REMOTE_ADDR"]);
    if(isset($_GET["error"]))
    {   
        ?>
        <div class="alert alert-danger text-center">
        <?php
        
        switch($_GET["error"])
        {
            case "NoteNonEnvoyee":
                echo "Le formulaire n'a pas été validé, veuillez réessayer";
                break;
            case "ChampVide":
                echo "Un des champs principaux est vide (Matière, Nom), veuillez renseigner tous les champs.";
                break;
            case "nomExam" :
                echo "Le nom de l'examen est vide ou alors est trop long, veuillez remplir le champ ou saisir un nom plus court..";
                break;
            case "noteMaxSup" :
                echo "La note maximale est vide ou alors la valeur saisit est supérieur à 20, veuillez remplir le champ ou saisir une valeur inférieure.";
                break;
            case "coefVide" :
                echo "Le champ du coefficient est vide, veuillez le renseigner.";
                break;
            case "problèmeNote" :
                echo "Un probleme est survenue sur une des notes, veillez à ce que le champ de la note ne soit pas vide et qu'il ne dépasse la note maximale saisit";
                break;
            case "FormVide" :
                echo "Le formulaire n'a pas été renseigner, veuillez réessayer.";
                break;
            case "VarVide" :
                echo "Le titre du devoir n'a pas été saisit, veuillez en saisir un.";
                break; 
            case "TitreLong" :
                echo "Le titre du devoir saisit est trop long, veuillez saisisr un titre inférieur à 100 caractères.";
                break;
            case "InfoLong" :
                echo "L'information saisit est trop longue, veuillez saisir un texte inférieur à 250 caractères.";
                break;   
            case "Devoir" :
                echo "Une erreur est survenue, veuillez réessayer plus tard";
                break;             
                
        }
       
        ?>
        </div>
        <?php
    }
    if(isset($_GET["success"]))
    {   
        ?>
        <div class="alert alert-success text-center">
        <?php
        
        switch($_GET["success"])
        {
            case "Note":
                echo "Les notes ont bien été enregistré, vous pouvez les consulter dans l'onglet 'Note des élèves' ";
                break;
            case "Devoir":
                echo "Le devoir à bien été créé.";
                break;
        }
       
        ?>
        </div>
        <?php
    }
?>
<br>

<?php
if(!empty($_SESSION["identifiant"]) && $_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
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