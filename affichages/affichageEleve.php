<?php
require_once "entete.php";
require_once "../modeles/modeles.php";

function getBdd()
{
    // return new PDO('mysql:host=ipssisqestudia.mysql.db;dbname=ipssisqestudia;charset=UTF8', 'ipssisqestudia', 'Ipssi2022estudia',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return new PDO('mysql:host=localhost;dbname=estudia2;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

}
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
        $edt = $objetEdt -> selectEDT_Prof($idEtude,$date);
    }
        
        
        if($edt == null){

        }else{
            ?>
            <div id="jour" style="width:100%;height:100%;padding:1%;">
                <?php
                    $horaireSave = 0;
                    $first=0;
                    foreach($edt as $jour)
                    {   
                        $horaireDebut = (int)substr($jour["horaireDebut"], 0, -6);
                        $horaireFin = (int)substr($jour["horaireFin"], 0, -6);
                        
                        if($first == 0 && $firstWeek == 1)
                        {
                            for($i = 8; $i<$horaireDebut;$i++)
                            {
                                ?>
                                <div id="<?=$i;?>h"  style="width:60%;height:10%;<?php if($i == 8){ echo ''; } ?>">
                                    <span class="etu-edt-heure-span"><?=$i;?>h</span>
                                </div>
                                <?php
                            }
                        }
                        $valeurTest = $horaireDebut - $horaireSave;
                        if($valeurTest != 0 && $first > 0)
                        {
                            ?>
                            <div id="<?=$horaireSave;?>h/<?=$horaireDebut;?>h" style="width:100%;height:<?php if($valeurTest == 1){ echo '10%'; }else{ echo '14%';}?>">
                                <span id="midi" style="float:left"><?=$horaireSave;?>h</span>
                                <div style=" margin-left:10%;width:85%;border-style:groove;height:100%;text-align:center;background:gray;">
                                    <span>Permanence</span>
                                    <br>
                                    <span> / / </span>
                                </div>
                            </div>
                            <?php
                        }
                        if($horaireFin - $horaireDebut == 1)
                        {
                            ?>
                                <div id="<?= $jour["horaireDebut"]?>" style="width:100%;height:10%" data-toggle="modal" data-target="#CourDetail">
                                
                            <?php
                        }else
                        {
                            ?>
                            <div id="<?= $jour["horaireDebut"]?>" style="width:100%;height:14%" data-toggle="modal" data-target="#CourDetail"><?php
                        }
                        ?>
                        
                        
                            <span style="float:left;position:relative;top:-12px" id="<?= $jour["horaireDebut"]?>"><?=$horaireDebut?>h</span>

                            <div id='<?= $jour['idCours']?>' style="margin-left:10%;width:85%;border-style:groove;height:100%;text-align:center;
                                <?php 
                                    if($jour["matiere"] == 'Français')
                                    {
                                        echo 'background:cadetblue';
                                    }
                                    if($jour["matiere"] == 'Mathématique')
                                    {
                                        echo 'background:yellowgreen';
                                    }
                                    if($jour["matiere"] == 'Anglais')
                                    {
                                        echo 'background:tomato';
                                    }
                                    if($jour["matiere"] == 'Histoire')
                                    {
                                        echo 'background:wheat';
                                    }
                                    if($jour["matiere"] == 'Physique-Chimie')
                                    {
                                        echo 'background:orangered';
                                    }
                                    if($jour["matiere"] == 'Science')
                                    {
                                        echo 'background:salmon';
                                    }
                                    if($jour["matiere"] == 'Espagnol')
                                    {
                                        echo 'background:turquoise';
                                    }
                                
                                ?>"
                                onclick='CoursDetail(this.id)'>

                                <span><?= $jour["matiere"];?></span>
                                <br>
                                <span><?= substr($jour["prenom"], 0, 1); ?>.<?= $jour["nom"]?></span>
                                <br>
                                <span>Salle <?= $jour["numero"];?></span>
                            </div>
                            
                        </div>
                        
                        <?php
                        $first++;
                        $horaireSave = $horaireFin;
                    }

                ?>
                <span id="<?= $jour["horaireFin"]?>" style="position:relative;top:-18px;"><?=$horaireFin?>h</span>
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