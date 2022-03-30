<?php
require_once "../modeles/modeles.php";
$idUtilisateur = $_SESSION["idUtilisateur"];
print_r($_POST);
if(!empty($_POST["message"]))
{
    if(!empty($_POST["idConversation"]))
    {
        $idConversation = $_POST["idConversation"];
        if(!empty($_POST["envoie"]))
        {
            $idReceveur = $_POST["envoie"];
            $objetConv = new Conversation();
            $infoConv = $objetConv -> verificationCompleteConv($_SESSION["idUtilisateur"],$idReceveur, $idConversation);
            if(!empty($infoConv))
            {
                if(strlen($_POST["message"]) < 80 && strlen($_POST["message"]) > 0)
                {
                    $objetMessage = new Message();
                    $insertMessage = $objetMessage -> insertMessage($_POST["idConversation"], $_SESSION["idUtilisateur"], $_POST["envoie"], $_POST["message"]);
                    if($insertMessage == true)
                    {
                        header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation&success=Message");
                    }
                }
                else
                {
                    header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation&error=longMess");
                }
            }
            else
            {
                header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation&error=convInexistante");
            }
        }
        else
        {
            header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation&error=receveur");
        }
    }
    else
    {
        header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation&error=erreurConv");
    }
}
else
{
    $idReceveur = $_POST["envoie"];
    $idConversation = $_POST["idConversation"];
    header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation&error=messVide");
}