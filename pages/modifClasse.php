<?php 
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT * FROM etudes");
$requete -> execute();
$classes = $requete -> fetchAll(PDO::FETCH_ASSOC);
?>
<!-- <h2>test</h2> -->
<br>
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
        <button type="submit" value="1" name="envoi" class="btn">Valider</button>
    </div>

</form>
<br>
<?php
// print_r($_POST);
    if(!empty($_POST["classe"]))
    {
        $requete = getBdd() -> prepare("SELECT nom, prenom, idUtilisateur FROM eleve WHERE idEtude = ? ORDER BY nom ASC");
        $requete -> execute([$_POST["classe"]]);
        $eleves = $requete -> fetchAll(PDO::FETCH_ASSOC);
        print_r($eleves);
        ?>
        
        <ul class="list-group">
        <?php
        foreach($eleves as $eleve)
        {   
            ?>
                <li class="list-group-item"><?=$eleve["nom"]. " ". $eleve["prenom"];?>
                <span style="float:right;">
                <a class="btn btn-warning btn-sm" href="infoEleve.php?id=<?=$eleve["idUtilisateur"]?>">Info</a>
                <a class="btn btn-danger btn-sm" href="modifClasse.php?suppr=<?=$eleve["idUtilisateur"]?>">Supprimer</a>
                </span>
                </li>   
            <?php
        }
        ?></ul><?php
    }
        ?>
        
<?php
require_once "footer.php";
?>