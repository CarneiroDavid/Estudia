<?php
require_once "entete.php";
if(!empty($_GET))
{
    if(!empty($_GET["id"]))
    {
        if($_SESSION["idUtilisateur"] == $_GET["id"] || $_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
        {
            
            if(isset($_GET["erreur"]))
            {   
                ?>
                <div class="alert alert-danger text-center">
                <?php
                
                switch($_GET["erreur"])
                {
                    case "modfiNote":
                        echo "La modification n'a pas été prise en comptre, veuillez réessayer.";
                        break;
                    case "ajoutPunition":
                        echo "Une erreur est survenue lors de l'ajout du rapport";
                        break;
                    case "Formvide":
                        echo "Aucun champ n'a été saisit, veuillez saisir des informations dans le formulaire";
                        break; 
                    case "statut":
                        echo "Une erreur est survenue.";
                        break;
                    case "leMotif":
                        echo "Le motif saisit doit faire entre 0 et 250 caractères.";
                        break;
                    case "leRapport":
                        echo "Le rapport saisit doit faire netre 0 et 600 caractères";
                        break;
                    case "modifPunition";
                        echo "La modification n'a pas pu être prise en compte.";
                        break;
                }
            
                ?>
                </div>
                <?php
            }
            if(isset($_GET["success"]))
            {   
                ?>
                <div class="alert alert-success text-center">
                <?php
                
                switch($_GET["success"])
                {
                    case "modifPunition":
                        echo "La modification du rapport à bien été prise en compte.";
                        break;
                    case "ajoutPunition":
                        echo "Le rapport à bien été ajouté.";
                        break;
                    case "modifNote":
                        echo "La modification de la note à bien été prise en compte.";
                        break;
                    case "Suppression":
                        echo "La suppression du rapport a bien été prise en compte";
                        break;
                }
            
                ?>
                </div>
                <?php
            }

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
                $listenote[$note["matiere"]][$i]["nom"] = $note["nom"];
                $listenote[$note["matiere"]][$i]["prenom"] = $note["prenom"];
                $listenote[$note["matiere"]][$i]["dateNote"] = $note["dateNote"];

                $i++;
            }
            ?>
            <!-- Affichage note -->
            <div class="row"> 
                <div class="col md-4">
                      
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
                                <ul class="list-group-item" >
                                    <h5><?=$matiere["matiere"];?></h5>
                                    
                                    <?php
                                    foreach($listenote as $x => $note)
                                    {
                                        if($x == $matiere["matiere"])
                                        {

                                            foreach($note as $Note)
                                            {   
                                                $date = explode("-",$Note["dateNote"]);
                                                $idNote = $Note["idNote"];
                                                
                                                ?>
                                                <li class="list">
                                                    <p><b>Nom de l'enseignant </b>: <?=$Note["nom"] . " " . $Note["prenom"];?></p> 

                                                    <b><span id="designation<?=$idNote?>"><?=$Note["designation"];?></span></b>
                                                    : 
                                                    <?php
                                                    if(is_null($Note["notes"]) == true)
                                                    {
                                                        ?>
                                                        <span id="note<?=$idNote?>">Absent <?=$idNote;?></span>
                                                        
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        
                                                        ?>
                                                        <span id="note<?=$idNote?>"><?=$Note["notes"];?></span>
                                                        /
                                                        <span id="noteMax<?=$Note["idNote"]?>"><?=$Note["noteMax"]?> </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    <button onclick='modifierNote(this.value)' value='<?=$idNote?>' id="id<?=$idNote?>" class="btn btn-warning btn-sm mb-2 infoUtilisateur-bouton-modifier-note" data-toggle="modal" data-target="#FormNote">Modifier</button>
                                                    <p><b>Date </b>: <?=$date[2] . "-" . $date[1] . "-" . $date[0];?></p> 

                                                    <?= !empty($Note["commentaire"]) ? "<b>Appréciation :</b><br><span id='commentaire".$idNote."'>".$Note["commentaire"] : "<span id='commentaire".$idNote."'></span>" ;?></span>
                                                    
                                                    <?php 
                                                    if($_SESSION["idUtilisateur"] == $Note["idProf"] || $_SESSION["statut"] == "Administration")
                                                    {
                                                        ?>
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
                        <ul class="list-group-item" >
                            <b>[<?=$punition["statut"]?>] <?= $punition["nom"]." ".$punition["prenom"]?></b><span >  <?=$date[2]."-".$date[1]."-".$date[0];?></span><span id="rapport<?=$punition["idPunition"];?>">
                        
                            
                            <li class="list">
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
                                    <form action="../traitements/supprimerRapport.php?id=<?=$_GET["id"];?>" method="POST">
                                        <input type="hidden" name="id" value="<?=$punition['idPunition'];?>"> 
                                        <button class="btn btn-danger btn-sm" value="1" name="Supprimer" style="float:right;">Supprimer</button>
                                    </form>
                                    
                                    <button onclick=modifierPunition(this.id) class='btn btn-warning btn-sm mb-2 infoUtilisateur-bouton-modifier-rapport' id="<?=$punition["idPunition"]?>" data-toggle="modal" data-target="#FormPunition">Modifier</button>
                                    

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

            <!-- --FORMULAIRE DE MODIFICATION DE CLASSE -- -->         
            <!-- Modal -->
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
                            <label for="punition">Sanction assignée :</label>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
                </div>
            </div>
            </div>          

            <!-- -- FORMULAIRE MODIFICATION DE NOTE  -- -->
            <!-- Modal -->
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
                                <label for="NoteMax">NoteMax</label>
                                <input type="number" placeholder="Veuillez préciser la note maximale de l'examen" class="form-control" name="NoteMax" id="noteMax" onchange="document.getElementById('note').max = this.value;"/>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
                    <form class="infoUtilisateur-form-bouton-ajouterRapport" method="post" action="../traitements/verifConversation.php">
                        <input type="hidden" name="idEnvoyeur" value="<?=$_SESSION["idUtilisateur"];?>">
                        <button class="btn btn-success" name="idReceveur" value="<?=$_GET["id"];?>">Envoyer un message</button>
                    </form>
                    <button onclick="formulairePunition()" class="btn btn-danger my-2" data-toggle="modal" data-target="#FormPunition">Ajouter un rapport disciplinaire</button>                       
                
                <?php
            }
            if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
            {
                ?>
                
                <!-- <button type="button" class="btn btn-warning my-2" data-toggle="modal" data-target="#FormClass">Modifier la classe</button> -->
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
    else if($_SESSION["statut"] == "Administration" || $_SESSION["statut"] == "Professeur")
    {
        // Profil de l'enseignant
        if((!empty($_GET["idEnseignant"]) && $_GET["idEnseignant"] == $_SESSION["idUtilisateur"]) || $_SESSION["statut"] == "Administration" )
        {
            if(isset($_GET["error"]))
            {
                ?>
                <div class="alert alert-danger text-center">
                <?php
                
                switch($_GET["error"])
                {
                    case "pbresume":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "donneeCoursFalse":
                        echo "Les données sélectionner sont fausses.";
                        break;
                    case "modif":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "pb":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "pbTitre":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "classeNonSelect":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "idClasseFaux":
                        echo "Cette classe n'existe pas.";
                        break;
                    case "classeNonselect":
                        echo "Aucune classe n'a été sélectionner.";
                        break;
                    case "pbDevoir":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "idDevoirFaux":
                        echo "Le devoir n'existe, veuillez réessayer.";
                        break;
                    case "pbIdProf":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "idProfFaux":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "pbInfoDevoir":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "titreDevoirLong":
                        echo "Le titre du devoir saisit est trop long.";
                        break;
                    case "infoDevoirLong":
                        echo "Veuillez saisir des informations moins longue";
                        break;
                    case "pbInfoDevoir":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "pbModif":
                        echo "Une erreur est survenue lors de la modif, veuillez réessayer.";
                        break;
                    case "pbresume":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "donneeCoursFalse":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                    case "modifResume":
                        echo "Une erreur est survenue, veuillez réessayer.";
                        break;
                }


                ?>
                </div>
                <?php
            }
            if(isset($_GET["success"]))
            {
                ?>
                <div class="alert alert-success text-center">
                <?php
                
                switch($_GET["success"])
                {
                    case "modifResume":
                        echo "Le résumé a bien été modifié.";
                        break;
                    case "modifDevoir":
                        echo "Le devoir a bien été modifié.";
                        break;
                }


                ?>
                </div>
                <?php
            }

            $objetMatiere = new Matieres();
            $matieres = $objetMatiere -> listeMatiere();
        
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
                            <?php
                            if($_SESSION["statut"] == "Administration")
                            {
                                ?>
                                <form method="POST" action="../traitements/modifMatiere.php">
                                    <label for="matiere">matière</label>
                                    <select class="form-control" name="matiere">
                                        <?php
                                        foreach($matieres as $matiere)
                                        {
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
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="div_infoProf">
                <div class="card col-12 col-md-4 col-lg-4 text-center">
                    <div class="card-body">
                        <p>Informations sur les cours données </p>
                        <form method="post" action="infoUtilisateur.php?idEnseignant=<?=$_GET["idEnseignant"];?>">
                            <button name="Cours" value="<?=$_GET["idEnseignant"];?>" class="btn">Visualiser</button>
                        </form>  
                    </div>
                </div>
                <div class="card col-12 col-md-4 col-lg-4 text-center">
                    <div class="card-body">
                        <p>Informations sur les examens données</p>
                        <form method="post" action="infoUtilisateur.php?idEnseignant=<?=$_GET["idEnseignant"];?>">
                            <button name="Examens" value="<?=$_GET["idEnseignant"];?>" class="btn">Visualiser</button>
                        </form>                  
                    </div>
                </div>
                <div class="card col-12 col-md-4 col-lg-4 text-center">
                    <div class="card-body">
                        <p>Informations sur les devoirs données</p>
                        <form method="post" action="infoUtilisateur.php?idEnseignant=<?=$_GET["idEnseignant"];?>">
                            <button name="devoirs" value="<?=$_GET["idEnseignant"];?>" class="btn">Visualiser</button>
                        </form>                     
                    </div>
                </div>
            </div>
            <?php
            if((!empty($_POST["Cours"]) && $_POST["Cours"] == $_GET["idEnseignant"]) || $_GET["idEnseignant"] == $_SESSION["idUtilisateur"] || $_SESSION["statut"] == 'Administration')
            {
                if(!empty($_POST["Cours"]))
                {
                    $objetEdt = new Edt();
                    $infos = $objetEdt -> infoCours($_POST["Cours"]);
                    ?>
                    <div class="div_infoProf">
                        <?php
                        foreach($infos as $info)
                        {
                            ?>
                                <div class="card col-12 col-md-6 col-lg-4 text-center">
                                    <div class="card-body">
                                        <h5 class="card-title"> Cours : <?=$info["matiere"];?></h5>
                                        <h6 class="card-subtitle mb-2 "><?=$info["Nom"];?> <?=$info["Prenom"];?></h6>
                                        <h6 class="card-subtitle mb-2 "><?=$info["nom"];?> <?=$info["classe"];?></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Du <?=$info["date"];?></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">De <?=$info["horaireDebut"];?> à <?=$info["horaireFin"];?></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Salle n°<?=$info["numero"];?></h6>
                                        <?php
                                        if(!empty($_POST["modifResume"]) && $_POST["modifResume"] == $info["idCours"])
                                        {
                                            ?>  
                                                <form method="POST" action="../traitements/modifResume.php">
                                                    <input type="hidden" class='form-control' name="idCours" value="<?=$info["idCours"];?>">
                                                    <input type="hidden" class='form-control' name="idProf" value="<?=$_GET["idEnseignant"];?>">
                                                    <textarea type="text" class='form-control' name="resumeCours" value="<?=$info["resumeCours"];?>"></textarea>
                                                    <button class="btn">Valider</button>
                                                </form>
                                                
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <p class="card-text">Résumé du cours : </br>
                                                    <?=(empty($info["resumeCours"])) ? "Aucun résumé n'a été ajouté" : $info["resumeCours"] ;?>
                                                </p>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if(empty($_POST["modifResume"]))
                                        {
                                            ?>
                                            <form method="POST" action="infoUtilisateur.php?idEnseignant=<?=$_POST["Cours"];?>" >
                                                <input type="hidden" name="Cours" value="<?=$_GET["idEnseignant"];?>">
                                                <button name="modifResume" value="<?=$info["idCours"];?>" class="btn">Modifier le résumé</button>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php

                        }
                        ?>
                    </div>
                    <?php
                    
                }
            }
            if((!empty($_POST["Examens"]) && $_POST["Examens"] == $_GET["idEnseignant"]) || $_GET["idEnseignant"] == $_SESSION["idUtilisateur"] || $_SESSION["statut"] == 'Administration')
            {
                if(!empty($_POST["Examens"]))
                {
                    $objetEdt = new Examen();
                    $infos = $objetEdt -> examProf($_POST["Examens"]);
                    ?>
                    <div class="div_infoProf">
                        <?php

                        foreach($infos as $info)
                        {
                            ?>
                                <?=(!empty($_POST["voirNote"])) ? "<div class='card col-12 col-lg-4 text-center'>" : "<div class='card col-12 col-md-6 col-lg-4 text-center'>" ;?>
                                    <div class="card-body">
                                        <h5 class="card-title"> Nom de l'examen : <?=$info["nom"];?></h5>
                                        <h6 class="card-subtitle mb-2 "><?=$info["Nom"];?> <?=$info["Prenom"];?></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Matière : <?=$info["matiere"];?></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Classe : <?=$info["nomClasse"] . " " . $info["classe"];?></h6>
                                        <br>
                                        <h6>Notes des élèves</h6>
                                        <?php
                                        // if(empty($_POST["voirNote"]))
                                        // {
                                            ?>
                                            <form method="POST" action="infoUtilisateur.php?idEnseignant=<?=$_POST["Examens"];?>" >
                                                <input type="hidden" name="Examens" value="<?=$_GET["idEnseignant"];?>">
                                                <button name="voirNote" value="<?=$info["idExamen"];?>" class="btn">Voir les notes</button>
                                            </form>
                                            <?php
                                        // }
                                        if(!empty($_POST["voirNote"])&& $_POST["voirNote"] == $info["idExamen"])
                                        {
                                            $objetNote = new Notes();
                                            $notes = $objetNote -> NoteClasse($_POST["Examens"], $_POST["voirNote"]);
                                    
                                            foreach($notes as $note)
                                            {
                                                ?>
                                                <ul class="list-group">
                                                    <li class="list-group-item"><?=$note["nom"] . " " . $note["prenom"];?> <span class="noteDeEleve"><?=$note["Note"]."/" . $note["NoteMax"]?></span></li>
                                                </ul>
                                                <?php
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                            <?php

                        }
                        ?>
                    </div>
                    <?php
                }
            }
            if((!empty($_POST["devoirs"])  && $_POST["devoirs"] == $_GET["idEnseignant"]) || $_GET["idEnseignant"] == $_SESSION["idUtilisateur"] || $_SESSION["statut"] == 'Administration')
            {
                if(!empty($_POST["devoirs"]))
                {
                    $objetEdt = new Devoir();
                    $infos = $objetEdt -> allDevoirDuProf($_POST["devoirs"]);

                    $objet_classes = new Classes();
                    $classes = $objet_classes -> allClasse();
                    
                    ?>
                    <div class="div_infoProf">
                        <?php

                        foreach($infos as $info)
                        {
                            ?>
                                <div class='card col-12 col-lg-4 text-center'>
                                    <div class="card-body">
                                        <?php
                                        if(!empty($_POST["modifDevoir"]) && $_POST["modifDevoir"] == $info["idDevoir"])
                                        {
                                            ?>  
                                                <form method="POST" action="../traitements/modifDevoir.php">
                                                    <label>Nom du devoir</label> 
                                                    <input type="text" class='form-control' value="<?=$_POST["nomDevoir"];?>" name="titreDevoir"?>

                                                    <label>Classes</label>
                                                    <select name="idClasse" class='form-control' >
                                                        <?php
                                                        foreach($classes as $classe)
                                                        {
                                                            ?>

                                                            <option value="<?=$classe["idEtude"];?>"><?=$classe["nom"] . " " . $classe["classe"];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                            <?php
                                        }else
                                        {
                                            ?>
                                            <h5 class="card-title"> Devoir : <?=$info["Titre"];?></h5>
                                            <h6 class="card-subtitle mb-2 "><?=$info["Nom"];?> <?=$info["Prenom"];?></h6>
                                            <h6 class="card-subtitle mb-2 "><?=$info["nom"];?> <?=$info["classe"];?></h6>
                                            <h6 class="card-subtitle mb-2 text-muted">Du <?=$info["laDate"];?></h6>
                                            <?php
                                        }
                                        if(!empty($_POST["modifDevoir"]) && $_POST["modifDevoir"] == $info["idDevoir"])
                                        {
                                            ?>  
                                                    <input type="hidden" class='form-control' name="idDevoir" value="<?=$info["idDevoir"];?>">
                                                    <input type="hidden" class='form-control' name="idProf" value="<?=$_GET["idEnseignant"];?>">
                                                    <label>Informations du devoir</label>
                                                    <textarea type="text" class='form-control' name="infoDevoir"><?=$_POST["infoDevoir"];?></textarea>
                                                    <button class="btn" name="modifDevoir" value="1">Valider</button>
                                                </form>
                                                
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <p class="card-text">Informations : </br>
                                                    <?=(empty($info["Info"])) ? "Aucun résumé n'a été ajouté" : $info["Info"] ;?>
                                                </p>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if(empty($_POST["modifDevoir"]))
                                        {
                                            
                                            ?>
                                            <form method="POST" action="infoUtilisateur.php?idEnseignant=<?=$_POST["devoirs"];?>" >
                                                <input type="hidden" name="nomDevoir" value="<?=$info["Titre"];?>">
                                                <input type="hidden" name="infoDevoir" value="<?=$info["Info"];?>">
                                                <input type="hidden" name="devoirs" value="<?=$_GET["idEnseignant"];?>">
                                                <button name="modifDevoir" value="<?=$info["idDevoir"];?>" class="btn">Modifier le devoir</button>
                                            </form>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                    
                                
                            <?php

                        }
                        ?>
                    </div>
                    <?php
                }
            }
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