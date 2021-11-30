<?php
require_once "entete.php";
if(empty($_SESSION["nom"]))
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

        }

        ?>
        </div>
        <?php
    }
    require_once "formulaireConnexion.php";
}
else 
{   
    /* Affichage index Eleve */
    if(!empty($_SESSION) && $_SESSION["statut"] == "Etudiant")
    {
        
        if(isset($_GET["Jour"]))
        {
            $jour = $_GET["Jour"]." day";
        }
        else
        {
            $jour = "+1 day";
        }
        $demain = date("Y-m-d", strtotime($jour));?><?php
        $demainn = date("Y-m-d", strtotime("+0 day"));
        
        #mise en page pour chaque user
        ?>
        <br>
        <div>
            <div class="etu-index-edt-block">
                <?php
                affichageEDT(2, $demain);
                ?>
            </div>
            <div class="etu-index-contain-ndabs">
                <div class="etu-index-note-block" >
                        <?php
                    affichageNote($_SESSION["idUtilisateur"]);
                        ?>
                </div>
                <div class="etu-index-devoir-block">
                        <?php
                    affichageDevoir(2, $demain);
                        ?>
                </div>

            </div>
        </div>
        <br>
        <br>
        <div id="divAbsence" class="etu-index-abs-block">
                <?php
            affichageAbsence();
                ?>
        </div>
        <?php
    }
    
    if(!empty($_SESSION) && $_SESSION["statut"] == "Professeur")
    {
        echo "<script type='text/javascript'>document.location.replace('appel.php');</script>";
    }
}
require_once "footer.php";