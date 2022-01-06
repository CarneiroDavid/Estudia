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
            $devoirs = $objetDevoir -> devoirProf($_SESSION["idUtilisateur"], $_POST["classe"]);
            $i=0;
            ?>
            <h4 id="titre">Selectionner un devoir</h4>
            <form method="post" action="devoirs.php">
                <?php
                foreach($devoirs as $devoir)
                {
                    $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["titre"] = $devoir["Titre"];
                    $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["info"] = $devoir["Info"];
                    $i++;
                }

                foreach ($listeDevoir as $x => $Devoirs)
                {
                    ?>
                    <div style="margin-left:10px;overflow-y: scroll;height:150px">
                        <?php
                        
                        foreach($Devoirs as $matieres => $Devoir)
                        {
                            ?>
                            <h4 ><?=$matieres;?></h4>
                            <ul > 
                            <?php
                            foreach($Devoir as $a)
                            {
                                ?>
                                
                                    <li>
                                        <h5 ><?=$a["titre"];?></h5>
                                        <p class="information"><?=$a["info"];?></p>
                                        <!-- <a href="" class="btn btn-warning">Modifier</a>
                                        <a href="" class="btn btn-danger">Supprimer</a> -->

                                    </li>
                                <?php
                            }
                            ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
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
require_once "footer.php";