<?php
require_once "entete.php";
if(empty($_SESSION["nom"]))
{
    if(isset($_GET["error"])){
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
    #mise en page pour chaque user
    ?><h1>test</h1><?php
    // affichageDevoir(2, date(m.d.y));
    echo date("m+1.d.y");
    echo date("m.d.y");

}