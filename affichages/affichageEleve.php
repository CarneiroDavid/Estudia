<?php

function affichageDevoir($idEtude = 2, $date)
{
    $requete = getBdd() -> prepare("SELECT * FROM devoirs INNER JOIN matieres USING (idMatiere) WHERE idEtude = ? AND laDate = ? ORDER BY matiere");
    $requete -> execute([$idEtude, $date]);
    $devoirs = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $listeDevoir = [];
    $i = 0;
    foreach($devoirs as $devoir)
    {
        $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["titre"] = $devoir["Titre"];
        $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["info"] = $devoir["Info"];
        $i++;
    }
    foreach ($listeDevoir as $x => $Devoirs)
    {
        ?><h2><?=$x;?></h2><?php
        foreach($Devoirs as $matieres => $Devoir)
        {
            ?>
            <h3><?=$matieres;?></h3>
            <ul> 
            <?php
            foreach($Devoir as $a)
            {
                ?>
                
                    <li><h5><?=$a["titre"];?></h5><p><?=$a["info"];?></p></li>
                <?php
            }
            ?>
            </ul>
            <?php
        }

    }
    ?>
    <h2></h2>
    <pre>
    <?php
    // print_r($listeDevoir);
    ?></pre><?php
}