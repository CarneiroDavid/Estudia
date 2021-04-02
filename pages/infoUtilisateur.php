<?php
require_once "entete.php";
if(!empty($_GET["id"]))
{
    $requete = getBdd() -> prepare("SELECT eleve.nom AS nom, etudes.nom AS titre, etudes.classe, prenom, idUtilisateur FROM eleve LEFT JOIN etudes USING(idEtude) WHERE idUtilisateur = ?");
    $requete -> execute([$_GET["id"]]);
    $eleve = $requete -> fetch(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT matiere FROM matieres");
    $requete -> execute();
    $matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    $requete = getBdd() -> prepare("SELECT * FROM etudes");
    $requete -> execute();
    $classes = $requete->fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT Note, idUtilisateur, matieres.matiere, designation FROM notes INNER JOIN matieres USING(idMatiere) WHERE idUtilisateur = ?");
    $requete -> execute([$_GET["id"]]);
    $notes = $requete -> fetchAll(PDO::FETCH_ASSOC);
    $listenote = [];
    $i = 0;
    foreach($notes as $note)
    {
        $listenote[$note["matiere"]][$i]["notes"] = $note["Note"];
        $listenote[$note["matiere"]][$i]["designation"] = $note["designation"];
        $i++;
    }
    ?>
    <div class="row"> 
        <div class="col md-4">
            <div class="card">
                <div class="card-body">
    
                    <h5 class="card-title"><?=$eleve["nom"]. " ".$eleve["prenom"];?></h5>
    
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?=$eleve["titre"]." ".$eleve["classe"];?>
                    </h6>
                    <p>
                        Notes de l'élève :
                        <ul>
                        <?php
                        foreach($matieres as $matiere)
                        {
                            ?>
                            <ul class="list-group-item">
                                <?=$matiere["matiere"];?>
                            <?php
                            foreach($listenote as $x => $note)
                            {
                                if($x == $matiere["matiere"])
                                {
                                    foreach($note as $Note)
                                    {                      
                                        ?>
                                        <li><?=$Note["designation"]." : ".$Note["notes"];?></li>
                                    <?php
                                    }
                                }
                            }
                                    ?>
                            </ul>
                            <?php
                        }
                            ?>
                            
                        </ul> 
                    </p>
                    <form method="post" id="ModifierClasse" style="display:none;" action="../traitements/modifClasse.php">
                        <div class="form-group">
                            <label for="classe">Modifier la Classe</label>
                            <select class="form-control" name="classe" id="classe" aria-label="Default select example">
                            <?php 
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
                            <button type="submit" value="<?=$_GET["id"];?>" name="envoi" class="btn">Valider</button>
                        </div>
                        <!-- <div class="form-group text-center">  -->
                                    
                                <!-- </div> -->
                    </form>
                    
                    <div class="text-center">                        
                        <button onclick="afficherModif()" class="btn btn-warning my-2">Modifier</button>
    
                        <a href="supprimerProduit.php?id=<?=$_GET["id"]?>" class="btn btn-danger my-2">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

if(!empty($_GET["idEnseignant"]))
{

    
    $requete = getBdd() -> prepare("SELECT matiere FROM matieres");
    $requete -> execute();
    $matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT *  FROM enseignants  WHERE idUtilisateur = ? ");
    $requete -> execute([$_GET["idEnseignant"]]);
    $enseignant = $requete -> fetch(PDO::FETCH_ASSOC);

    ?>

    <div class="row"> 
        <div class="col md-4">
            <div class="card">
                <div class="card-body">
    
                    <h5 class="card-title"><?=$enseignant["Nom"]. " ".$enseignant["Prenom"];?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?=$enseignant["matiere"];?></h6>

                    <div class="text-center">                        
                        <button onclick="afficherModif()" class="btn btn-warning my-2">Modifier</button>
    
                        <a href="supprimerProduit.php?id=<?=$_GET["idEnseignant"]?>" class="btn btn-danger my-2">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="../traitements/modifMatiere.php" style="display:none;" id="ModifierClasse">
                <label for="matiere">matière</label>
                    <select name="matiere">
                    <?php
                    foreach($matieres as $matiere){
                        
                        ?>
                        <option value="<?=$matiere["matiere"];?>" <?= $matiere["matiere"] == $enseignant["matiere"] ? "selected" : "";?>>
                        
                        
                        <?= $matiere["matiere"];?>
                    
                    
                        </option>
                        <?php

                    }

                    ?>
                    </select>
                    <button type="submit" value="<?=$_GET["idEnseignant"];?>" name="envoi" class="btn">Valider</button>
    </form>



<?php
}
require_once "footer.php";