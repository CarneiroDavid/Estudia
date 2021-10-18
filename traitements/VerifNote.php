<?php

require_once "../modeles/modeles.php";


if(!empty($_POST["envoi"]) && $_POST["envoi"] == 1 || !empty($_POST['modif']))
{
    ?>
    <pre>
<?php
    print_r($_POST);

    ?>
    </pre>
    <?php
    if(!empty($_POST["matiere"]) && !empty($_POST["note"]) && !empty($_POST["designation"]) && !empty($_POST["noteMax"]))
    {
        // echo "test";

        if(strlen($_POST["designation"]) < 100)
        {
            $notes = new notes();
            if(!empty($_POST["modif"]))
            {
               
                $idEleve = $_POST["idEleve"];
                if(is_numeric($_POST['note']) && $_POST['note'] <= $_POST['noteMax'] && $_POST['note'] >= 0)
                {
                    if($notes -> modifierNote($_POST["modif"], $_POST['note'], $_POST["matiere"], $_POST["designation"], $_POST["noteMax"], $_POST["commentaire"]) == true)
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
                foreach($_POST["note"] as $idUtilisateur => $note)
                {

                    if(is_numeric($note) && $note <= 20 && $note >= 0)
                    {
                
                        if($notes -> insertionNote($idUtilisateur, $note, $_POST["matiere"], $_POST["designation"], $_POST["noteMax"]) == true)
                        {
                            
                            $i++;
                        }
                        else
                        {
                            $erreurs += "Erreur Insertion Bdd : Utilisateur ".$idUtilisateur.".";

                        }
                    }else
                    {
                        header("location:../pages/prof.php?error=NotePasUnChiffre");
                    }
                }
                if($i == count($_POST["note"])){
                    header("location:../pages/prof.php?success=Note");
                }else{
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