<?php
require_once "entete.php";
if($_SESSION["statut"] == "Administration")
{
    $objet_enseignant = new Enseignant();
    $enseignants = $objet_enseignant->listeEnseignants();
    
    ?>
        <h3 id="titre">Enseignants</h3>
    <ul class="list-group">
    <?php
    /* Affichage des enseignants */
    foreach($enseignants as $enseignant)
    {   
        ?>
        <li class="list-group-item"><?=$enseignant["Nom"]. " ". $enseignant["Prenom"];?>
        <span class="listeEnseignant-bouton-info">
        <a class="btn btn-warning btn-sm" href="infoUtilisateur.php?idEnseignant=<?=$enseignant["idUtilisateur"]?>">Info</a>
        </span>
        </li>   
        <?php
    }
    ?>
    </ul>
    <?php
}
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}
require_once "footer.php";    