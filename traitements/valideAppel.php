<?php
require_once "../modeles/modeles.php";
# TODO : Gestion D'erreur;

$Edt = new Edt();
if(!empty($_POST))
{
    $Cour = $Edt->selectCours($_POST["idCours"]);
    if(!empty($_POST["valideAppel"]) && $_POST["valideAppel"] == 1)
    {
       
        if($Cour["appel"] == 0 || $Cour["appel"] == null)
        {   
            foreach($_POST["Classe"]["eleve"] as $x =>$eleve)
            {
                
                if($eleve["presence"]== 1)
                {
                    $objetAbsence = new Absence();
                    if(empty($eleve["valideJustif"]))
                    {
                        $objetAbsence -> eleveAbsent($eleve["idUtilisateur"], $_POST["idCours"], $eleve["justification"], 'non');

                    }
                    if(!empty($eleve["valideJustif"]))
                    {
                        $objetAbsence -> eleveAbsent($eleve["idUtilisateur"], $_POST["idCours"], $eleve["justification"],'oui' );

                    }
                }
                if($eleve["presence"] == 2)
                {
                    $objetRetard = new Retard();
                    if(empty($eleve["valideJustif"]))
                    {
                        $objetRetard -> eleveRetard($eleve["idUtilisateur"], $_POST["idCours"], $eleve["justification"], 'non');

                    }
                    if(!empty($eleve["valideJustif"]))
                    {
                        $objetRetard -> eleveRetard($eleve["idUtilisateur"], $_POST["idCours"], $eleve["justification"],'oui' );

                    }
                }           
            }    
        }else if($Cour["appel"] == 1)
        {
            
            foreach($_POST["Classe"]["eleve"] as $x =>$eleve)
            {
                $objetAbsence = new Absence();
                $ListeAbsents = $objetAbsence->listeAbsents($_POST["idCours"]);
                $objetRetard = new Retard();
                $ListeRetards= $objetRetard->listeRetards($_POST["idCours"]);
                $Here = 0;
                foreach($ListeAbsents as $absent)
                {
                    if($absent["idUtilisateur"] == $eleve["idUtilisateur"])
                    {
                        $Here++;
                        if($eleve["presence"] == 2){

                            if(empty($eleve["valideJustif"]))
                            {
                                if($objetRetard->eleveRetard( $eleve["idUtilisateur"],$_POST["idCours"],$eleve["justification"], 'non'))
                                {
                                    echo "<h1>Test1</h1>";
                                }else{
                                    echo "<h1>Non1</h1>";
                                }
                            }else{
                                if($objetRetard->eleveRetard($eleve["idUtilisateur"],$_POST["idCours"], $eleve["justification"], 'oui'))
                                {
                                    echo "<h1>Test2</h1>";
                                }else{
                                    echo "<h1>Non2</h1>";
                                }
                            }
                            
                            if($objetAbsence->removeAbsent($_POST["idCours"], $eleve["idUtilisateur"]))
                            {
                                echo "<h1>Test3</h1>";
                            }else{
                                echo "<h1>Non3</h1>";
                            }

                            
                        }
                        else if($eleve["presence"] == 0){

                            if($objetAbsence->removeAbsent($_POST["idCours"], $eleve["idUtilisateur"]))
                            {
                                echo "<h1>Test4</h1>";
                            }else{
                                echo "<h1>Non4</h1>";
                            }
                            if($objetRetard->removeRetard($_POST["idCours"], $eleve["idUtilisateur"]))
                            {
                                echo "<h1>Test5</h1>";
                            }else{
                                echo "<h1>Non5</h1>";
                            }

                        }else if($eleve["presence"] == 1){
                            if(empty($eleve["valideJustif"]))
                            {
                                if($objetAbsence->modifAbsence($_POST["idCours"],$eleve["idUtilisateur"] , $eleve["justification"], 'non'))
                                {
                                    echo "<h1>Test6</h1>";
                                }else{
                                    echo "<h1>Non6</h1>";
                                }
                            }else{
                                if($objetAbsence->modifAbsence($_POST["idCours"],$eleve["idUtilisateur"] , $eleve["justification"], 'oui'))
                                {
                                    echo "<h1>Test7</h1>";
                                }else{
                                    echo "<h1>Non7</h1>";
                                }
                            }
                        }
                    }
                }
                foreach($ListeRetards as $retard)
                {
                    if($retard["idUtilisateur"] == $eleve["idUtilisateur"])
                    {
                        $Here++;
                        if($eleve["presence"] == 1){

                            if(empty($eleve["valideJustif"]))
                            {
                                if($objetAbsence->eleveAbsent($eleve["idUtilisateur"],$_POST["idCours"] , $eleve["justification"], 'non'))
                                {
                                    echo "<h1>Test8</h1>";
                                }else{
                                    echo "<h1>Non8</h1>";
                                }
                            }else{
                                if($objetAbsence->eleveAbsent($eleve["idUtilisateur"],$_POST["idCours"],  $eleve["justification"], 'oui'))
                                {
                                    echo "<h1>Test9</h1>";
                                }else{
                                    echo "<h1>Non9</h1>";
                                }
                            }
                            
                            if($objetRetard->removeRetard($_POST["idCours"], $eleve["idUtilisateur"]))
                            {
                                echo "<h1>Test10</h1>";
                            }else{
                                echo "<h1>Non10</h1>";
                            }

                            
                        }
                        else if($eleve["presence"] == 0){

                            if($objetAbsence->removeAbsent($_POST["idCours"], $eleve["idUtilisateur"]))
                            {
                                echo "<h1>Test11</h1>";
                            }else{
                                echo "<h1>Non11</h1>";
                            }
                            if($objetRetard->removeRetard($_POST["idCours"], $eleve["idUtilisateur"]))
                            {
                                echo "<h1>Test12</h1>";
                            }else{
                                echo "<h1>Non12</h1>";
                            }

                        }else if ($eleve["presence"] == 2){
                            if(empty($eleve["valideJustif"]))
                            {
                                if($objetRetard->updateRetard($_POST["idCours"], $eleve["idUtilisateur"], $eleve["justification"], 'non'))
                                {
                                    echo "<h1>Test13</h1>";
                                }else{
                                    echo "<h1>Non13</h1>";
                                }
                            }else{
                                if($objetRetard->updateRetard( $_POST["idCours"],$eleve["idUtilisateur"], $eleve["justification"], 'oui'))
                                {
                                    echo "<h1>Test14</h1>";
                                }else{
                                    echo "<h1>Non14</h1>";
                                }
                            }
                        }
                    }
                }
                if($Here == 0)
                {
                    if($eleve["presence"] == 1)
                    {
                        if(empty($eleve["valideJustif"]))
                        {
                            if($objetAbsence->eleveAbsent($eleve["idUtilisateur"],$_POST["idCours"],  $eleve["justification"], 'non'))
                            {
                                echo "<h1>Test15</h1>";
                            }else{
                                echo "<h1>Non15</h1>";
                            }
                        }else{
                            if($objetAbsence->eleveAbsent($eleve["idUtilisateur"],$_POST["idCours"],  $eleve["justification"], 'oui'))
                            {
                                echo "<h1>Test16</h1>";
                            }else{
                                echo "<h1>Non16</h1>";
                            }
                        }
                    }
                    if($eleve["presence"] == 2)
                    {
                        if(empty($eleve["valideJustif"]))
                        {
                            $objetRetard -> eleveRetard($eleve["idUtilisateur"], $_POST["idCours"], $eleve["justification"], 'non');
    
                        }
                        if(!empty($eleve["valideJustif"]))
                        {
                            $objetRetard -> eleveRetard($eleve["idUtilisateur"], $_POST["idCours"], $eleve["justification"],'oui' );
    
                        }
                    }
                }
            }
        }
    }    
}
else
{
    header("location:../pages/index.php");
}