<?php

require_once "../modeles/modeles.php";


if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1 || !empty($_POST['modif']))
{
    print_r($_POST);
    if((!empty($_POST["matiere"]) || !empty($_POST['modif'])) && !empty($_POST["note"]) && !empty($_POST["designation"]) && !empty($_POST["noteMax"]))
    {
        
        if(strlen($_POST["designation"]) <= 100)
        {
            
            $notes = new notes();
            if(!empty($_POST["modif"]))
            {
                $idEleve = $_POST["idEleve"];
                if(is_numeric($_POST['note']) && $_POST['note'] <= $_POST['noteMax'] && $_POST['note'] >= 0)
                {
                    
                    if($notes -> modifierNote($_POST["modif"], $_POST['note'], $_POST["designation"], $_POST["noteMax"], $_POST["commentaire"]) == true)
                        {
                            
                            header("location:../pages/infoUtilisateur.php?id=$idEleve&success=modifNote");
                        }else{
                            header("location:../pages/infoUtilisateur.php?id=$idEleve&erreur=modifNote");
                        }
                }

            }
            if(!empty($_POST["envoi"]))
            {
                
                $i = 0;
                $erreurs = "";
                foreach($_POST["note"] as $idEleve => $note)
                {
                    
                    if(is_numeric($note) && $note <= $_POST["noteMax"] && $note >= 0)
                    {
                        
                        if($inserNote = $notes -> insertionNote($idEleve,$_SESSION["idUtilisateur"] ,$note, $_POST["matiere"], $_POST["designation"], $_POST["noteMax"], $_POST["commentaire"][$idEleve]) == true)
                        {   echo "<br>";
                            echo $idEleve ."  " .$_SESSION["idUtilisateur"] ."  " .$note."  " .$_POST["matiere"]. "  " .$_POST["designation"]."  " .$_POST["noteMax"]."  " .$_POST["commentaire"][$idEleve];
                            
                            $i++;
                        }
                        else
                        {   
                            
                            $erreurs += "Erreur Insertion Bdd : Utilisateur ".$idEleve.".";

                        }
                    }else
                    {
                        header("location:../pages/prof.php?error=NotePasUnChiffre");
                    }
                    echo "<br>"."get Message :  "." "."<br>";
                    echo $inserNote;
                }
                
                if($i == count($_POST["note"])){
                    echo $erreurs;
                    header("location:../pages/prof.php?success=Note");
                }else{
                    echo $erreurs;
                    header("location:../pages/index.php?error=Note".$erreurs."");
                }
            }
        }else
        {
            header("location:../pages/prof.php?error=commentaireTropLong");
        }
    }
    else
    {
        header("location:../pages/prof.php?error=ChampVide");
    }
}
else
{
    header("location:../pages/prof.php?error=NoteNonEnvoyee");
}