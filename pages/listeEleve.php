<?php
require_once "entete.php";
    $requete = getBdd() -> prepare("SELECT eleve.nom AS nom, etudes.nom AS titre, etudes.classe, prenom, idUtilisateur FROM eleve LEFT JOIN etudes USING(idEtude) ORDER BY eleve.nom ASC ");
    $requete -> execute();
    $eleves = $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    ?>
        
    <ul class="list-group">
    <?php
    foreach($eleves as $eleve)
    {   
        ?>
        <li class="list-group-item"><?=$eleve["nom"]. " ". $eleve["prenom"]." : ".$eleve["titre"]." ".$eleve["classe"];?>
        <span style="float:right;">
        <a class="btn btn-warning btn-sm" href="infoUtilisateur.php?id=<?=$eleve["idUtilisateur"]?>">Info</a>
        </span>
        </li>   
        <?php
        }
        ?></ul>
