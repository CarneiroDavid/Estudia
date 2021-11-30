<?php 
require_once "entete.php";
if($_SESSION["statut"] == "Administration" || $_SESSION["statut"] == "Professeur")
{
    $objetClasse = new Classes();
    $classes = $objetClasse -> allClasse();
    ?>
    
    <br>
    <!-- Select Des classe -->
    <form method="post">
        <div class="form-group">
            <label for="classe">Classes</label>
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
            <button type="submit" value="1" name="envoi" class="btn btn-primary">Valider</button>
        </div>
    </form>
    <!-- <form method="post" action="../traitements/verifClasse.php">
        <div class="mb-3">
            <label for="creerClasse" class="form-label">Créer une classe</label>
            <input type="text" name="classe" class="form-control" id="creerClasse">
            <label for="numClasse" class="form-label">Numéro de la classe</label>
            <input type="number" name="numClasse" class="form-control" id="numClasse">
        </div>
        <button type="submit" class="btn btn-primary">Creer</button>
    </form> -->
    <br>
    <?php
    /* Affichage des eleves a partir de la classe */
        if(!empty($_POST["classe"]))
        {
            $requete = getBdd() -> prepare("SELECT nom, prenom, idUtilisateur FROM eleve WHERE idEtude = ? ORDER BY nom ASC");
            $requete -> execute([$_POST["classe"]]);
            $eleves = $requete -> fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <ul class="list-group">
                <?php
                foreach($eleves as $eleve)
                {   
                    ?>
                        <li class="list-group-item"><?=$eleve["nom"]. " ". $eleve["prenom"];?>
                        <span style="float:right;">
                        <a class="btn btn-warning btn-sm" href="infoUtilisateur.php?id=<?=$eleve["idUtilisateur"]?>">Info</a>
                        <a class="btn btn-danger btn-sm" href="modifClasse.php?suppr=<?=$eleve["idUtilisateur"]?>">Supprimer</a>
                        </span>
                        </li>   
                    <?php
                }
                ?>
            </ul
            ><?php
        }
    ?>
            
    <?php
    require_once "footer.php";
}
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}

