<?php

require_once 'entete.php';

if(empty($_SESSION["nom"]))
{
?>
<div id="accueil">
    <div id="connexion" class="container-xxl">
        <form method="post" style="background-color: white" action="../traitements/Connexion.php">
            <div class="form-group">
                <label for="identifiant" style="font-weight :bold; color:rgb(109, 19, 121);">Identifiant</label>
                <input type="text" style="border-color :rgb(109, 19, 121); " class="form-control" name="identifiant" id="identifiant" placeholder="id"/>
            </div>
            <div class="form-group">
                <label for="mdp" style="font-weight :bold; color:rgb(109, 19, 121);">Mot de passe</label>
                <input type="password" style="border-color :rgb(109, 19, 121); " class="form-control" name="mdp" id="mdp" placeholder="Mot de passe"/>
            </div>

            <div class="form-group text-center"> 
                <button type="submit" name="bouton" value="1" style="font-family: Arial; color : white ;background-color : rgb(109, 19, 121);" class="btn">Connexion</button>
            </div>
        </form>
    </div>

</div>
<?php
}else 
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
?>


<?php
require_once "footer.php";
?>