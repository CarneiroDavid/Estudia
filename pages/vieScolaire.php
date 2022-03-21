<?php 
require_once "entete.php";

if(!empty($_SESSION["idUtilisateur"]) && $_SESSION["PremiereConnexion"] == 1)
{
    ?>
    <div>
        <?php
        $objetAbsence = new Absence();
        $absenses = $objetAbsence -> absenceEleve($_SESSION["idUtilisateur"]);
        ?>
        
        <div>
            <div>
                <h3> Absences de l'élève :</h3>
            </div>
            <?php
            // print_r($absenses);
            ?>
            <div id="div_container_absence">
                <div class="div_list_absenceDeEleve">
                <ul class="list-group">
                    <?php
                        foreach($absenses as $absence)
                        {
                            if($absence["verifJustification"] == 'oui')
                            {
                                ?>
                                <li class="list-group-item">
                                <i class="fas fa-check"></i> Absence Justifié 
                                    <br>
                                <p>du <?=$absence["date"];?> de <?=$absence["horaireDebut"];?> à <?=$absence["horaireFin"];?></p>
                                <p>
                                    Cours : <?=$absence["matiere"];?>
                                    <br>
                                    Justification : <?=$absence["justification"];?>
                                </p>
                                </li>
                                <?php
                                
                            }
                            else
                            {
                                ?>
                                <li class="list-group-item">
                                <i class="fas fa-times"></i> Absence Injustifié 
                                    <br>
                                <p style="color:red">
                                    du <?=$absence["date"];?> de <?=$absence["horaireDebut"];?> à <?=$absence["horaireFin"];?></p>
                                <p>
                                    Cours : <?=$absence["matiere"];?>
                                    <br>
                                    Justification : <?=$absence["justification"];?>
                                </p>
                                </li>
                                <?php
                            }
                        }
                    ?>
                </ul>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else
{
    header("location:index.php");
}