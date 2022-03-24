<?php 
require_once "entete.php";

$objetUser = new User();
$ip = $objetUser -> recupIpAutorise($_SERVER["REMOTE_ADDR"]);
if($_SESSION["statut"] == "Administration" || $_SESSION["statut"] == "Professeur" /*$_SERVER["REMOTE_ADDR"] == $ip["ip"]*/)
{
    $objetClasse = new Classes();
    $classes = $objetClasse -> allClasse();
    ?>
    
    <h3 class="text-center">Informations des élèves</h3>
    </br>
    <!-- Select Des classe -->
    <form method="post">
        <div class="form-group">
            <label>Choisissez une classe</label>
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
            </br>
            <button type="submit" value="1" name="envoi" class="btn">Valider</button>
        </div>
    </form>

    <br>
    <?php
    /* Affichage des eleves a partir de la classe */
        if(!empty($_POST["classe"]))
        {
            $objetClasse = new Classes($_POST["classe"]);
            $eleves = $objetClasse -> getEleve();
            
            ?>
            <ul class="list-group">
                <?php
                for($i = 0 ; $i < count($eleves) ; $i++)
                {
                    ?>
                    <li class="list-group-item"><?=$eleves[$i] -> getNom(). " ". $eleves[$i] -> getPrenom();?>
                        <span class="infoUtilisateur-bouton-info">
                        <a class="btn btn-sm" href="infoUtilisateur.php?id=<?=$eleves[$i] -> getIdUtilisateur();?>">Info</a>
                        <!-- <a class="btn btn-danger btn-sm" href="modifClasse.php?suppr=<?=$eleve["idUtilisateur"]?>">Supprimer</a> -->
                        </span>
                    </li>   
                    <?php
                    // echo $eleves[$i] -> getNom();echo"<br>";
                }
                foreach($eleves as $eleve)
                {   
                   
                }
                ?>
            </ul
            ><?php
        }
    ?>
            
    <?php
    
}
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}

require_once "footer.php";