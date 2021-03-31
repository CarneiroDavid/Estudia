<?php
require_once "entete.php";
$requete = getBdd() -> prepare("SELECT nom, prenom, idUtilisateur FROM eleve WHERE idUtilisateur = ?");
$requete -> execute([$_GET["idUtilisateur"]]);
$eleves = $requete -> fetch(PDO::FETCH_ASSOC);
// print_r($eleves);

$requete = getBdd() -> prepare("SELECT matiere, idMatiere FROM matieres");
$requete -> execute();
$matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);
// print_r($matieres);

if(!empty($_GET["idUtilisateur"]))
{
    ?>
    <br>
    <form method="post">
    <div class="form-group">
        <h4><?=$eleves["nom"]." ".$eleves["prenom"];?></h4>
        <label for="classe">Matiere</label>
        <select class="form-control" name="matiere" id="matiere" aria-label="Default select example">
        <?php 
        foreach($matieres as $matiere)
            {
            ?>

            <option value="<?=$matiere["idMatiere"];?>">
                <?=$matiere["matiere"];?>
            </option>
            <?php
            }
        
        ?>
        </select>
        <br>
        <div class="form-group">
            <label for="note">Note</label>
            <input type="note" class="form-control" name="note" id="note"/>
        </div>

        <div class="form-group">
            <label for="commentaire">Commentaires</label>
            <input type="note" class="form-control" name="commentaire" id="commentaire"/>
        </div>

        <button type="submit" value="1" name="envoi" class="btn">Valider</button>
    </div>

</form>
        <?php
}
?>
    
<?php
require_once "footer.php";
?>