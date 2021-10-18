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

    <form method='get' style="width:100%">

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
