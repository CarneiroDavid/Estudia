<?php
require_once "entete.php";
require_once "../modeles/modeles.php";


function affichageDevoir($idEtude, $date)
{
    $objetDevoir = new Devoir();
    $devoirs = $objetDevoir -> listeDevoir($idEtude,$date);

    $listeDevoir = [];
    $i = 0;

    ?>
    <div class="enteteAccueil">
    <form method='post' id="devoir" style="width:100%">
            <button type="submit" value="<?= isset($_POST['JourDevoir']) ? $_POST['JourDevoir']-1 : -1 ;?>" name='JourDevoir' class="boutonGauche">

            <

            </button>

            <button type="submit" value="<?= isset($_POST['JourDevoir']) ? $_POST['JourDevoir']+1 : 2 ?>" name='JourDevoir' class="boutonDroite">

            >

            </button>
            <?php 
            if(!empty($_POST['Jour'])){
                echo '<input type=hidden name="Jour" value="',$_POST['Jour'],'">';
            } ;
            ?>
            <h5 >Devoir : <?=$date;?></h5>
        </form>
    </div>
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
        <div class="div_list_devoir">
            <?php
            foreach($Devoirs as $matieres => $Devoir)
            {
                ?><ul class="list-group">
                <h5 ><?=$matieres;?></h5>
                 
                <?php
                foreach($Devoir as $a)
                {
                    ?>
                    
                    <li class="list-group-item">
                        <h5 ><?=$a["titre"];?></h5>
                        <p class="information"><?=$a["info"];?></p>
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
    
}



function affichageEDT($idEtude,$date,$statut='Etudiant',$firstWeek = 0)
{
    
    
    $objetEdt = new Edt();
    if($statut === 'Etudiant')
    {
       $edt = $objetEdt -> selectEDT($idEtude,$date);
    }else if ( $statut === 'Professeur')
    {
        $edt = $objetEdt -> selectEDT_Prof($_SESSION["idUtilisateur"],$date);
    }
        
        
        if($edt == null){

        }else{
            $derniereHeure = count($edt);
            ?>
            <div id="jour" class='jour'>
                <?php
                    $horaireSave = 0;
                    $first=0;
                    foreach($edt as $key => $jour)
                    {   
                        $horaireDebut = (int)substr($jour["horaireDebut"], 0, -6);
                        $horaireFin = (int)substr($jour["horaireFin"], 0, -6);
                        
                        if($first == 0)
                        {
                            for($i = 8; $i<$horaireDebut;$i++)
                            {
                                ?>
                                <div id="<?=$i;?>h"  class="w-60 h-10">
                                    <span class="etu-edt-heure-span"><?=$i;?>h</span>
                                </div>
                                <?php
                            }
                        }
                        $valeurTest = $horaireDebut - $horaireSave;
                        if($valeurTest != 0 && $first > 0)
                        {
                            ?>
                            <div id="<?=$horaireSave;?>h/<?=$horaireDebut;?>h" class="<?= $valeurTest == 1 ? 'heure1':'heure2';?>">
                                <span id="midi" class="etu-edt-heure-span"><?=$horaireSave;?>h</span>
                                <div class='cours break <?= $valeurTest > 1 ? 'p-top-10':'';?>' style="">
                                    <span>Permanence</span>
                                    <br>
                                    <span> / / </span>
                                </div>
                            </div>
                            <?php
                        }

                            ?>
                            <div id="<?= $jour["horaireDebut"]?>" class='<?=$horaireFin - $horaireDebut == 1 ? 'heure1':'heure2';?>' data-toggle="modal" data-target="#CourDetail">

                        
                        
                            <span class="etu-edt-heure-span" id="<?= $jour["horaireDebut"]?>"><?=$horaireDebut?>h</span>

                            <div id='<?= $jour['idCours']?>'
                            class="cours <?= $horaireFin - $horaireDebut > 1 ? 'p-top-10 ':'';?><?php 
                                    if($jour["matiere"] == 'Français')
                                    {
                                        echo 'francais';
                                    }
                                    else if($jour["matiere"] == 'Mathématique')
                                    {
                                        echo 'math';
                                    }
                                    else if($jour["matiere"] == 'Anglais')
                                    {
                                        echo 'anglais';
                                    }
                                    else if($jour["matiere"] == 'Histoire')
                                    {
                                        echo 'histoire';
                                    }
                                    else if($jour["matiere"] == 'Physique-Chimie')
                                    {
                                        echo 'ph-ch';
                                    }
                                    else if($jour["matiere"] == 'Science')
                                    {
                                        echo 'science';
                                    }
                                    else if($jour["matiere"] == 'Espagnol')
                                    {
                                        echo 'espagnol';
                                    }
                                
                                ?>"
                                onclick='CoursDetail(this.id)'>

                                <span class="d-block"><?= $jour["matiere"];?></span>
                                
                                <span class="d-block mb-0"><?= substr($jour["prenom"], 0, 1); ?>.<?= $jour["nom"]?></span>

                                <span class="d-block  mt-0">Salle <?= $jour["numero"];?></span>
                            </div>
                            
                        </div>
                        
                        <?php
                        if($key == $derniereHeure-1){
                            for($i = $horaireFin; $i<=18;$i++)
                            {
                                ?>
                                <div id="<?=$i;?>h"  class="w-60 h-10">
                                    <span class="etu-edt-heure-span" style='top:-21px;'><?=$i;?>h</span>
                                </div>
                                <?php
                            }
                        }
                        $first++;
                        $horaireSave = $horaireFin;
                    }

                ?>
            </div>
            
        <?php 
    }
}



function affichageNote($idUtilisateur)
{
    $objetMatiere = new Matieres();
    $matieres = $objetMatiere -> listeMatiere();

    $objetNote = new Notes();
    $notes = $objetNote -> noteEleve($_SESSION["idUtilisateur"]);
   
    $listenote = [];
    $i = 0;
    foreach($notes as $note)
    {
        $listenote[$note["matiere"]][$i]["notes"] = $note["Note"];
        $listenote[$note["matiere"]][$i]["designation"] = $note["designation"];
        $listenote[$note["matiere"]][$i]["noteMax"] = $note["NoteMax"];

        $i++;
    }
    ?>
    <div class="enteteAccueil">
        <h3> Notes de l'élève :</h3>
    </div>
    <div style="overflow-y:scroll; height:235px">
        <ul class="list-group">
            <?php
            foreach($matieres as $matiere)
            {

                ?>
                <li class="list-group-item">
                    <h5><?=$matiere["matiere"];?></h5>
                    <ul class="list-group list-group-flush">
                        <?php
                        foreach($listenote as $x => $note)
                        {
                            if($x == $matiere["matiere"])
                            {
                                foreach($note as $Note)
                                {                      
                                    ?>
                                    <li class="list-group-item" ><?=$Note["designation"]." : ".$Note["notes"] . "/" . $Note["noteMax"];?></li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </li>
                
                <?php
            }
            ?>    
        </ul>
    </div>
     
    <?php
}

function affichagePunition($idUtilisateur)
{
    ?>
    <div class="enteteAccueil">

        <h3> Message :</h3>

    </div>
    <div style="height:150px; ">

    </div>
        <?php
}

function affichageAbsence()
{

    $objetAbsence = new Absence();
    $absenses = $objetAbsence -> absenceEleve($_SESSION["idUtilisateur"]);
    ?>
    
    <div class="absenceEleve">
        <div class="enteteAccueil">
            <h3> Absences de l'élève :</h3>
        </div>
        <div id="div_container_absence">
            <div class="div_list_absenceDeEleve">
            <ul class="list-group">
                <?php
                    foreach($absenses as $absence)
                    {
                        if($absence["verifJustification"] == 'oui')
                        {
                            ?>
                            <li class="list-group-item">
                            <i class="fas fa-check"></i> Absence Justifié 
                                <br>
                            <p>du <?=$absence["date"];?> de <?=$absence["horaireDebut"];?> à <?=$absence["horaireFin"];?></p>
                            <p>
                                Justification : <?=$absence["justification"];?>
                            </p>
                            </li>
                            <?php
                            
                        }
                        else
                        {
                            ?>
                            <li class="list-group-item">
                            <i class="fas fa-times"></i> Absence Injustifié 
                                <br>
                            <p style="color:red">du <?=$absence["date"];?> de <?=$absence["horaireDebut"];?> à <?=$absence["horaireFin"];?></p>
                            <p>
                                Justification : <?=$absence["justification"];?>
                            </p>
                            </li>
                            <?php
                        }
                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
    <?php 
}