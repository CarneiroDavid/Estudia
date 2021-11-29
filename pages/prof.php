<?php 
require_once "entete.php";
?>
<!-- <h2>test</h2> -->
<br>

<?php
if(!empty($_SESSION["identifiant"]) && $_SESSION["statut"] == "Professeur")
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
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
require_once "footer.php";
?>