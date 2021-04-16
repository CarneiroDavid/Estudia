<?php

class Notes extends Modele
{
    
}

function insertionNote($idUtilisateur, $note, $matiere, $designation, $noteMax)
{
    try
    {
        $requete = getBdd() -> prepare("INSERT INTO notes (idUtilisateur, Note, idMatiere, designation, NoteMax) VALUES (?, ?, ?, ?, ?)");
        $requete -> execute([$idUtilisateur, $note, $matiere, $designation, $noteMax]);
        return true;
        ?>

 
        
        <?php
    }catch(Exception $e)
    {
        echo $e -> getMessage();
        
        // header("location:../pages/ajoutnote.php?error=InjectionBdd");
        
    }

}