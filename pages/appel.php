<?php
require_once "entete.php";
$objetEleve = new Eleves();
$eleves = $objetEleve -> listeEleves();

$objetClasse = new Classes();
$classes = $objetClasse -> allClasse();

?>
<h3 id="titre">Fiche d'appel</h3>
<?php
if($_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
{
    if(empty($_POST["envoie"]) && empty($_POST["classe"]))
    {
        ?>
        <!-- SELECT des classe disponible -->
        <div class="container">
            <form action="appel.php" method="post">
                <select class="form-select" name="classe" aria-label="Default select example">
                    <?php
                    foreach($classes as $classe)
                    {
                        ?>
                            <option value="<?=$classe["idEtude"];?>"><?=$classe["nom"];?> <?=$classe["classe"];?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
                <button type="submit" name="envoie" value="1" class="btn btn-secondary">Valider</button>
            </form>
        </div>
        <?php
    }
    if(!empty($_POST["classe"]) && !empty($_POST["envoie"]))
    {
        ?>
        <!-- Liste des eleves concernant la classe selectionner -->
        <h4><?=$_POST["classe"];?></h4>
        <div>
            <form method="post" action="../traitements/valideAppel.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Absence</th>
                            <th scope="col">Justification</th>
                            <th scope="col">Valide justification</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $objetEleve = new Eleves();
                            $eleves = $objetEleve -> listeEleveClasse($_POST["classe"]);

                            $i = 0;
                            foreach($eleves as $eleve)
                            {
                                ?>
                                <tr>
                                    <td><?=$eleve["nom"];?> <?=$eleve["prenom"];?></td>
                                    <td>
                                        <select class="form-select" name="Classe[eleve][<?=$i;?>][presence]" aria-label="Default select example">
                                            <option value="0">Présent</option>
                                            <option value="1">Absent</option>
                                            <option value="2">Retard</option>

                                        </select>
                                    </td>
                                    <td>
                                        <input type="hidden" name="idCours" value="3">
                                        <input type="hidden" name="Classe[eleve][<?=$i;?>][idUtilisateur]" value="<?=$eleve["idUtilisateur"];?>">
                                        <input type="hidden" name="Classe[eleve][<?=$i;?>][idEtude]" value="<?=$_POST["classe"];?>">
                                        <input type="hidden" name="Classe[eleve][<?=$i;?>][idProf]" value="<?=$_SESSION["idUtilisateur"];?>">
                                        <input type="text" class="form-control" placeholder="Saisir le temps de retard" name="Classe[eleve][<?=$i;?>][justification]">
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" name="Classe[eleve][<?=$i;?>][valideJustif]" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Valider la justification</label>
                                        </div>
                                    </td>
                                </tr>       
                                <?php
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
                <div>
                    <button type="submit" value="1" name="valideAppel" class ="btn btn-success">Valider l'appel</button>
                </div>
            </form>
            
            <div>

            </div>
        </div>
        <?php
    }
}else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
require_once "footer.php";