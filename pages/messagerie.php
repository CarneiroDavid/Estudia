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
            <div class="alert alert-danger text-center">
            <?php
            
            switch($_GET["error"])
            {
                case "vide":
                    echo "Une erreur est survenue, veuillez réessayer.";
                    break;
                case "fauxContact":
                    echo "La personne que vous essayer de joindre n'existe pas.";
                    break;
                case "convCreer":
                    echo "La conversation avec cet utilisateur existe déjà.";
                    break;
                case "conv":
                    echo "Un problème est survenue lors de la création de la conversation.";
                    break;
                case "convInexistante" :
                    echo "Une erreur lors de l'envoie est survenue lors de la selection de conversation, veuillez réessayer.";
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
                
                <button class="affichage-deroulant_liste_messagerie" onclick="contactProf()" class="card-header">
                    Contacter un utilisateur ▼
                </button>

                <div class="card-body" id="mess">
                    <form action="messagerie.php?idUtilisateur=<?=$_GET["idUtilisateur"];?>" method="get" >
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nom de l'utilisateur</label>
                            <input type="text" class="form-control" id="nomUser" name="nomUser">
                        </div>
                        <button type="submit" name="idUtilisateur" value="<?=$_GET["idUtilisateur"];?>" class="btn">Rechercher</button>
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
                            <ul class="list-group" id="list-personne-messagerie">
                                <li class="list-group-item"><?=$user["nom"] . " " . $user["prenom"];?> 
                                <span class="boutonMessage">
                                    <form class="formulaire"  method="post" action="../traitements/verifConversation.php">
                                        <input type="hidden" name="idEnvoyeur" value="<?=$_GET["idUtilisateur"];?>">
                                        <button class="btn" name="idReceveur" value="<?=$user["idUtilisateur"];?>">Envoyer un message</button>
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
            <hr>
            <h5 class="text-center">Conversation déjà en cours</h5>
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
                                    <a class="btn" href="conversation.php?idReceveur=<?=$conversation["idReceveur"];?>&idConversation=<?=$conversation["idConversation"];?>">Afficher la conversation</a>
                                    <?php
                                }
                                else
                                {
                                    $noms = $objetUser -> selectNom($conversation["idEnvoyeur"]);
                                    ?>
                                    <h5 class="card-title"><?=$noms["nom"]?> <?=$noms["prenom"]?></h5>
                                    <a class="btn" href="conversation.php?idReceveur=<?=$conversation["idEnvoyeur"];?>&idConversation=<?=$conversation["idConversation"];?>">Afficher la conversation</a>
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
}else{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
?>
<script>
    function contactProf()
    {
        if(document.getElementById("mess").style.display == "none")
        {
            document.getElementById("mess").style.display = "block";
        }
        else
        {
            document.getElementById("mess").style.display = "none";

        }
    }
</script>
<?php
require_once "footer.php";