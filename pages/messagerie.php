<?php
require_once "entete.php";

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Etudiant" || $_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
{
    if(!empty($_GET["idUtilisateur"]) && $_GET["idUtilisateur"] == $_SESSION["idUtilisateur"])
    {
        /* gestion erreur */
        if(isset($_GET["error"]))
        {
            ?>
            <div class="alert alert-danger">
            <?php
            
            switch($_GET["error"])
            {
                case "messVide":
                    echo "Le message que vous avez essayé d'envoyer etait vide, veuillez saisir un message valide.";
                    break;
                case "id":
                    echo "Le message n'a pas pu être envoyé, veuillez réessayer ";
                    break;
                case "messLong" :
                    echo "Le message saisit est trop long, veuillez saisir un message plus court";
                    break;
            }

            ?>
            </div>
            <?php
        }
        ?>
        <div>
            <!-- Systeme recherche d'utilisateur pour conversation -->
            <div class="card mt-5">
                
                <button style="border: none;" onclick="contactProf()" class="card-header">
                    Contacter un utilisateur ▼
                </button>

                <div class="card-body" id="contactProf" style="display: block;">
                    <form action="messagerie.php?idUtilisateur=<?=$_GET["idUtilisateur"];?>" method="get" style="border:none">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom de l'utilisateur</label>
                            <input type="text" class="form-control" id="nomUser" name="nomUser">
                        </div>
                        <button type="submit" name="idUtilisateur" value="<?=$_GET["idUtilisateur"];?>" class="btn btn-primary">Rechercher</button>
                    </form>
                    
                    <?php
                    if(!empty($_GET["nomUser"]) && !empty($_GET["idUtilisateur"]))
                    {
                        $objetUser = new User();
                        $users = $objetUser -> rechercheNom($_GET["nomUser"]);
                        
                        ?>
                        <hr>
                        <?php
                        foreach($users as $user)
                        {
                            ?>
                            <ul class="list-group" style="width:75%; margin-left:11%;">
                                <li class="list-group-item">Nom : <?=$user["nom"];?>
                                <span style="float: right;">
                                    <form style="border:none; margin:0" method="post" action="../traitements/verifConversation.php">
                                        <input type="hidden" name="idEnvoyeur" value="<?=$_GET["idUtilisateur"];?>">
                                        <button class="btn btn-success" name="idReceveur" value="<?=$user["idUtilisateur"];?>">Envoyer un message</button>
                                    </form>
                                </span>
                                </li>
                            </ul>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        
            /* Affichage des conversations disponible / créer */
            $objetConversation = new Conversation();
            $conversations = $objetConversation -> conversation($_SESSION["idUtilisateur"]);
            
            ?>
            <h5 style="text-align: center;">Conversation déjà en cours</h5>
                <h6>Vous avez </h6>
            <div class="div_messagerie">
                
                <?php
                foreach($conversations as $conversation)
                {
                    ?>
                    
                        <div class="card col-12 col-lg-4 col-md-6 text-center">
                            <div class="card-body">
                                <?php
                                    $objetUser = new User();
                                
                                    if($_GET["idUtilisateur"] == $conversation["idEnvoyeur"])
                                    {
                                        $noms = $objetUser -> selectNom($conversation["idReceveur"]);
                                        ?>
                                        <h5 class="card-title"><?=$noms["nom"]?> <?=$noms["prenom"]?></h5>
                                        <a class="btn btn-success" href="conversation.php?idReceveur=<?=$conversation["idReceveur"];?>&idConversation=<?=$conversation["idConversation"];?>">Afficher la conversation</a>
                                        <?php
                                    }
                                    else
                                    {
                                        $noms = $objetUser -> selectNom($conversation["idEnvoyeur"]);
                                        ?>
                                        <h5 class="card-title"><?=$noms["nom"]?> <?=$noms["prenom"]?></h5>
                                        <a class="btn btn-success" href="conversation.php?idReceveur=<?=$conversation["idEnvoyeur"];?>&idConversation=<?=$conversation["idConversation"];?>">Afficher la conversation</a>
                                        <?php
                                    }
                                    
                                ?>
                            </div>
                        </div>
                            
                    <?php
                }
                ?>
            </div>
        </div>
        
        <?php
    }
    else
    {
        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
    }
}
?>
<script>
    function contactProf()
    {
        if(document.getElementById("contactProf").style.display == "none")
        {
            document.getElementById("contactProf").style.display = "block";
        }
        else
        {
            document.getElementById("contactProf").style.display = "none";

        }
    }
</script>
<?php
require_once "footer.php";