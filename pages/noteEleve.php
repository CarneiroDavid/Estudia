<?php
require_once "entete.php";
if(!empty($_SESSION) && $_SESSION["statut"] == "Etudiant" ||$_SESSION["statut"] == "Enseignant" || $_SESSION["statut"] == "Administration")
{    
    //Déclaration objet
    $objetMatiere = new Matieres();
    $matieres = $objetMatiere -> listeMatiere();

    $objetNote = new Notes();
    $notes = $objetNote -> noteEleve( (($_SESSION["statut"] == "Etudiant") ? $_SESSION["idUtilisateur"] : $_GET["id"]) );
    // Tableau organisation des notes
    $listenote = [];

    // Variable nécessaire pour le calcul de moyennne
    $MoyenneMatiere = 0;
    $calculMoyenneMatiere = 0;
    $calculMoyenneGe = 0;
    $MoyenneGe = 0;
    $additionCoefMoy = 0;
    $additionMoy = 0;
    
    // Organisation des notes
    $i = 0;
    foreach($notes as $note)
    {
        $listenote[$note["matiere"]][$i]["idNote"] = $note["idNote"];
        $listenote[$note["matiere"]][$i]["notes"] = $note["Note"];
        $listenote[$note["matiere"]][$i]["designation"] = $note["designation"];
        $listenote[$note["matiere"]][$i]["moisNote"] = $note["moisNote"];
        $listenote[$note["matiere"]][$i]["jourNote"] = $note["jourNote"];        
        $listenote[$note["matiere"]][$i]["Coef"] = $note["Coef"];
        $listenote[$note["matiere"]][$i]["CoefMatiere"] = $note["CoefMatiere"];
        $listenote[$note["matiere"]][$i]["NoteMax"] = $note["NoteMax"];

        $i++;
    }
    ?>
    </br>
    <!-- <h3 class="text-center">Note de <?=(!empty($notes)) ? $notes[0]["nom"] . " " . $notes[0]["prenom"] : "";?> </h3> -->
    </br>
    <!-- DIV GLOBALE -->
    <div <?=(!empty($_POST["trimestre"]) && !empty($_POST["Note"]) || !empty($_POST["Note"])) ? "class='d-flex'" : "class='pageNote'";?>>
        <!-- DIV AFFICHAGE BANDEAU NOTES -->
        <div>
            <form id="formTrimestre" method="post" action = "../pages/noteEleve.php">
                <select onchange="submitTrimestre()" name="trimestre" class="form-select" aria-label="Default select example">
                    <option value="0">Choisissez un trimestre</option>
                    <option value="1" <?=(!empty($_POST["trimestre"]) && $_POST["trimestre"] == '1') ? "selected" : "";?>>Trimestre 1</option>
                    <option value="2" <?=(!empty($_POST["trimestre"]) && $_POST["trimestre"] == '2') ? 'selected' : "";?>>Trimestre 2</option>
                    <option value="3" <?=(!empty($_POST["trimestre"]) && $_POST["trimestre"] == '3') ? 'selected' : "";?>>Trimestre 3</option>
                </select>
            </form>
            <ul class="list-group">
                <form method="POST" action="noteEleve.php">
                    <?php
                    foreach($matieres as $matiere)
                    {
                        $additionCoef = 0;
                        $calculNote = 0;  
                        $test = 0;
                        ?>
                        <li class="list-group-item">
                            <h5><?=$matiere["matiere"];?></h5>
                            
                            <ul class="list-group list-group-flush">
                                <?php
                                if(!empty($listenote))
                                {
                                    foreach($listenote as $x => $note)
                                    {
                                        if($x == $matiere["matiere"])
                                        {
                                            foreach($note as $Note)
                                            {   
                                                //  AFFICHAGE DE TOUTES LES NOTES
                                                if(empty($_POST["trimestre"])) 
                                                {
                                                    // echo $Note["NoteMax"];
                                                    ?>
                                                    <button name="Note" type="submit" class="bouton-notes" value="<?=(!empty($_POST["Note"]) && $Note["idNote"] == $_POST["Note"]) ? "" : $Note["idNote"] ;?>"><li class="list-group-item"><?=$Note["designation"]." : ".$Note["notes"] . '/' . $Note["NoteMax"];?></li></button>
                                                    </br>
                                                    <?php
                                                    if(!empty($Note))
                                                    {
                                                        $additionCoef += $Note["Coef"] ;
                                                        $calculNote += $Note["notes"] * $Note["Coef"]; 
                                                        $MoyenneMatiere = round($calculNote / $additionCoef, 2);
                                                    }  
                                                    $test ++;
                                                }
                                                // AFFICHAGE DES NOTE EN FONCTION DU TRIMESTRE
                                                if(!empty($_POST["trimestre"]))
                                                {
                                                    if($_POST["trimestre"] == 1 && $Note["moisNote"] >= "7" && $Note["moisNote"] <= "12" && $Note["jourNote"] >= "1" && $Note["jourNote"] <= "31") 
                                                    {
                                                        ?>
                                                        <button  name="Note" class="bouton-notes" type="submit" value="<?=(!empty($_POST["Note"]) && $Note["idNote"] == $_POST["Note"]) ? "" : $Note["idNote"] ;?>" class="btn"><li class="list-group-item"><?=$Note["designation"]." : ".$Note["notes"] . '/' . $Note["NoteMax"];?></li></button>
                                                        <li class="list-group-item"><input name="trimestre" type="hidden" value="<?=$_POST["trimestre"];?>"></li>
                                                        <?php

                                                        if(!empty($Note))
                                                        {
                                                            $additionCoef += $Note["Coef"] ;
                                                            $calculNote += $Note["notes"] * $Note["Coef"]; 
                                                            $MoyenneMatiere = round($calculNote / $additionCoef, 2);

                                                        }   
                                                        $test ++;

                                                    }
                                                    
                                                    if($_POST["trimestre"] == 2 && $Note["moisNote"] >= "1" && $Note["moisNote"] <= "3" && $Note["jourNote"] >= "1" && $Note["jourNote"] <= "31") 
                                                    {
                                                        
                                                        ?>
                                                        <button  name="Note" class="bouton-notes" type="submit" value="<?=(!empty($_POST["Note"]) && $Note["idNote"] == $_POST["Note"]) ? "" : $Note["idNote"] ;?>" class="btn"><li class="list-group-item"><?=$Note["designation"]." : ".$Note["notes"] . '/' . $Note["NoteMax"];?></li></button>
                                                        <li class="list-group-item"><input name="trimestre" type="hidden" value="<?=$_POST["trimestre"];?>"></li>
                                                        <?php
                                                        
                                                        if(!empty($Note))
                                                        {
                                                            $additionCoef += $Note["Coef"] ;
                                                            $calculNote += $Note["notes"] * $Note["Coef"]; 
                                                            $MoyenneMatiere = round($calculNote / $additionCoef, 2);
                                                        } 
                                                        $test ++;

                                                    }  
                                                    if($_POST["trimestre"] == 3 && $Note["moisNote"] > "3" && $Note["moisNote"] <= "6" && $Note["jourNote"] >= "1" && $Note["jourNote"] <= "31") 
                                                    {
                                                        ?>
                                                        <button  name="Note" class="bouton-notes" type="submit" value="<?=(!empty($_POST["Note"]) && $Note["idNote"] == $_POST["Note"]) ? "" : $Note["idNote"] ;?>" class="btn"><li class="list-group-item"><?=$Note["designation"]." : ".$Note["notes"] . '/' . $Note["NoteMax"];?></li></button>
                                                        <li class="list-group-item"><input name="trimestre" type="hidden" value="<?=$_POST["trimestre"];?>"></li>
                                                        <?php                                                    
                                                        if(!empty($Note))
                                                        {
                                                            $additionCoef += $Note["Coef"] ;
                                                            $calculNote += $Note["notes"] * $Note["Coef"]; 
                                                            $MoyenneMatiere = round($calculNote / $additionCoef, 2);
                                                        } 
                                                        $test ++;

                                                    }
                                                    
                                                }    
                                                                                                                            
                                            } 
                                            
                                            $Moyenne = $MoyenneMatiere * $matiere["CoefMatiere"];
                                            $additionCoefMoy += $matiere["CoefMatiere"];
                                            $additionMoy += $Moyenne;
                                            $MoyenneGe = round($additionMoy / $additionCoefMoy, 2);
                                        }
                                        if($test > 0)
                                        {
                                            echo "<p>Moyenne de la matiere : " . $MoyenneMatiere . '/' . $Note["NoteMax"] . "</p>";
                                            ?>
                                                <li class="list-group-item"><p>Coefficient de la matière : <?=$Note["CoefMatiere"];?></p></li>   
                                            <?php
                                        }
                                        else
                                        {
                                            echo "Aucune notes n'a été saisit";
                                        }
                                    }
                                }
                                else
                                {
                                    echo "Aucune notes n'a été saisit";
                                }
                                ?>
                            </ul>
                        </li>
                        <?php 
                        
                    }
                    ?> 
                </form>
                <?php
                    if(!empty($Note))
                    {
                        ?>
                            <li class="list-group-item"><h5>Moyenne générale</h5> <p><?=$MoyenneGe . '/' . $Note["NoteMax"];?></p></li>   
                        <?php
                    }
                    else
                    {
                        ?>
                        <li class="list-group-item"><h5>Moyenne générale </h5> <p>Vous n'avez aucune notes d'enregistré</p></li>   
                        <?php
                    }
                ?>
            </ul>
        </div>
        <!-- DIV INFO NOTES -->
            <?php
                if(!empty($_POST["trimestre"]) && !empty($_POST["Note"]) || !empty($_POST["Note"]) )
                {
                    $objetNote = new Notes();
                    $info = $objetNote -> infoNote($_POST["Note"]);
                    ?>
                    <div class="card" id="div_info_note">
                        <div class="card-body">
                            <h4 class="text-center">Informations</h4>
                            <h5 class="card-title"><?=$info["designation"];?></h5>
                            <h5 class="card-title"><?=$info["Nom"] . " " . $info["Prenom"];?></h5>
                            <br>
                            <h6 class="card-subtitle mb-2 text-muted"><?=$info["matiere"];?></h6>
                            <br>
                            <p class="card-text">Note : <?=$info["Note"] . "/" . $info["NoteMax"];?></p>
                            <p class="card-text">Date de publication : <?=$info["dateNote"];?></p>
                            <p class="card-text">Coefficient de la note : <?=$info["Coef"];?></p>
                            <p class="card-text">Commentaire :</p>
                            <div id="div_commentaire"><?=$info["Commentaire"];?></div>
                            
                        </div>
                    </div>
                    
                    <?php
                }
            ?>
    </div>

   
        
    <?php
}
else
{
    header("location:index.php");
}
require_once "footer.php";