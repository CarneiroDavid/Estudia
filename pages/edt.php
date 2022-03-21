<?php
require_once "entete.php";
echo "</div>";
if(!empty($_SESSION["nom"]))
{
        /* Affichage index Eleve */
    
        
        if(isset($_GET["Jour"]))
        {
            $jour = $_GET["Jour"];
        }
        else
        {
            $jour = 0;
        }
        
        $shift = getShift(date("D", strtotime("+0 day")));
        $jour = $jour+$shift;
        $jourDebut = date("d-m-Y", strtotime("+".$jour." day"));
        $jourFin = date("d-m-Y", strtotime("+".($jour+6)." day"));
        

?>
<div class="etu-container">
    <div class="enteteAccueil">
        <form method='get' style="width:100%;height:80px;">
            <button type="submit" value="<?= isset($_GET['Jour']) ? $_GET['Jour']-7 : -7 ;?>" name='Jour'style="float:left;">

            <

            </button>

            <button type="submit" 
            value="<?= isset($_GET['Jour']) ? $_GET['Jour']+7 : 7 ?>"
            name='Jour' style="float:right;">

            >

            </button>
            <div>
                <h5>Emploi du temps</h5>
                
                <h6 >Semaine du <?=$jourDebut?> au <?=$jourFin?> </h6>
            </div>
        </form>
    </div>
    <div class="etu-index-edt">
        <div id=j1 class="etu-index-edt-jour">
            <div class="enteteAccueil">    
                <h5>Lundi <?=$jourDebut?></h5>
            </div>                
            <?php
            if($_SESSION["statut"] == 'Professeur')
            {
                
                affichageEDT($_SESSION["idUtilisateur"], $jourDebut, 'Professeur', $firstWeek = 1);
            }else if($_SESSION["statut"] == 'Etudiant'){
                affichageEDT($_SESSION["idEtude"], $jourDebut, 'Etudiant', $firstWeek = 1);
            }
            ?>
        </div>
        <div id=j2 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+1)." day"));
                    ?>
                    <div class="enteteAccueil">    
                    <h5>Mardi <?=$jourDebut?></h5>
                    </div>
                     <?php  
                    if($_SESSION["statut"] == 'Professeur')
                    {
                        
                        affichageEDT($_SESSION["idUtilisateur"], $jourDebut, 'Professeur');
                    }else if($_SESSION["statut"] == 'Etudiant'){
                        affichageEDT($_SESSION["idEtude"], $jourDebut);
                    }
                    ?></div>
        <div id=j3 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+2)." day"));
                    ?>
                    <div class="enteteAccueil">    
                    <h5>Mercredi <?=$jourDebut?></h5>
                    </div>
                     <?php  
                    if($_SESSION["statut"] == 'Professeur')
                    {
                        
                        affichageEDT($_SESSION["idUtilisateur"], $jourDebut, 'Professeur');
                    }else if($_SESSION["statut"] == 'Etudiant'){
                        affichageEDT($_SESSION["idEtude"], $jourDebut);
                    }
                    ?></div>
        <div id=j4 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+3)." day"));
                    ?>
                    <div class="enteteAccueil">    
                    <h5>Jeudi <?=$jourDebut?></h5>
                    </div>
                     <?php    
                    if($_SESSION["statut"] == 'Professeur')
                    {
                        
                        affichageEDT($_SESSION["idUtilisateur"], $jourDebut, 'Professeur');
                    }else if($_SESSION["statut"] == 'Etudiant'){
                        affichageEDT($_SESSION["idEtude"], $jourDebut);
                    }
                    ?></div>
        <div id=j5 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+4)." day"));
                    ?>
                    <div class="enteteAccueil">    
                    <h5>Vendredi <?=$jourDebut?></h5>
                    </div>
                     <?php  
                    if($_SESSION["statut"] == 'Professeur')
                    {
                        
                        affichageEDT($_SESSION["idUtilisateur"], $jourDebut, 'Professeur');
                    }else if($_SESSION["statut"] == 'Etudiant'){
                        affichageEDT($_SESSION["idEtude"], $jourDebut);
                    }
                    ?></div>
        <div id=j6 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+5)." day"));
                    ?>
                    <div class="enteteAccueil">    
                    <h5>Samedi <?=$jourDebut?></h5>
                    </div>
                     <?php  
                    if($_SESSION["statut"] == 'Professeur')
                    {
                        
                        affichageEDT($_SESSION["idUtilisateur"], $jourDebut, 'Professeur');
                    }else if($_SESSION["statut"] == 'Etudiant'){
                        affichageEDT($_SESSION["idEtude"], $jourDebut);
                    }
                    ?></div>

        
    </div>
</div>

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
}else{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}
require_once "footer.php";