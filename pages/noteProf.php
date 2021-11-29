<?php
require_once "entete.php";

if($_SESSION["statut"] == "Professeur")
{
    $objetClasse = new Classes();
    $classes = $objetClasse -> allClasse();
    ?>
    
    <h3 id="titre">Notes des eleves</h3>
    <?php
        if(empty($_POST["classe"]) && empty($_POST["idExamen"]))
        {
            ?>
            <form method="post" action="noteProf.php">
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
                $objetExam = new Examen();
                $exams = $objetExam -> examProf($_SESSION["idUtilisateur"], $_POST["classe"]);
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
        if(!empty($_POST["idExamen"]))
        {
            $objetNote = new Notes();
            $notes = $objetNote -> NoteClasse($_SESSION["idUtilisateur"], $_POST["idExamen"]);
            print_r($notes);
            ?>
            <h4 id="titre">Note de la classe</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Note</th>
                    <th scope="col">Modif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($notes as $note)
                    {
                        ?>
                        <tr>
                            <td><?=$note["nom"];?></td>
                            <td><?=$note["Note"];?>/<?=$note["NoteMax"];?></td>
                            <td><button class="btn btn-warning">Modifier</button></td>
                        </tr>
                        <?php
                    }
                    ?>
                    
                </tbody>
            </table>
            <?php
        }
}
else 
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}

require_once "footer.php";