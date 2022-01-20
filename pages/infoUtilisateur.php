<?php
require_once "entete.php";
if(!empty($_GET))
{
    if(!empty($_GET["id"]))
    {
        if($_SESSION["idUtilisateur"] == $_GET["id"] || $_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
        {
        
            ////////////////////////// REQUETE SQL ////////////////////////////////////////

            $objet_eleve = new Eleves();
            $eleve = $objet_eleve-> affichageEleve($_GET["id"]);

            $objet_matiere = new Matieres();
            $matieres = $objet_matiere -> listeMatiere();
            
            $objet_classes = new Classes();
            $classes = $objet_classes -> allClasse();

            $objet_notes = new Notes();
            $notes = $objet_notes -> noteEleve($_GET["id"]);

            $objet_punitions = new Punition();
            $punitions = $objet_punitions -> punitionEleve($_GET["id"]);
            
            $listenote = [];
            $i = 0;
            
            ////////////////////// Organisation des Notes et affichage //////////////////////
            
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
            <!-- Affichage note -->
            <div class="row"> 
                <div class="col md-4">
                    <div class="card">
                        <div class="card-body">
                            
                            <h4 class="card-title"><?=$eleve["nom"]. " ".$eleve["prenom"];?></h4>
            
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?=$eleve["titre"]." ".$eleve["classe"];?>
                            </h6>
                            <div>
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
                                                                        
                                                                        <!-- <a href='../pages/supprNote' class='btn btn-danger btn-sm mb-2' style="float:right">Supprimer</a> -->
                                                                        <button onclick='modifierNote(this.value)' value='<?=$idNote?>' id="id<?=$idNote?>" class="btn btn-warning btn-sm mb-2" style='float:right' data-toggle="modal" data-target="#FormNote">Modifier</button>
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
                            </div>
                        </div>
                    </div> 
                </div>
            </div>       
                    
                    
            <!--/////////////////////// Affichage Rapport disciplinaire /////////////////////// -->
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
                                            <!-- <a href='../pages/supprNote' class='btn btn-danger btn-sm mb-2' style="float:right">Supprimer</a> -->

                                            <?php
                                            }
                        
                                            if($_SESSION["idUtilisateur"] == $punition["idUtilisateur"] || $_SESSION["statut"] == "Administration")
                                            {
                                            ?>
                                                <button onclick=modifierPunition(this.id) class='btn btn-warning btn-sm mb-2' id="<?=$punition["idPunition"]?>" style='float:right' data-toggle="modal" data-target="#FormPunition">Modifier</button>

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
                        </p>

            <div class="modal fade" id="FormClass" tabindex="-1" role="dialog" aria-labelledby="FormClassCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="FormClassCenterLongTitle">Formulaire : Modification de classe</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form method="post"  action="../traitements/modifClasse.php">
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
                                    <button type="submit" value="<?=$_GET["id"];?>" name="envoi" class="btn btn-success">Valider</button>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>

            <!-- --FORMULAIRE DE PUNITION-- -->
                            
            <!-- Modal -->
            <div class="modal fade" id="FormPunition" tabindex="-1" role="dialog" aria-labelledby="FormPunitionCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="FormPunitionLongTitle">Formulaire: Punition</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form method="post" action="../traitements/punition.php">
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
                                    <button type="submit" value="<?=$_GET["id"];?>" name="envoi" id='id' class="btn btn-success">Valider</button>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div> 
            
            <!-- -- FORMULAIRE MODIFICATION DE NOTE  -- -->

            <div class="modal fade" id="FormNote" tabindex="-1" role="dialog" aria-labelledby="FormNoteCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="FormNoteLongTitle">Formulaire: Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <form method="post"  name="modifNote" action="../traitements/verifNote.php">
                                <div class="form-group">
                                    
                                    <h5>Modification de la note</h5>

                                    <div class="form-group">
                                        <label for="designation">Nom</label>
                                        <input  class="form-control" name="designation" id="designation"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="noteMax">NoteMax</label>
                                        <input type="number" class="form-control" name="noteMax" id="noteMax" onchange="document.getElementById('note').max = this.value;"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <input type="number" min=0 max=20 class="form-control" name="note" id="note"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="commentaire">Commentaires</label>
                                        <input  class="form-control" name="commentaire" id="commentaire"/>
                                    </div>
                                        <input type="hidden" name="idEleve" value="<?=$_GET['id']?>">
                                    <button type="submit" value="" name="modif" id="modif" class="btn btn-success">Valider</button>
                                </div>
                            </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
            </div>
            <!-- -- FIN FORMULAIRE -- -->                      
                        
            <?php 
            if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration" || $_SESSION["statut"] == "Professeur")
            {
                ?>
                <div class="text-center">
                    <form style="width:100%;border:none; margin:0" method="post" action="../traitements/verifConversation.php">
                        <input type="hidden" name="idEnvoyeur" value="<?=$_SESSION["idUtilisateur"];?>">
                        <button class="btn btn-success" name="idReceveur" value="<?=$_GET["id"];?>">Envoyer un message</button>
                    </form>
                    <button onclick="formulairePunition()" class="btn btn-danger my-2" data-toggle="modal" data-target="#FormPunition">Ajouter un rapport disciplinaire</button>                       
                
                <?php
            }
            if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
            {
                ?>
                
                <button type="button" class="btn btn-warning my-2" data-toggle="modal" data-target="#FormClass">Modifier la classe</button>
                <?php
            }
            ?>              
            <?php
        }
        else
        {
            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
        }
    }


    else if($_SESSION["statut"] == "Administration")
    {
        if(!empty($_GET["idEnseignant"]))
        {
        
            $objetMatiere = new Matieres();
            $matieres = $objetMatiere -> listeMatiere();
        
            // $requete = getBdd() -> prepare("SELECT *  FROM enseignants  WHERE idUtilisateur = ? ");
            // $requete -> execute([$_GET["idEnseignant"]]);
            // $enseignant = $requete -> fetch(PDO::FETCH_ASSOC);
        
            $objetEnseignant = new Enseignant();
            $enseignant = $objetEnseignant -> infoEnseignant($_GET["idEnseignant"]);
        
            ?>
            <h3 id="titre">Information de l'enseignant</h3>
            <div class="row"> 
                <div class="col md-4">
                    <div class="card">
                        <div class="card-body">
            
                            <h5 class="card-title"><?=$enseignant["Nom"]. " ".$enseignant["Prenom"];?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Professeur de <?=$enseignant["matiere"];?></h6>
        
                            <!-- <div class="text-center">                        
                                <button onclick="afficherModif()" class="btn btn-warning my-2">Modifier</button>
                            </div> -->
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
    }else
    {
        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    }
}
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
    



require_once "footer.php";