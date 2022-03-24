<?php
require_once "entete.php";
$objetEleve = new Eleves();
$eleves = $objetEleve -> listeEleves();

$objetClasse = new Classes();
$classes = $objetClasse -> allClasse();

$objetUser = new User();
$ip = $objetUser -> recupIpAutorise($_SERVER["REMOTE_ADDR"]);

?>
<h3 class="text-center" id="titre">Fiche d'appel</h3>
</br>
<?php
if($_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration" /*&& $_SERVER["REMOTE_ADDR"] == $ip["ip"]*/)
{
    if(empty($_POST["envoie"]) && empty($_POST["classe"]))
    {
        ?>
        <!-- SELECT des classe disponible -->
        
        <form action="appel.php" method="post">
            <label>Choisissez une classe</label>
            <select class="form-select" name="classe" aria-label="Default select example">
                <?php
                foreach($classes as $classe)
                {
                    ?>
                        <option value="<?=$classe["idEtude"];?>"><?=$classe["nom"];?> <?=$classe["classe"];?></option>
                    <?php
                }
                ?>
            </select>
            <br>
            <button type="submit" name="envoie" value="1" class="btn">Valider</button>
        </form>
    
        <?php
    }
    if(!empty($_POST["classe"]))
    {
      if(isset($_POST["Jour"]))
      {
          $jour = $_POST["Jour"];
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
        <!-- Liste des eleves concernant la classe selectionner -->
    
    <div class="etu-container">
      <div class="enteteAccueil">
          <form method='post' class="form-edt">
              <button type="submit" value="<?= isset($_POST['Jour']) ? $_POST['Jour']-7 : -7 ;?>" name='Jour' class="edt-fleche-gauche">

              <

              </button>

              <button type="submit" 
              value="<?= isset($_POST['Jour']) ? $_POST['Jour']+7 : 7 ?>"
              name='Jour' class="edt-fleche-droite">

              >

              </button>
              <div>
                  <h5>Emploi du temps</h5>
                  
                  <h6 >Semaine du <?=$jourDebut?> au <?=$jourFin?> </h6>
              </div>
              <input type=hidden name="classe" value="<?=$_POST["classe"]?>">
          </form>
      </div>
    <div class="etu-index-edt">
        <div id=j1 class="etu-index-edt-jour">
            <div class="enteteAccueil">    
                <p>Lundi <?=$jourDebut?></p>
            </div>                
            <?php
              $jourDebut = date("Y-m-d", strtotime("+".($jour)." day"));

                affichageEDT($_POST["classe"], $jourDebut, 'Etudiant', $firstWeek = 1);
            ?>
        </div>
        <div id=j2 class="etu-index-edt-jour">                    
            <?php
                $jourDebut = date("Y-m-d", strtotime("+".($jour+1)." day"));
                $jourDebutAffichage = date("d-m-Y", strtotime("+".($jour+1)." day"));
            ?>
            <div class="enteteAccueil">    
                <p>Mardi <?=$jourDebutAffichage?></p>
            </div>
            <?php  
                affichageEDT($_POST["classe"], $jourDebut, 'Etudiant');
            ?>
        </div>
        <div id=j3 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+2)." day"));
                    $jourDebutAffichage = date("d-m-Y", strtotime("+".($jour+2)." day"));
                    
                    ?>
                    <div class="enteteAccueil">    
                    <p>Mercredi <?=$jourDebutAffichage?></p>
                    </div>
                     <?php   
                        affichageEDT($_POST["classe"], $jourDebut, 'Etudiant');
                    ?></div>
        <div id=j4 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+3)." day"));
                    $jourDebutAffichage = date("d-m-Y", strtotime("+".($jour+3)." day"));

                    ?>
                    <div class="enteteAccueil">    
                    <p>Jeudi <?=$jourDebutAffichage?></p>
                    </div>
                     <?php    
                        affichageEDT($_POST["classe"], $jourDebut, 'Etudiant');

                    ?></div>
        <div id=j5 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+4)." day"));
                    $jourDebutAffichage = date("d-m-Y", strtotime("+".($jour+4)." day"));

                    ?>
                    <div class="enteteAccueil">    
                    <p>Vendredi <?=$jourDebutAffichage?></p>
                    </div>
                     <?php  
                        affichageEDT($_POST["classe"], $jourDebut, 'Etudiant');
                    ?></div>
        <div id=j6 class="etu-index-edt-jour">                    <?php
                    $jourDebut = date("Y-m-d", strtotime("+".($jour+5)." day"));
                    $jourDebutAffichage = date("d-m-Y", strtotime("+".($jour+5)." day"));

                    ?>
                    <div class="enteteAccueil">    
                    <p>Samedi <?=$jourDebut?></p>
                    </div>
                     <?php  
                        affichageEDT($_POST["classe"], $jourDebut, 'Etudiant');
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
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        <?php
        
    }
}else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
require_once "footer.php";