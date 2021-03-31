<?php

function affichageDevoir($idEtude = 2, $date)
{
    $requete = getBdd() -> prepare("SELECT * FROM devoirs INNER JOIN matieres USING (idMatiere) WHERE idEtude = ? AND laDate = ? ORDER BY matiere");
    $requete -> execute([$idEtude]);
    $devoirs = $requete -> fetchAll(PDO::FETCH_ASSOC);

    $listeDevoir = [];
    $i = 0;
    foreach($devoirs as $devoir)
    {
        $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["titre"] = $devoir["Titre"];
        $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["info"] = $devoir["Info"];
        $i++;
    }
    ?>
    <pre>
    <?php
    print_r($listeDevoir);
    ?></pre><?php
}