<?php

require_once 'entete.php';
if(empty($_COOKIE["cookie-id"]) && empty($_COOKIE["cookie-token"]))
{
    if(isset($_GET["error"]))
    {
        ?>
        <div class="alert alert-danger">
        <?php
        
        switch($_GET["error"])
        {
            case "FalseMdp":
                echo "Le mot de passe saisit ne correspond a aucun mot de passe connue";
                break;
            case "TailleMdp":
                echo "Le mot de passe saisit doit faire 8 caractères ou plus ";
                break;
            case "FalseId" :
                echo "L'identifiant saisit n'existe pas";
                break;
            case "FormConnec" :
                echo "Le formulaire de connexion est vide";
                break;
            case "Connexion" :
                echo "Nous n'arrivons pas a vous connecter";
                break;
            case "LoginFaux" :
                echo "Les logins d'identification sont faux.";
                break;
        }
        ?>
        </div>
        <?php
    }
    if(empty($_SESSION["nom"]))
    {
    ?>
        <div id="accueil">
            <div id="connexion" class="container-xxl">
                <form method="post" action="../traitements/Connexion.php">
                    <div class="form-group">
                        <label for="identifiant" class="form-connexion-ecriture">Identifiant</label>
                        <input type="text"class="form-control form-connexion-input" name="identifiant" id="identifiant" placeholder="id"/>
                    </div>
                    <div class="form-group">
                        <label for="mdp" class="form-connexion-ecriture">Mot de passe</label>
                        <input type="password" class="form-control form-connexion-input" name="mdp" id="mdp" placeholder="Mot de passe"/>
                    </div>
                    <div class="form-group">
                        <label>Se souvenir de moi</label>
                        <input type=checkbox id='cookie-connection' name='cookie-connection'>
                    </div>
                    <div class="form-group text-center"> 
                        <button type="submit" name="bouton" value="1" class="btn">Connexion</button>
                    </div>
                </form>
            </div>

        </div>
        <?php
    }
    // else 
    // {
    //     echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    // }
}
else{
    
    // header("location: ../traitements/Connexion.php");
    
}
    ?>


<?php
require_once "footer.php";
?>