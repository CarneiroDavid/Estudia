<?php

require_once "entete.php";
if(!empty($_GET["idReceveur"]) && !empty($_GET["idConversation"]))
{

    /* Affichage des messages */
    ?>
        <div class="container" style="border: solid 1px lightgray; height:700px; margin-top:50px;">
            <div class="mb-3" style="width: 100%;">
                <div style="overflow-y:scroll; height: 550px;width:100%">
                    <table style="width: 100%; ">
                        <tbody style="width: 100%;">
                        <?php
                            $objetConversation = new Message();
                            $messages = $objetConversation -> recupMessage($_SESSION["idUtilisateur"], $_GET["idReceveur"]);
                            
                            foreach($messages as $message)
                            {
                                if($message["idEnvoyeur"] == $_SESSION["idUtilisateur"])
                                {
                                    ?>
                                    <tr style="width: 100%;">
                                        <td style="width: 50%;"></td>
                                        <td style= "color:blue;width: 50%"><span style="float: right;"><?=$message["message"];?></span></td>
                                    </tr>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td><?=$message["message"];?></td>
                                        <td style="width: 50%;"></td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div style="margin-top:20px">
                    <form action="../traitements/valideMessage.php" style="border: none; width:100%" method="post">
                        <input type="text" class="form-control" id="message" name="message" placeholder="Ecrivez votre message"> 
                        <input type="hidden" name="idConversation" value="<?=$_GET['idConversation'];?>">
                        <button type="submit" name="envoie" value="<?=$_GET["idReceveur"];?>">Envoyez</button>
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

<?php
require_once "footer.php";
