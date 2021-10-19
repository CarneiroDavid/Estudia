<?php
require_once "entete.php";
    $objet_enseignant = new Enseignant();
    $enseignants = $objet_enseignant->listeEnseignants();
    
    ?>
        
    <ul class="list-group">
    <?php
    /* Affichage des enseignants */
    foreach($enseignants as $enseignant)
    {   
        ?>
        <li class="list-group-item"><?=$enseignant["Nom"]. " ". $enseignant["Prenom"];?>
        <span style="float:right;">
        <!-- <a class="btn btn-warning btn-sm" href="infoUtilisateur.php?id=<?=$enseignant["idUtilisateur"]?>">Info</a> -->
        </span>
        </li>   
        <?php
        }
        ?></ul>
