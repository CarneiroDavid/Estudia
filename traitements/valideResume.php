<?php
require_once "../modeles/modeles.php";
# TODO : Gestion D'erreur;
$edt = new Edt();
if($_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration"){
    if(!empty($_POST['idCours'])){
        if(!empty($_POST["resume"]) &&  strlen($_POST["resume"]) <= 200){
            
            if($edt->postResume($_POST['idCours'], $_POST['resume'])){
                echo $_POST["resume"];
            }else{
                echo "nn";
            }
        }else{
            echo $_POST["resume"];
            echo "Failed";
        }
    }else{
        echo "Failed 2";
    }
}else{
    echo "Failed 3";
}