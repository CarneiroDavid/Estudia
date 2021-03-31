<?php

require_once "../modeles/modeles.php";


if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1)
{
    if(!empty($_POST["matiere"]) && !empty($_POST["note"]) && !empty($_POST["libelle"]))
    {
        if(strlen($_POST["libelle"]) < 100)
        {
            foreach($_POST["note"] as $idUtilisateur => $note)
            {

                if(is_numeric($note) && $note <= 20 && $note >= 0)
                {
            
                    if(insertionNote($idUtilisateur, $note, $_POST["matiere"], $_POST["libelle"]), $_POST["noteMax"] == true)
                    {
                        header("location:../pages/prof.php?success=Note");
                    }
                    else
                    {
                        // header("location:../pages/index.php?error=Note");

                    }
                }else
                {
                    header("location:../pages/prof.php?error=NotePasUnChiffre");
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