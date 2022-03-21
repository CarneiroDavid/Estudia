<?php
require_once "entete.php";
if(!empty($_SESSION))
{
    $objetUser = new User();
    $info = $objetUser -> premiere_connexion($_SESSION["idUtilisateur"]);

}

if(!empty($_SESSION["nom"]) && $info["PremiereConnexion"] == 1)
{
    /* Affichage index Eleve */
        
            
    if(isset($_POST["Jour"]))
    {
        $jourEdt = $_POST["Jour"]." day";
    }
    else
    {
        $jourEdt = "+0 day";
    }
    if(isset($_POST["JourDevoir"]))
    {
        $jourDevoir = $_POST["JourDevoir"]." day";
    }
    else
    {
        $jourDevoir = "+1 day";
    }
    $demainEdt = date("Y-m-d", strtotime($jourEdt));
    $demainDevoir = date("Y-m-d", strtotime($jourDevoir))
    #mise en page pour chaque user
    ?>
    <br>
    
    <div class="etu-index-edt-block">
        <div class="enteteAccueil">
            <form method='post' style="width:100%;height:80px;">
                <button type="submit" value="<?= isset($_POST['Jour']) ? $_POST['Jour']-1 : -1 ;?>" name='Jour'style="float:left;">

                <

                </button>

                <button type="submit" 
                value="<?= isset($_POST['Jour']) ? $_POST['Jour']+1 : 2 ?>"
                name='Jour' style="float:right;">

                >

                </button>
                <?php if(!empty($_POST['JourDevoir'])){
                    echo '<input type=hidden name="JourDevoir" value="',$_POST['JourDevoir'],'">';
                } ;?>
                <div>
                    <h5>Emploi du temps</h5>
                    
                    <h6 ><?=$demainEdt;?></h6>
                </div>
            </form>
        </div>
        <?php
        if($_SESSION["statut"] == 'Professeur')
        {
            
            affichageEDT($_SESSION["idUtilisateur"], $demainEdt, 'Professeur', $firstWeek = 1);
        }else if($_SESSION["statut"] == 'Etudiant'){
            affichageEDT($_SESSION["idEtude"], $demainEdt, 'Etudiant',$firstWeek = 1);
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
                affichageDevoir($_SESSION["idEtude"], $demainDevoir);
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
// else if($info["PremiereConnexion"] == 0)
// {
//     header("location:premiereConnexion.php");
// }
else
{  
    // header("location:formulaireConnexion.php");
    if(!empty($_COOKIE["cookie-id"]) && !empty($_COOKIE["cookie-token"]))
    {
        header("location: ../traitements/Connexion.php");
    }else{
        require_once "formulaireConnexion.php";
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
                    <div id='etd-cour-detail-block'>
                test    
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