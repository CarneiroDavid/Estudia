<?php 
require_once "entete.php";

$objetClasse = new Classes();
$classes = $objetClasse -> allClasse();

if($_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
{
    
    if(empty($_POST["classe"]) && empty($_POST["idExamen"]))
    {
        ?>
        <form method="post" action="devoirClasse.php">
            <label>Choisissez une classe</label>
            <select class="form-select" name="classe" aria-label="Default select example">
            <?php
                foreach($classes as $classe)
                {
                    ?>
                
                        <option value="<?=$classe['idEtude'];?>">
                            <?=$classe["nom"];?> <?=$classe["classe"];?>
                        </option>
                    <?php
                }
            ?>
            </select>
            <button type="submit" value="1" class="btn btn-success" name="valideClasse">Valider</button>
        </form> 
        <?php
    }

    if(!empty($_POST["valideClasse"]))
    {
        if(!empty($_POST["classe"]))
        {
            $objetDevoir = new Devoir();
            $exams = $objetDevoir -> devoirProf($_SESSION["idUtilisateur"], $_POST["classe"]);
            ?>
            <h4 id="titre">Selectionner un Examen</h4>
            <form method="post" action="noteProf.php">
                <?php
                foreach($exams as $exam)
                {
                    ?>
                    <input type="hidden" name="idClasse" value="<?=$_POST["classe"];?>">
                    <button class="btn btn-primary" name="idExamen" value="<?=$exam["idExamen"];?>"><?=$exam["nom"];?></button>
                    <?php
                }
                ?>
            </form>
            <?php           
        }
    }
}
else 
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}