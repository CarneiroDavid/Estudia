<?php

function ajouterProf($nom, $prenom, $identifiant)
{
    $requete = getBdd() -> prepare("SELECT idUtilisateur FROM utilisateur WHERE identifiant = ?");
    $requete -> execute([$identifiant]);
    $idUtilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
    try{
        $requete = getBdd() -> prepare("INSERT INTO enseignants (nom, prenom, idUtilisateur) VALUES (?, ?, ?)");
        $requete -> execute([$nom, $prenom, $idUtilisateur["idUtilisateur"]]);
    }catch(Exception $e)
    {
        ?>

        <div class="alert alert-danger mt-3">
            Erreur d'enregisrement.<br>
            <?= $e -> getMessage();?>
        </div>
        
        <?php
    }
}