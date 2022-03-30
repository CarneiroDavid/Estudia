<?php
require_once "../modeles/modeles.php";
print_r($_POST);

if(!empty($_SESSION["idUtilisateur"]))
{
    $id = $_SESSION["idUtilisateur"];
    if(!empty($_POST["idReceveur"]))
    {
        $objetUser = new User();
        $idUser = $objetUser -> verif_identifiant($_POST["idReceveur"]);
        if($idUser === true)
        {
            $objetConversation = new Conversation();
            $verifConv = $objetConversation -> verifConv($_POST["idEnvoyeur"], $_POST["idReceveur"]);
            if(empty($verifConv))
            {
                $insertConv = $objetConversation -> insertConversation($_POST["idEnvoyeur"],$_POST["idReceveur"]);
    
                if($insertConv == true)
                {
                    $objetConversation = new Conversation();
                    $verifConv = $objetConversation -> verifConv($_POST["idEnvoyeur"], $_POST["idReceveur"]);
                    
                    $idConv = $verifConv["idConversation"];
                    $idReceveur = $_POST["idReceveur"];
                    
                    header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConv");    
                }
                else
                {
                    header("location:../pages/messagerie.php?idUtilisateur=$id&error=conv");    
                }
            }
            else
            {
                header("location:../pages/messagerie.php?idUtilisateur=$id&error=convCreer");    
            }
        }
        else
        {
            header("location:../pages/messagerie.php?idUtilisateur=$id&error=fauxContact");    
        }
        
    }
    else
    {

        header("location:../pages/messagerie.php?idUtilisateur=$id&error=vide");    
    }
}
else
{
    header("location:../pages/messagerie.php?idUtilisateur=$id&error=vide"); 
}