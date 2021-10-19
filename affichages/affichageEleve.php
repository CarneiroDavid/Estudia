<?php
function getBdd()
{
    return new PDO('mysql:host=localhost;dbname=estudia;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function affichageDevoir($idEtude, $date)
{
    
    $requete = getBdd() -> prepare("SELECT * FROM devoirs INNER JOIN matieres USING (idMatiere) WHERE idEtude = ? AND laDate = ? ORDER BY matiere");
    $requete -> execute([$idEtude, $date]);
    $devoirs = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $listeDevoir = [];
    $i = 0;


    ?>
    <div style="border:2px solid;text-align:center;border-radius:5%;color:white;background-color : rgb(109, 19, 121);text-shadow: 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000;">

    <form method='get' id="devoir" style="width:100%">

    <button type="submit"  
    value="<?= isset($_GET['Jour']) ? $_GET['Jour']-1 : -1 ;?>" 
    name='Jour' 
    style="float:left;margin-top:1%">

    <

    </button>

    <button type="submit" 
    value="<?= isset($_GET['Jour']) ? $_GET['Jour']+1 : 2 ?>"
    name='Jour' style="float:right;margin-top:1%">

    >

    </button>
    
    <h3 ><?=$date;?></h3>
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
        <div style="padding-left:2%;overflow: scroll;">
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
                            <p style="font-size:1em"><?=$a["info"];?></p>
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

function affichageNote($idUtilisateur)
{
    $requete = getBdd() -> prepare("SELECT matiere FROM matieres");
    $requete -> execute();
    $matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $requete = getBdd() -> prepare("SELECT Note, idUtilisateur, matieres.matiere, designation FROM notes INNER JOIN matieres USING(idMatiere) WHERE idUtilisateur = ?");
    $requete -> execute([$idUtilisateur]);
    $notes = $requete -> fetchAll(PDO::FETCH_ASSOC);
    $listenote = [];
    $i = 0;
    foreach($notes as $note)
    {
        $listenote[$note["matiere"]][$i]["notes"] = $note["Note"];
        $listenote[$note["matiere"]][$i]["designation"] = $note["designation"];
        $i++;
    }
    ?><div style="border:2px solid;text-align:center;border-radius:5%;color:white;background-color : rgb(109, 19, 121);text-shadow: 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000;">

        <h3> Notes de l'élève :</h3>

        </div>
        <ul>
        <?php
        foreach($matieres as $matiere)
        {
            ?>
            
                <h4><?=$matiere["matiere"];?></h4>
            <ul class="list-group-item" style="width:85%">
            <?php
            foreach($listenote as $x => $note)
            {
                if($x == $matiere["matiere"])
                {
                    foreach($note as $Note)
                    {                      
                        ?>
                        <li><?=$Note["designation"]." : ".$Note["notes"];?></li>
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
        <?php
}

function affichagePunition($idUtilisateur)
{
    ?>
    <div style="border:2px solid;text-align:center;border-radius:5%;color:white;background-color : rgb(109, 19, 121);text-shadow: 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000;">

        <h3> Message :</h3>

    </div>
    <div style="height:150px; ">

    </div>
        <?php
}
function affichageEDT($idEtude,$date)
{
    $requete = getBdd() -> prepare("SELECT idCours, idUtilisateur, idSalle, idClasse, edt.matiere, date, horaireDebut, horaireFin, enseignants.Nom, numero from edt LEFT JOIN enseignants using(idUtilisateur) INNER JOIN salle using(idSalle) WHERE idClasse = ? AND date = ?");
    $requete->execute([$idEtude,$date]);
    $edt = $requete->fetchAll(PDO::FETCH_ASSOC)
    ?>
    <div style="border:2px solid;text-align:center;border-radius:5%;color:white;background-color : rgb(109, 19, 121);text-shadow: 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000, 0 0 2px #000;width:100%;">

    <form method='get' style="width:100%;height:80px;">

    <button type="submit"  
    value="<?= isset($_GET['Jour']) ? $_GET['Jour']-1 : -1 ;?>" 
    name='Jour' 
    style="float:left;">

    <

    </button>

    <button type="submit" 
    value="<?= isset($_GET['Jour']) ? $_GET['Jour']+1 : 2 ?>"
    name='Jour' style="float:right;">

    >

    </button>
    <div>
    <h3>Emploi du temps</h3>
    
    <h4 ><?=$date;?></h4>
    </div>
    </form>
    </div>
    <br>
    <div id="jour" style="display:flex;width:100%">
    <?php
    $horaireSave = 0;
    $first=0;
    foreach($edt as $jour)
    {   
        $horaireDebut = (int)substr($jour["horaireDebut"], 0, -6);
        $horaireFin = (int)substr($jour["horaireFin"], 0, -6);
        if($first == 0){
            for($i = 8; $i<$horaireDebut;$i++)
            {
                ?>
                <div id="<?=$i;?>h" style="width:50%;height:80%;">
                <span id="18h"><?=$i;?>h</span>
                </div>
                <?php
            }
        }
        
        if($horaireDebut - $horaireSave != 0 && $first > 0)
        {
            ?>
            <div id="<?=$horaireSave;?>h/<?=$horaireDebut;?>h" style="width:50%;height:80%;">
            <span id="18h"><?=$horaireSave;?>h</span>
            <div style="width:100%;border-style:groove;height:80%;text-align:center;background:gray;">
            <span>Permanence</span>
            <br>
            <span> / / </span>
            </div>
            </div>
            <?php
        }
        if($horaireFin - $horaireDebut == 1){
            ?> <div id="<?= $jour["horaireDebut"]?>" style="width:50%;height:80%"><?php
        }else{
            ?> <div id="<?= $jour["horaireDebut"]?>" style="width:100%;height:80%"><?php
        }
        ?>
        
        
            <span id="<?= $jour["horaireDebut"]?>"><?=$horaireDebut?>h</span>
            <div style="width:100%;border-style:groove;height:80%;text-align:center;
            <?php if($jour["matiere"] == 'Français')
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
            
            ?>

            ">
                <span><?= $jour["matiere"];?></span>
                <br>
                <span>Salle <?= $jour["numero"];?></span>
            </div>
        </div>
        <?php
        $first++;
        $horaireSave = $horaireFin;
    }

    ?>
    
        <div id="17h/18h" >
            <span id="18h">18h</span>
        </div>
    </div>
    <?php 

}
