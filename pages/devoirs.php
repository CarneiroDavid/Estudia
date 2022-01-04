<?php
// print_r($_SESSION);
    require_once "entete.php";
    if(!empty($_SESSION["idUtilisateur"]))
    {
        // $objetEleve = new Eleves();
        // $classe = $objetEleve ->infoEleve($_SESSION["idUtilisateur"]);

        // $objetDevoir = new Devoir();
        // $devoirs = $objetDevoir -> devoir($classe["idEtude"]);
        // print_r($devoirs);
        // foreach($devoirs as $devoir)
        // {
        //     $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["titre"] = $devoir["Titre"];
        //     $listeDevoir[$devoir["laDate"]][$devoir["matiere"]][$i]["info"] = $devoir["Info"];
        //     $i++;
        // }

        // foreach ($devoirs as $x => $Devoirs)
        // {
            ?>
            <!-- <div style="margin-left:10px;overflow-y: scroll;height:150px"> -->
                <?php
                // foreach($Devoirs as $matieres => $Devoir)
                // {
                    ?>
                    <!-- <h4 ><?=$matieres;?></h4> -->
                    <!-- <ul >  -->
                    <?php
                    // foreach($Devoir as $a)
                    // {
                        ?>
                        
                            <!-- <li> -->
                                <!-- <h5 ><?=$a["titre"];?></h5> -->
                                <!-- <p class="information"><?=$a["info"];?></p> -->
                            </li>
                        <?php
                    // }
                    ?>
                    </ul>
                    <?php
                // }
                ?>
            </div>
            <?php
        // }

    }
require_once "footer.php";
?>
