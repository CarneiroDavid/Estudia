<?php

// Select des classe pour ajouter note et formulaire
function ListeClasse()
{
    ?>
    <form method="post" id="formListeClasse">
    <div class="form-group">
        <label for="classe">Classes</label>
        <select class="form-control" name="classe" id="classe" aria-label="Default select example">
        <?php 
        
        $requete = getBdd() -> prepare("SELECT * FROM etudes");
        $requete -> execute();
        $classes = $requete -> fetchAll(PDO::FETCH_ASSOC);

        foreach($classes as $classe)
        {
        
                
        ?>

        <option value="<?=$classe["idEtude"];?>" <?= (isset($_POST["classe"]) && $_POST["classe"] == $classe["idEtude"] ? "selected" : "");?>>
            <?=$classe["nom"]. " ".$classe["classe"];?>
        </option>
        <?php
        }
    
        ?>
        </select>

        

        <button type="submit" value="1" name="ajoutNote" class="btn">Ajouter note</button>
        <button type="submit" value="1" name="ajoutDevoir" class="btn">Ajouter devoirs</button>
    </div>

    </form>

    <?php
}

// Ajouter des notes
function formulaireNote($idClasse)
{
    $requete = getBdd() -> prepare("SELECT nom, prenom, idUtilisateur FROM eleve WHERE idEtude = ? ORDER BY nom ASC");
    $requete -> execute([$_POST["classe"]]);
    $eleves = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT idMatiere, matiere FROM matieres");
    $requete -> execute();
    $matieres = $requete ->fetchAll(PDO::FETCH_ASSOC);
    
    ?>

    <form method="post" id="formulaireNote" action="../traitements/VerifNote.php">
    <label for="matiere">Matieres</label>
    <select class="form-group" name="matiere">
        <?php
            foreach($matieres as $matiere)
            {
                ?>
                <option value="<?=$matiere["idMatiere"];?>"><?=$matiere["matiere"];?></option>
                <?php
            }
        ?>
    </select>
    <div>
        <label for="designation">Nom</label>
        <input type="text" class="form-group" name="designation" id="designation">
    </div>
    <div>
        <label for="NoteMax">Note Max</label>
        <input type="number" min=5 max=20 class="form-group" name="noteMax" id="noteMax">
    </div>

    <ul class="list-group">
    
    <?php
    
    foreach($eleves as $eleve)
    {   
        ?>
            <li class="list-group-item"><?=$eleve["nom"]. " ". $eleve["prenom"];?>
            <!-- <span style="float:right;"> -->
            <input type="number" class="form-group" name="note[<?=$eleve["idUtilisateur"];?>]" id="note">
            <!-- </span> -->
              
            <div class="form-group">
            <label for="commentaire">Commentaires</label>
            <input type="note" class="form-control" name="commentaire[<?=$eleve["idUtilisateur"];?>]" id="commentaire"/>
            </div>
            </li> 
        <?php
    }
    ?></ul><button type="submit" name="envoi" value="1">Valider</button></form><?php
}

function ListeStatut(){
    $requete = getBdd() -> prepare("SELECT statut FROM statuts");
    $requete -> execute();
    $statuts = $requete -> fetchAll(PDO::FETCH_ASSOC);
    return $statuts;
}

// Ajouter des devoirs
function formulaireDevoir($idClasse)
{
    $requete = getBdd() -> prepare("SELECT * FROM matieres");
    $requete -> execute();
    $matieres = $requete ->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <form method="post" id="formulaireDevoir" action="../traitements/verifDevoir.php">
        <label for="matiere">Matiere</label>
        <select class="form-group" name="matiere">
                <?php
            foreach($matieres as $matiere)
            {
                ?>
                <option value="<?=$matiere["idMatiere"];?>"><?=$matiere["matiere"];?></option>
                <?php
            }
                ?>
        </select>
        <div>
        <label for="titre">Titre</label>
        <input type="text" class="form-group" name="titre" id="titre">
        </div>
        <div>
        <label for="info">Info</label>
        <input type="text" class="form-group" name="info">
        </div>
        <div>
        <label for="date">Date</label>
        <input type="date" class="form-group" name="date" id="date">
        </div>
        <input type="text" style="display:none;" class="form-group" name="idEtude" value="<?=$idClasse;?>">

        <button type="submit" class="btn btn-primary" name="ajoutDevoir" value="1" id="ajoutDevoir">Ajouter le devoir</button>
    </form>
    <?php
}