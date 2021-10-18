<?php
require_once "../modeles/modeles.php";
print_r($_POST);

if(!empty($_POST["idEnvoyeur"]))
{
    if(!empty($_POST["idReceveur"]))
    {
        $objetConversation = new Conversation();
        $verifConv = $objetConversation -> verifConv($_POST["idEnvoyeur"], $_POST["idReceveur"]);
        if($verifConv["idEnvoyeur"] != $_POST["idEnvoyeur"] && $verifConv["idReceveur"] != $_POST["idReceveur"])
        {
            $insertConv = $objetConversation -> insertConversation($_POST["idEnvoyeur"],$_POST["idReceveur"]);

            if($insertConv == true)
            {
                $id = $_SESSION["idUtilisateur"];
                $idReceveur = $_POST["idReceveur"];
                header("location:../pages/messagerie.php?idUtilisateur=$id");    
            }
            else
            {
                header("location:../pages/conversation.php");    
            }
        }
        else
        {
            $idReceveur = $_POST["idReceveur"];
            header("location:../pages/conversation.php?idReceveur=$idReceveur");    
        }
    }
    else
    {
        header("location:../pages/conversation.php?error=vide");    
    }
}
else
{
    header("location:../pages/conversation.php?error=vide");    
}