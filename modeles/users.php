<?php



function connexion($id, $mdp)
{
    $erreurs = [];

    $requete = getBdd() -> prepare("SELECT idUtilisateur, email, identifiant, nom, prenom, mdp, statut FROM utilisateur WHERE identifiant = ?");
    $requete -> execute([$id]);

    if($requete -> rowCount() > 0)
    {
        $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
        $nom = $utilisateur["nom"];
         $prenom = $utilisateur["prenom"];

        if(!password_verify($mdp, $utilisateur["mdp"]))
        {
            $erreurs[] = "Le mot de passe saisie est incorrect"; 
        }
    }
    else
    {
        $erreurs[] = "L'identifiant n'existe pas";
    }
    // }

    if(count($erreurs) == 0)
    {
        $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
        $_SESSION["identifiant"] = $utilisateur["identifiant"];
        $_SESSION["statut"] = $utilisateur["statut"];
        $_SESSION["prenom"] = $prenom;
        $_SESSION["nom"] = $nom;
        $_SESSION["email"] = $utilisateur["email"];
        return true;
        // header("location:index.php");
    }
    else {
        ?>
        <div class="alert alert-danger">
            Erreur<?= (count($erreurs) > 1 ? "s" : "")?> :<br>
            <?php 
            foreach($erreurs as $erreur)
            {
                ?>
                <br><?= $erreur;?>
            <?php
            }
            ?>
        </div>
        <?php
    }
}


function insertionUser($email, $id, $nom, $prenom, $dateNaiss, $statut)
{   
    $mdp2 = randomMdp();
    $mdp = password_hash($mdp2, PASSWORD_BCRYPT);

    // try
    // {
        if(empty($email))
        {
            try{
            
            $sql = "INSERT INTO utilisateur (identifiant, nom, prenom, dateNaiss, mdp, mdpTemp, statut) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $requete = getBdd() -> prepare($sql);
            $requete -> execute([$id, $nom, $prenom, $dateNaiss, $mdp, $mdp2, $statut]);
            return true;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        else{
            
            try{
            $sql = "INSERT INTO utilisateur (email, identifiant, nom, prenom, dateNaiss, mdp, mdpTemp, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $requete = getBdd() -> prepare($sql);
            $requete -> execute([$email, $id, $nom, $prenom, $dateNaiss, $mdp, $mdp2, $statut]);
            return true;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        
        
        }
     }   
        ?>


    
