<?php
require_once "../modeles/modeles.php";
if(!empty($_SESSION["idUtilisateur"])){
    if(!empty($_GET["cour"]))
    {
        $Cours = new Edt();
        $Cour = $Cours->selectCours($_GET["cour"]);
        
        $date = substr($Cour["date"], -2)."/".substr($Cour["date"], 5, 2)."/".substr($Cour["date"], 0,4)
        ?>


        <div class="card" style="width: 100%;">
            <div class="card-body w-50">
                <h3 class="card-title"><?= $Cour["matiere"] ?></h3>
                <h5 class="card-subtitle mb-2 "><?= substr($Cour["prenom"], 0,1) ?>.<?= $Cour["nom"] ?></h4>
                <h6 class="card-subtitle mb-2 text-muted"><?= $Cour["classe2"]." ".$Cour["classe"] ?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?= $date?></h6>
                <h6 class="card-subtitle mb-2 text-muted"><?= substr($Cour["horaireDebut"], 0, -6);?>h - <?= substr($Cour["horaireFin"], 0, -6);?>h</h6>
                <h6 class="card-subtitle mb-2 text-muted">Salle <?= $Cour["numero"]?></h6>
                <?php
                if(($_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration") && $_SESSION["idUtilisateur"] == $Cour["idUtilisateur"])
                {?>
                <form method=post id="resumeCour" action="../traitements/valideResume.php" onsubmit="AJAXSubmit(this);return false;">
                <textarea id="resumeCours" name="resume"><?=$Cour["resumeCours"];?>
                </textarea>
                <input type=hidden name="idCours" value="<?= $Cour['idCours']?>">
                <input type=submit value="+" onclick='addResume(this.id)'></form><?php
                }else{
                    ?><p><?=$Cour["resumeCours"];?></p><?php
                }
                ?>
            </div>
            <div>

            </div>
            <?php 
            if(($_SESSION["statut"] == "Professeur" && $_SESSION["idUtilisateur"] == $Cour["idUtilisateur"]))
            { 
                ?>
                <div class='edt-cour-btn-block'>
                    <form method=POST action='prof.php'>
                        <a class="btn btn-primary" id="<?=$Cour['idCours'];?>" onclick='addResume(this.id);' >Ajouter un résumé du cours</a>
                </div>
                <?php 
            }
                ?>
        </div>
        

        <?php
        if(($_SESSION["statut"] == "Professeur" && $_SESSION["idUtilisateur"] == $Cour["idUtilisateur"]) || $_SESSION["statut"] == "Administration")
        {
            ?>
            <hr>
            <div id="etd-cour-appel-block">
            
            <div id='appel-state' style="border-radius:50%;width:20px;height:20px;border:1px solid;background-color:
                <?php 
                if($Cour["appel"] == 0)
                {
                    echo 'darkred;'; 
                }
                else
                { 
                   echo 'chartreuse;'; 
                }
                ?>
                        ">
            </div>
            <h3 id='titre'>Fiche d'appel</h3>
            <?php
            if(!empty($Cour["idClasse"]))
            {
                ?>
                <!-- Liste des eleves concernant la classe selectionner -->
                <div>
                    <form method="post" action="../traitements/valideAppel.php" onsubmit="AJAXSubmit(this); return false;">
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
                                    $eleves = $objetEleve -> listeEleveClasse($Cour["idClasse"]);
                                    $objAbsence = new Absence();
                                    $ListeAbsents = $objAbsence->listeAbsents($_GET["cour"]);
                                    $objRetard = new Retard();
                                    $ListeRetards = $objRetard->listeRetards($_GET['cour']);
                                    $i = 0;
                                    foreach($eleves as $eleve)
                                    {   
                                        $inList = "";
                                        $retard = "";
                                        $absent = "";
                                        foreach($ListeAbsents as $Absent)
                                        {
                                            if($eleve["idUtilisateur"] == $Absent["idUtilisateur"])
                                            {
                                                $inList = $Absent;
                                                $absent = 1;
                                            }
                                        }
                                        foreach($ListeRetards as $Retard){
                                            if($eleve["idUtilisateur"] == $Retard["idUtilisateur"])
                                            {
                                                $inList = $Retard;
                                                $retard = 1;
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><?=$eleve["nom"];?> <?=$eleve["prenom"];?></td>
                                            <td>
                                                <select class="form-select" name="Classe[eleve][<?=$i;?>][presence]" onchange='modifAppel()' aria-label="Default select example">
                                                    <option disabled <?php if($Cour["appel"] == 0)
                                                                {
                                                                    echo 'selected'; 
                                                                }else{ 
                                                                    echo ''; 
                                                                }?>>..</option>
                                                    <option value="0" <?= empty($inList) ? 'selected': '' ?>>Présent</option>
                                                    <option value="1" <?= !empty($absent) ? 'selected': '' ?>>Absent</option>
                                                    <option value="2" <?= !empty($retard) ? 'selected': '' ?>>Retard</option>

                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="idCours" value="<?=$_GET['cour']?>"/>
                                                <input type="hidden" name="Classe[eleve][<?=$i;?>][idUtilisateur]" value="<?=$eleve["idUtilisateur"];?>">
                                                <input type="text" class="form-control" onchange='modifAppel()' placeholder="Saisir le temps de retard" <?= !empty($inList) ? 'value="'.$inList["justification"].'"': '' ?> name="Classe[eleve][<?=$i;?>][justification]">
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" name="Classe[eleve][<?=$i;?>][valideJustif]" onchange='modifAppel()' class="form-check-input" id="exampleCheck1" <?= !empty($inList["verifJustification"]) && $inList["verifJustification"] == 'oui' ? 'checked':'' ?>>
                                                    <label class="form-check-label" for="exampleCheck1" >Valider la justification</label>
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
                </div>
                <?php
            }
        }else
        {
            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
        }
    }
}else{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
