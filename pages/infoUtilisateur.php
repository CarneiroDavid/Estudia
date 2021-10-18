<?php
require_once "entete.php";
if(!empty($_GET["id"]))
{
    if($_SESSION["idUtilisateur"] == $_GET["id"] || $_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
    {
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////                                          REQUETE SQL                                                 /////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $requete = getBdd() -> prepare("SELECT eleve.nom AS nom, etudes.nom AS titre, etudes.classe, prenom, idUtilisateur FROM eleve LEFT JOIN etudes USING(idEtude) WHERE idUtilisateur = ?");
    $requete -> execute([$_GET["id"]]);
    $eleve = $requete -> fetch(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT matiere,idMatiere FROM matieres");
    $requete -> execute();
    $matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    $requete = getBdd() -> prepare("SELECT * FROM etudes");
    $requete -> execute();
    $classes = $requete->fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT Note, idUtilisateur,idProf,idNote,NoteMax, matieres.matiere, designation, commentaire FROM notes INNER JOIN matieres USING(idMatiere) WHERE idUtilisateur = ?");
    $requete -> execute([$_GET["id"]]);
    $notes = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT motif,punition,ladate,idPunition,nom,prenom,statut,punition.idUtilisateur FROM punition INNER JOIN utilisateur USING(idUtilisateur) WHERE idEleve = ?");
    $requete -> execute([$_GET["id"]]);
    $punitions = $requete -> fetchAll(PDO::FETCH_ASSOC);
    ?>
        <pre>
            <!-- <?= print_r($_SESSION);?> : <?= print_r($notes);?>  -->
        </pre>
    <?php
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $listenote = [];
    $i = 0;
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////                                  Organisation des Notes et affichage                                  ////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    foreach($notes as $note)
    {
        $listenote[$note["matiere"]][$i]["notes"] = $note["Note"];
        $listenote[$note["matiere"]][$i]["designation"] = $note["designation"];
        $listenote[$note["matiere"]][$i]["idProf"] = $note["idProf"];
        $listenote[$note["matiere"]][$i]["idNote"] = $note["idNote"];
        $listenote[$note["matiere"]][$i]["noteMax"] = $note["NoteMax"];
        $listenote[$note["matiere"]][$i]["commentaire"] = $note["commentaire"];
        $i++;
    }
    ?>
    <div class="row"> 
        <div class="col md-4">
            <div class="card">
                <div class="card-body">
                    
                    <h4 class="card-title"><?=$eleve["nom"]. " ".$eleve["prenom"];?></h4>
    
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?=$eleve["titre"]." ".$eleve["classe"];?>
                    </h6>
                    <p>
                        <h5>Notes de l'élève :</h5>
                        <ul>
                            <?php
                                foreach($matieres as $matiere)
                                {
                                    ?>
                                    <ul class="list-group-item" style="padding-left:5%">
                                        <h5><?=$matiere["matiere"];?></h5>
                                        
                                    <?php
                                    foreach($listenote as $x => $note)
                                    {
                                        if($x == $matiere["matiere"])
                                        {

                                            foreach($note as $Note)
                                            {   
                                                $idNote = $Note["idNote"];      
                                                
                                                ?>
                                                
                                                <li>
                                                    <b><span id="designation<?=$idNote?>"><?=$Note["designation"];?></span></b>
                                                    : <span id="note<?=$idNote?>"><?=$Note["notes"];?></span>/<span id="noteMax<?=$Note["idNote"]?>"><?=$Note["noteMax"]?></span>
                                                    <br>

                                                    <?= !empty($Note["commentaire"]) ? "<b>Appréciation :</b><br><span id='commentaire".$idNote."'>".$Note["commentaire"] : "<span id='commentaire".$idNote."'></span>" ;?></span>
                                                    
                                                    <?php 
                                                        if($_SESSION["idUtilisateur"] == $Note["idProf"] || $_SESSION["statut"] == "Administration")
                                                        {
                                                            ?>
                                                            
                                                            <a href='../pages/supprNote' class='btn btn-danger btn-sm mb-2' style="float:right">Supprimer</a>
                                                            <button onclick='modifierNote(this.value)' value='<?=$idNote?>' id="id<?=$idNote?>" class="btn btn-warning btn-sm mb-2" style='float:right'>Modifier</button>
                                                            <input type=hidden id="matiere<?=$idNote?>" value="<?=$matiere['matiere']?>">
                                                            <?php
                                                        }
                                                    ?>
                                                    
                                                            
                                                </li>
                                                
                                                <br>
                                                
                                            <?php
                                            }
                                        }
                                    }
                                            ?>
                                    </ul>
                                    <?php
                                }
                            ?>
                        </ul> 
                    </p>
        <!--
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////                                    Affichage Rapport disciplinaire                                    /////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    -->
                    <p> 
                        <h5>Rapport disciplinaire :</h5>
                        <ul>
                            <?php
                            foreach($punitions as $punition)
                            {
                                $date = explode("-",$punition["ladate"]);
                                
                                ?>
                                <input type=hidden value="<?=$punition["ladate"];?>" id="date<?=$punition["idPunition"];?>">
                                <ul class="list-group-item" style="padding-left:5%">
                                    <b>[<?=$punition["statut"]?>] <?= $punition["nom"]." ".$punition["prenom"]?></b><span >  <?=$date[2]."-".$date[1]."-".$date[0];?></span><span id="rapport<?=$punition["idPunition"];?>">
                                
                                    
                                    <li>
                                        <?php 
                                        if($_SESSION["statut"] == "Administration")
                                        {
                                        ?>
                                        <a href='../pages/supprNote' class='btn btn-danger btn-sm mb-2' style="float:right">Supprimer</a>

                                        <?php
                                        }
                    
                                        if($_SESSION["idUtilisateur"] == $punition["idUtilisateur"] || $_SESSION["statut"] == "Administration")
                                        {
                                        ?>
                                            <button onclick=modifierPunition(this.id) class='btn btn-warning btn-sm mb-2' id="<?=$punition["idPunition"]?>" style='float:right'>Modifier</button>

                                        <?php
                                        }
                                        ?>

                                        <b>Motif : </b>
                                        <span id="motif<?=$punition["idPunition"];?>"><?=$punition["motif"];?> </span> 

                                        <br> <br>

                                        <b>Sanction : </b>
                                        <span id="punition<?=$punition["idPunition"];?>"><?=$punition["punition"]?></span>
                                        <input type="hidden" value=""> 
                                    </li>
                                    
                                </ul>
                                <?php
                            }
                            ?>
                        </ul>
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------FORMULAIRE DE MODIFICATION DE CLASSE------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    <form method="post" id="ModifierClasse" style="display:none;" action="../traitements/modifClasse.php">
                        <div class="form-group">
                            <label for="classe">Modifier la Classe</label>
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
                            <button type="submit" value="<?=$_GET["id"];?>" name="envoi" class="btn">Valider</button>
                        </div>
                    </form>

        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- --------------------------------------------------FORMULAIRE DE PUNITION----------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                   
                    <form method="post" id="formPunition" style="display:none;" action="../traitements/punition.php">
                        <div class="form-group">
                            <h5>Formulaire de Punition</h5>
                            <label for="motif">Motif de la punition :</label>
                            <br>
                            <textarea class="form-control" name="motif" id="motif" placeholder='motif de la punition'></textarea>
                            <br>
                            <br>
                            <label for="punition">Sanction assigner :</label>
                            <br>
                            <textarea class="form-control" placeholder='Punition assigner' id="punition" name="punition" ></textarea>
                            <br>
                            <br>
                            <label>Date de l'incident</label>
                            <br>
                            <input class="form-control" type='date' name="date" id="date">
                            <br>
                            <br>


                            <input type="hidden" name="idEleve" id="idEleve" value="<?=$_GET["id"]?>">
                            <button type="submit" value="<?=$_GET["id"];?>" name="envoi" id='id' class="btn">Valider</button>
                        </div>
                    </form>
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- ---------------------------------------    FORMULAIRE MODIFICATION DE NOTE  ---------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->


        <form method="post" id="modifNote" style="display:none;" name="modifNote" action="../traitements/verifNote.php">
            <div class="form-group">
                <label for="matiere">Matiere</label>
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
                    <label for="designation">Nom</label>
                    <input type="note" class="form-control" name="designation" id="designation"/>
                </div>
                <div class="form-group">
                    <label for="noteMax">NoteMax</label>
                    <input type="note" class="form-control" name="noteMax" id="noteMax" onchange="document.getElementById('note').max = this.value;"/>
                </div>
                <div class="form-group">
                    <label for="note">Note</label>
                    <input type="number" min=0 max=20 class="form-control" name="note" id="note"/>
                </div>

                <div class="form-group">
                    <label for="commentaire">Commentaires</label>
                    <input type="note" class="form-control" name="commentaire" id="commentaire"/>
                </div>
                    <input type="hidden" name="idEleve" value="<?=$_GET['id']?>">
                <button type="submit" value="" name="modif" id="modif" class="btn">Valider</button>
            </div>

        </form>


        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <!-- ---------------------------------------    FIN FORMULAIRE ---------------------------------------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                      
                    
                    <?php 
                    if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration" OR !empty($_SESSION["statut"]) && $_SESSION["statut"] == "Professeur")
                    {
                        ?>
                        <div class="text-center">
                        <a href="supprimerProduit.php?id=<?=$_GET["id"]?>" class="btn btn-success my-2">Envoyer un message</a>
                        <button onclick="formulairePunition()" class="btn btn-danger my-2">Ajouter un rapport disciplinaire</button>
                        
                        <?php
                    }
                    if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
                    {
                        ?>
                        <button onclick="afficherModif()" class="btn btn-warning my-2">Modifier la classe</button>
                        <a href="supprimerProduit.php?id=<?=$_GET["id"]?>" class="btn btn-danger my-2">Supprimer l'élève de la classe</a>
                        <?php
                    }
                    ?>              
                        
    
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    else
    {
        header("location:index.php");
    }
}else
{
    header("location:index.php");
}

if(!empty($_GET["idEnseignant"]))
{

    
    $requete = getBdd() -> prepare("SELECT matiere FROM matieres");
    $requete -> execute();
    $matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT *  FROM enseignants  WHERE idUtilisateur = ? ");
    $requete -> execute([$_GET["idEnseignant"]]);
    $enseignant = $requete -> fetch(PDO::FETCH_ASSOC);

    ?>

    <div class="row"> 
        <div class="col md-4">
            <div class="card">
                <div class="card-body">
    
                    <h5 class="card-title"><?=$enseignant["Nom"]. " ".$enseignant["Prenom"];?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Professeur de <?=$enseignant["matiere"];?></h6>

                    <div class="text-center">                        
                        <button onclick="afficherModif()" class="btn btn-warning my-2">Modifier</button>
    
                        <a href="supprimerProduit.php?id=<?=$_GET["idEnseignant"]?>" class="btn btn-danger my-2">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="POST" action="../traitements/modifMatiere.php" style="display:none;" id="ModifierClasse">
                <label for="matiere">matière</label>
                    <select name="matiere">
                    <?php
                    foreach($matieres as $matiere){
                        
                        ?>
                        <option value="<?=$matiere["matiere"];?>" <?= $matiere["matiere"] == $enseignant["matiere"] ? "selected" : "";?>>
                        
                        
                        <?= $matiere["matiere"];?>
                    
                    
                        </option>
                        <?php

                    }

                    ?>
                    </select>
                    <button type="submit" value="<?=$_GET["idEnseignant"];?>" name="envoi" class="btn">Valider</button>
    </form>



    <?php
}
require_once "footer.php";