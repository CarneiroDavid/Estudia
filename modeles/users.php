<?php

class Users extends Modele
{
    private  $idUtilisateur;
    private $email;
    private $identifiant;
    private $nom;
    private $prenom;
    private $dateNaiss;
    private $mdp;
    private $mdpTemp;
    private $statut;

    public function __construct($idUser = null)
    {
        if(!empty($idUser))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
            $requete -> execute([$idUser]);
            $infos = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> idUtilisateur = $infos["idUtilisateur"];
            $this -> email = $infos["email"];
            $this -> identifiant = $infos["identifiant"];
            $this -> nom = $infos["nom"];
            $this -> prenom = $infos["prenom"];
            $this -> dateNaiss = $infos["dateNaiss"];
            $this -> mdp = $infos["mdp"];
            $this -> mdpTemp = $infos["mdpTemp"];
            $this -> statut = $infos["statut"];
        }
    }

    public function getIdUser()
    {
        return $this -> idUtilisateur; 
    }
    public function getEmail()
    {
        return $this -> email; 
    }
    
    public function getId()
    {
        return $this -> identifiant; 
    }

    public function getNom()
    {
        return $this -> nom; 
    }

    public function getPrenom()
    {
        return $this -> prenom; 
    }

    public function getDateNaiss()
    {
        return $this -> dateNaiss; 
    }

    public function getStatut()
    {
        return $this -> statut; 
    }

    public function insertionUser($email, $nom, $prenom, $dateNaiss, $statut)
    {      
        $id = $this -> randomId($nom, $prenom);
        $mdp2 = $this -> randomMdp();
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
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
        else
        {
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
}