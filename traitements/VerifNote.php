<?php

require_once "../modeles/modeles.php";
?><pre><?php
print_r($_POST);
?></pre><?php
if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1 || !empty($_POST['modif']))
{
    
    if(!empty($_POST["matiere"]) || !empty($_POST['modif']) && !empty($_POST["note"]) && !empty($_POST["designation"]))
    {
        if(!empty($_POST["designation"]) && strlen($_POST["designation"]) <= 100)
        {
            if(!empty($_POST["NoteMax"]) && $_POST["NoteMax"] <= 20)
            {
                if(!empty($_POST["Coef"]))
                {
                    $notes = new Notes();
                    if(!empty($_POST["modif"]))
                    {
                        $idEleve = $_POST["idEleve"];
                        if(is_numeric($_POST['note']) && $_POST['note'] <= $_POST['noteMax'] && $_POST['note'] >= 0)
                        {
                            
                            if($notes -> modifierNote($_POST["modif"], $_POST['note'], $_POST["designation"], $_POST["noteMax"], $_POST["commentaire"]) == true)
                                {
                                    
                                    //("location:../pages/infoUtilisateur.php?id=$idEleve&success=modifNote");
                                }else{
                                    //("location:../pages/infoUtilisateur.php?id=$idEleve&erreur=modifNote");
                                }
                        }
        
                    }
                    if(!empty($_POST["envoi"]))
                    {
                        
                        $i = 0;
                        $noteFausse = 0;
                        $objetExamen = new Examen();
                        $insertExam = $objetExamen -> insertExam($_POST["designation"], $_SESSION["idUtilisateur"], $_POST["matiere"], $_POST["idClasse"]);
                        foreach($_POST["note"] as $idEleve => $note)
                        {
                            if(!empty($note))
                            {
                                if(is_numeric($note) && $note <= $_POST["NoteMax"] && $note >= 0)
                                {
                                    
                                    if($insertExam == true)
                                    {
                                        $idExam = $objetExamen -> idExam($_POST["designation"]);
                                        if($inserNote = $notes -> insertionNote($idEleve,$_SESSION["idUtilisateur"] ,$note, $_POST["matiere"], $idExam["idExamen"], $_POST["designation"], $_POST["NoteMax"], $_POST["Coef"], $_POST["commentaire"][$idEleve]) == true)
                                        {   
                                            $i++;
                                        }
                                    } 
                                }
                            }
                        }
                        $noteFausse = (count($_POST["note"]) - $i);

                        if($i == count($_POST["note"]))
                        { 
                            //("location:../pages/prof.php?success=Note");
                        }else{
                            $supprExam = $objetExamen -> supprimerExamen($idExam["idExamen"]);
                            $supprNotes = $notes -> suppressionNoteParExam($idExam["idExamen"]);
                            if($supprExam == true)
                            {
                                //("location:../pages/prof.php?error=problèmeNote");
                            }
                        }
                    }
                }
                else
                {
                    //("location:../pages/prof.php?error=coefVide");
                    echo "coef vide";
                }
            }
            else
            {
                //("location:../pages/prof.php?error=noteMaxSup");
                echo "erreur note max";
            }
        }else
        {
            //("location:../pages/prof.php?error=nomExam");
            echo "erreur designation";
            
        }
    }
    else
    {
        //("location:../pages/prof.php?error=ChampVide");
        echo "champ vide";
        
    }
}
else
{
    //("location:../pages/prof.php?error=NoteNonEnvoyee");
}