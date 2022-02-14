<?php
require_once "entete.php";
$objetUser = new User();
$info = $objetUser -> premiere_connexion($_SESSION["idUtilisateur"]);
// print_r($_SESSION);
// print_r($info["PremiereConnexion"]);
if(!empty($_SESSION["nom"]) && $info["PremiereConnexion"] == 1)
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
                <br>
                <div class="etu-index-devoir-block">
                    <?php
                    affichageDevoir(2, $demain);
                    ?>
                </div>
            </div>
            <div id="divAbsence" class="etu-index-abs-block">
                <?php
                affichageAbsence();
                ?>
            </div>
            <?php
        }
}
else if($info["PremiereConnexion"] == 0)
{
    header("location:premiereConnexion.php");
}
else
{  
    header("location:formulaireConnexion");
    if(!empty($_COOKIE["cookie-id"]) && !empty($_COOKIE["cookie-token"]))
    {
        header("location: ../traitements/Connexion.php");
    }   
} 
    
    
   
    
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
require_once "footer.php";