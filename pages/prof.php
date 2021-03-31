<?php 
require_once "entete.php";
?>
<!-- <h2>test</h2> -->
<br>

<?php
if(!empty($_SESSION["identifiant"]) && $_SESSION["statut"] == "Administration")
{

    ListeClasse();
    ?>
   
    <br>

    <?php

    if(!empty($_POST["ajoutNote"]))
    {
        formulaireNote($_POST["classe"]);
    }
    if(!empty($_POST["ajoutDevoir"]))
    {
        formulaireDevoir($_POST["classe"]);
    }
}   
require_once "footer.php";
?>