<?php
require_once "entete.php";

$objetUser = new User();
$ip = $objetUser -> recupIpAutorise($_SERVER["REMOTE_ADDR"]);
if($_SESSION["statut"] == "Professeur" )
{
    $objetClasse = new Classes();
    $classes = $objetClasse -> allClasse();
    ?>
    
    <h3 id="titre">Notes des eleves</h3>
    </br>
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
                </br>
                <button type="submit" value="1" class="btn" name="valideClasse">Valider</button>
            </form> 
            <?php
        }
        if(!empty($_POST["valideClasse"]))
        {
            if(!empty($_POST["classe"]))
            {
                $objetExam = new Examen();
                $exams = $objetExam -> examProf($_SESSION["idUtilisateur"], $_POST["classe"]);

                $objetClasse = new Classes($_POST["classe"]);
                $Examens = $objetClasse -> getExamen();

                ?>
                <h4 id="titre">Selectionner un Examen</h4>
                <label>Choisissez une classe</label>
                <form method="post" action="noteProf.php">
                <select class="form-select" name="classe" aria-label="Default select example">
                <?php
                    for($i = 0; $i < count($Examens); $i++)
                    {
                        ?>
                            
                            <option value="<?=$Examens[$i]->getIdExamen();?>">
                                <?=$Examens[$i] -> getNom();?>
                            </option>
                        <?php
                    }
                ?>
                </select>
                <button type="submit" class="btn" >Valider</button>
                </form>
                <?php           
            }
        }
        if(!empty($_POST["idExamen"]))
        {
            $objetNote = new Notes();
            $notes = $objetNote -> NoteClasse($_SESSION["idUtilisateur"], $_POST["idExamen"]);
            ?>
            <h4 id="titre">Note de la classe</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Note</th>
                    <!-- <th scope="col">Modif</th> -->
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
                            <!-- <td><button class="btn btn-warning">Modifier</button></td> -->
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