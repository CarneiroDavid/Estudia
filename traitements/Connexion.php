<?php
require_once "../modeles/modeles.php";

$utilisateur = new User();
$objetLogs = new Log();

if(empty($_COOKIE["cookie-id"]) && empty($_COOKIE["cookie-token"]))
{
    if(isset($_POST["bouton"]) && !empty($_POST["bouton"]) && $_POST["bouton"] == 1)
    {
        if(!empty($_POST["identifiant"]) && !empty($_POST["mdp"]))
        {
            if($_POST["mdp"] >= 0)
            {
                $verifConnexion = $utilisateur -> verifMdp($_POST["identifiant"], $_POST["mdp"]);
                if($verifConnexion === true)
                {                   
                    if($utilisateur -> connexion($_POST["identifiant"], $_POST["mdp"]) === true)
                    {
                        $ip = $objetLogs -> insertionLog($_SESSION["idUtilisateur"], $_SERVER["REMOTE_ADDR"]);
                        if($_SESSION["statut"] == "Administration")
                        {
                            $objetLog = new ipAdmin();
                            $ipAdmin = $objetLog -> recupIpAdmin($_SESSION["ip"]);
                            if($ipAdmin != true)
                            {
                                session_destroy();
                                header("location:../traitements/deconnexion.php");
                            }
                            
                        }

                        if(!empty($_COOKIE["accept-cookie"]))
                        {
                            if(isset($_POST["cookie-connection"]))
                            {
                                if($utilisateur->generate_token_connection($utilisateur->getIdUser())){
                                    //("location:../pages/index.php?succes=Connexion");
                                }else{
                                    
                                }
                            }else{
                                //("location:../pages/index.php?succes=Connexion");
                            }
                        }  
                        //("location:../pages/premiereConnexion.php");                      
                    }
                    else
                    {
                        //("location:../pages/index.php?error=Connexion");
                    }
                }
                else
                {
                    //("$verifConnexion");
                }
            }
            else
            {
                //("location:../pages/index.php?error=LoginFaux");
            } 
        }
        else
        {
            //("location:../pages/index.php?error=FormConnec");
        }
    }
    else
    {
        //("location:../pages/index.php?error=FormConnec");
    }
}else{

    if(!empty($_COOKIE["cookie-token"]))
    {
        
        if($utilisateur->connection_by_token($_COOKIE["cookie-token"]))
        {
            //("location:../pages/index.php?succes=AutoConnexion");
            
            
        }else{
            //("location:../pages/index.php?error=AutoConnexion");
        }
    }


}