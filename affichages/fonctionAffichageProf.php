<?php

// Select des classe pour ajouter note et formulaire
function ListeClasse()
{
    ?>
    <form method="post">
    <div class="form-group">
        <label for="classe">Classes</label>
        <select class="form-control" name="classe" id="classe" aria-label="Default select example">
        <?php 
        $objetClasse = new Classes();
        $classes = $objetClasse -> allClasse();

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
        </br>
            <div class="d-flex justify-content-center">
                <button type="submit" value="1" name="ajoutNote" class="btn">Ajouter note</button>
                <button type="submit" value="1" name="ajoutDevoir" class="btn">Ajouter devoirs</button>
            </div>
        </div>

    </form>

    <?php
}

// Ajouter des notes
function formulaireNote($idClasse)
{
    $objetEleve = new Eleves();
    $eleves = $objetEleve -> listeEleveClasse($idClasse);

    
    $objetEnseignant = new Enseignant($_SESSION["idUtilisateur"]);
    $idMatiere = $objetEnseignant -> getIdMatiere();
    $matiere = $objetEnseignant-> getMatiere();

    ?>

    <form method="post" id="formulaireNote" action="../traitements/VerifNote.php">
       
        <div class="mb-3 row">
            <label for="Matiere" class="col-sm-2 col-form-label">Matière : </label>
            <div class="col-sm-10">
                <select class="form-select" name="matiere">
                    <option value="<?=$idMatiere;?>"><?=$matiere;?></option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="Nom" class="col-sm-2 col-form-label">Nom : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="designation" id="designation">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="NoteMax" class="col-sm-2 col-form-label">Note Max : </label>     
            <div class="col-sm-10">
                <input type="number" min="0" class="form-control" name="NoteMax" id="NoteMax">
                <input type="hidden" class="form-control" name="idClasse" id="idClasse" value="<?=$_POST["classe"];?>">
            </div>
        </div>
    
        <div class="div_notes">
            <?php
            foreach($eleves as $eleve)
            {   
                ?>
                    <div class="card col-12 col-md-6 text-center">
                        <div class="mb-3 row">
                            <label for="Note" class="col-sm-12 col-form-label">Note de <?=$eleve["nom"]. " ". $eleve["prenom"];?> : </label>     
                            <div class="col-sm-6 offset-md-3">
                                <input type="number" min="0" class="form-control" name="note[<?=$eleve["idUtilisateur"];?>]" id="Note">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="commentaire">Commentaires</label>
                            <input type="note" class="form-control" name="commentaire[<?=$eleve["idUtilisateur"];?>]" id="commentaire"/>
                        </div>
                    </br>
                    </div>
                <?php
            }
            ?>
        </div>
        </br>
        <div  class="d-flex justify-content-center">
            <button type="submit" name="envoi" class="btn" value="1">Valider</button>
        </div>
    </form>
    <?php
}

// Ajouter des devoirs
function formulaireDevoir($idClasse)
{
    $objetEnseignant = new Enseignant($_SESSION["idUtilisateur"]);
    $idMatiere = $objetEnseignant -> getIdMatiere();
    $matiere = $objetEnseignant-> getMatiere();
    
    ?>
    <form method="post" id="formulaireDevoir" action="../traitements/verifDevoir.php">
        
        <div class="mb-3 row">
            <label for="Matiere" class="col-sm-2 col-form-label">Matière : </label>
            <div class="col-sm-10">
                <select class="form-select" name="matiere">
                    <option value="<?=$idMatiere;?>"><?=$matiere;?></option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="titre" class="col-sm-2 col-form-label">Titre : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titre">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="info" class="col-sm-2 col-form-label">Information : </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="info">
            </div>
        </div>

        <div>
        <label for="date">Date</label>
        <input type="date" class="form-group" name="date" id="date">
        </div>


        <input type="hidden"class="form-group" name="idEtude" value="<?=$idClasse;?>">
        </br>
        <button type="submit" class="btn" name="ajoutDevoir" value="1" id="ajoutDevoir">Ajouter le devoir</button>
    </form>
    <?php
}