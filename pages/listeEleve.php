<?php
require_once "entete.php";
if($_SESSION["statut"] == "Administration")
{
    
    $objet_eleves = new Eleves();
    $eleves = $objet_eleves->listeEleves();
    
    ?>
        
    <ul class="list-group">
    <?php
    /* Affichage des eleves */
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
        <?php
        require_once "footer.php";
}
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}

