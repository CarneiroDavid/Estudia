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
    if(!empty($_COOKIE["cookie-id"]) && !empty($_COOKIE["cookie-token"]))
    {
        header("location: ../traitements/Connexion.php");
    }else{
        require_once "formulaireConnexion.php";
    }
}
else 
{   
    /* Affichage index Eleve */
    
        
        if(isset($_GET["Jour"]))
        {
            $jour = $_GET["Jour"]." day";
        }
        else
        {
            $jour = "+1 day";
        }
        $demain = date("Y-m-d", strtotime($jour));
        
        #mise en page pour chaque user
        ?>
        <br>
        <div>
            <div class="etu-index-edt-block">
                <?php
                if($_SESSION["statut"] == 'Professeur')
                {
                    
                    affichageEDT($_SESSION["idUtilisateur"], $demain, 'Professeur');
                }else if($_SESSION["statut"] == 'Etudiant'){
                    affichageEDT($_SESSION["idEtude"], $demain);
                }
                ?>
            </div>
            <?php
            if(!empty($_SESSION) && $_SESSION["statut"] == "Etudiant")
            {
        ?>
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
        <?php } 
   
    
?>

<div class="modal fade" id="CourDetail" tabindex="-1" role="dialog" aria-labelledby="FormClassCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="FormClassCenterLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      <div class="modal-body">
            <div class='etd-cour-detail-block'></div>
            <div id='etd-cour-appel-block'>  
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<?php
}
require_once "footer.php";