<?php
require_once "../modeles/modeles.php";

print_r($_POST);

if(!empty($_POST["classe"]))
{
    if(!empty($_POST["numClasse"]))
    {
        if(is_numeric($_POST["numClasse"]))
        {
            $objetClasse= new Classes();
            
            if($objetClasse->insertionClasse($_POST["numClasse"], $_POST["nomClasse"]) == true)
            {
                header("location:../pages/modifClasse.php?success=classeAjout");
            }
            else
            {
                header("location:../pages/modifClasse.php?error=classeAjout");
            }
        }
        else
        {
            header("location:../pages/modifClasse.php?error=numClasseNonNumeric");

        }
    }
    else
    {
        header("location:../pages/modifClasse.php?error=numClasseVide");
    }
}
else
{
    header("location:../pages/modifClasse.php?error=nomClasseVide");
}