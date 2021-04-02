<?php
require_once "entete.php";
    $requete = getBdd() -> prepare("SELECT *  FROM enseignants  ORDER BY Nom ASC ");
    $requete -> execute();
    $enseignants = $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    print_r($enseignants);
    ?>
        
    <ul class="list-group">
    <?php
    // print_r($eleves);
    foreach($enseignants as $enseignant)
    {   
        ?>
        <li class="list-group-item"><?=$enseignant["Nom"]. " ". $enseignant["Prenom"];?>
        <span style="float:right;">
        <a class="btn btn-warning btn-sm" href="infoUtilisateur.php?idEnseignant=<?=$enseignant["idUtilisateur"]?>">Info</a>
        </span>
        </li>   
        <?php
        }
        ?></ul>
