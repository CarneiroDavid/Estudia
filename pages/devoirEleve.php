<?php
// print_r($_SESSION);
    require_once "entete.php";
    if(isset($_GET["Jour"]))
    {
        $jour = $_GET["Jour"]." day";
    }
    else
    {
        $jour = "+1 day";
    }
    $demain = date("Y-m-d", strtotime($jour));
    ?>

    <div class="etu-index-devoir-block" style="height : 550px">
        <?php
        affichageDevoir(2, $demain);
        ?>
    </div>
    <?php

require_once "footer.php";
?>
