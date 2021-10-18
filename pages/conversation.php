<?php

require_once "entete.php";
?>
<div class="container" style="border: solid 1px lightgray; height:700px">
    <div class="mb-3">
        <div style="overflow-y:scroll; height: 550px">
            <table>
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
                                <td style="color: red;"><?=$message["message"];?></td>
                            </tr>
                            <?php
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td><?=$message["message"];?></td>
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
require_once "footer.php";
