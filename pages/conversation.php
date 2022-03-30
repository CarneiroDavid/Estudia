<?php

require_once "entete.php";

if(!empty($_GET["idReceveur"]) && !empty($_GET["idConversation"]))
{

    if(isset($_GET["error"]))
    {   
        ?>
        <div class="alert alert-danger text-center">
        <?php
        
        switch($_GET["error"])
        {
            case "messVide":
                echo "Vous n'avez pas saisit de message, veuillez saisir un message valide.";
                break;
            case "erreurConv" :
                echo "Une erreur est survenue, veuillez réessayer.";
                break;
            case "receveur" :
                echo "Une erreur lors de l'envoie est survenue, veuillez réessayer.";
                break;
            case "convInexistante" :
                echo "Une erreur lors de l'envoie est survenue lors de la selection de conversation, veuillez réessayer.";
                break;
            case "longMess" :
                echo "Le message saisit est trop long, veuillez en saisir un plus court.";
                break;
        }
       
        ?>
        </div>
        <?php
    }

    /* Affichage des messages */
    ?>
        <div class="div_conversation">
            <div class="mb-3">
                <div id="messagerie">
                    <table class="tableau_message">
                        <tbody>
                            <?php

                                $objetConversation = new Message();
                                $messages = $objetConversation -> recupMessage($_SESSION["idUtilisateur"], $_GET["idReceveur"]);
                                              
                                foreach($messages as $message)
                                {
                                    if($message["idEnvoyeur"] == $_SESSION["idUtilisateur"])
                                    {
                                        ?>
                                        <tr>
                                        <td></td>
                                        <td class="td_message_envoyeur">
                                            <div>
                                                <?=$message["message"];?>
                                            </div>
                                            <div><?=$message["heure_envoie"];?></div>
                                        </td>                                    
                                        </tr>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td class="td_message_receveur">
                                                <div>
                                                    <?=$message["message"];?>
                                                </div>
                                                <div><?=$message["heure_envoie"];?></div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    
                                    <tr><td class="td_entre_message"></td></tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="div_form_envoie_message">
                    <form action="../traitements/valideMessage.php" method="post">
                        <input type="text" class="form-control" id="message" name="message" placeholder="Écriver votre message"> 
                        <input type="hidden" name="idConversation" value="<?=$_GET['idConversation'];?>">
                        </br>
                        <button type="submit" class="btn" name="envoie" value="<?=$_GET["idReceveur"];?>">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    <?php
}
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
?>
<script>
    element = document.getElementById('messagerie');
    element.scrollTop = element.scrollHeight;
    // setTimeout(function()
    // {
    //     window.location.reload(1);
    // }, 10000);
</script>
<?php
require_once "footer.php";
