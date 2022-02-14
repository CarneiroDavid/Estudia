<?php
require_once "../modeles/modeles.php";
// print_r($_POST);
$idUtilisateur = $_SESSION["idUtilisateur"];

if(!empty($_POST["message"]))
{
    if(!empty($_POST["envoie"]))
    {
        if(strlen($_POST["message"]) < 400 && strlen($_POST["message"]) > 0)
        {
            $objetMessage = new Message();
            $insertMessage = $objetMessage -> insertMessage($_POST["idConversation"], $_SESSION["idUtilisateur"], $_POST["envoie"], $_POST["message"]);
            if($insertMessage == true)
            {
                $idReceveur = $_POST["envoie"];
                $idConversation = $_POST["idConversation"];
                header("location:../pages/conversation.php?idReceveur=$idReceveur&idConversation=$idConversation");
            }
        }
        else
        {
            header("location:../pages/messagerie.php?idUtilisateur=$idUtilisateur&error=messLong");
        }
    }
    else
    {
        header("location:../pages/messagerie.php?idUtilisateur=$idUtilisateur&error=id");
    }
}
else
{
    header("location:../pages/messagerie.php?idUtilisateur=$idUtilisateur&error=messVide");
}