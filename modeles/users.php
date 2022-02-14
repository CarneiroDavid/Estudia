<?php

class User extends Modele
{
    public  $idUtilisateur;
    public $email;
    public $identifiant;
    public $nom;
    public $prenom;
    public $dateNaiss;
    public $mdp;
    public $mdpTemp;
    public $statut;

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
            

            if($infos["statut"] == "Professeur")
            {
                $this -> statut = new Enseignant();

            }
            if($infos["statut"] == "Etudiant")
            {
                $this -> statut = new Eleves();
            }
            // if($infos["statut"] == "Administration")
            // {
            //     $this -> statut = "Administration";
            // }

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
    public function verif_identifiant($id)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM utilisateur WHERE identifiant = ?");
        $requete -> execute([$id]);
        if($requete->rowCount() == 0){
            return true;
        }
        return false;
    }
    public function insertionUser($email, $nom, $prenom, $dateNaiss, $statut)
    {      
        $validation = 0;
        while($validation == 0){
            $id = $this -> randomId($nom, $prenom);
            
            if($this->verif_identifiant($id))
            {
                $validation++;
            }
            
        }
        

        $mdp2 = $this -> randomMdp();
        $mdp = password_hash($mdp2, PASSWORD_BCRYPT);

        $this -> email = $email;
        $this -> identifiant = $id;
        $this -> nom = $nom;
        $this -> prenom = $prenom;
        $this -> dateNaiss = $dateNaiss;
        $this -> mdp = $mdp;
        $this -> mdpTemp = $mdp2;
        if($statut == "Etudiant")
        {
            $this -> statut = new Eleves();
        }

        if($statut == "Professeur")
        {
            $this -> statut = new Enseignant();

        }
        if(empty($email))
        {
            try{
            
            $sql = "INSERT INTO utilisateur (identifiant, nom, prenom, dateNaiss, mdp, mdpTemp, statut) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $requete = $this -> getBdd() -> prepare($sql);
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
            $requete = $this -> getBdd() -> prepare($sql);
            $requete -> execute([$email, $id, $nom, $prenom, $dateNaiss, $mdp, $mdp2, $statut]);
            return true;
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    public function connexion($id)
    {
        $requete = $this ->getBdd() -> prepare("SELECT idUtilisateur, email, identifiant, utilisateur.nom, utilisateur.prenom, dateNaiss, mdp, statut, idEtude, PremiereConnexion FROM utilisateur LEFT JOIN eleve using(idUtilisateur) WHERE identifiant = ?");
        $requete -> execute([$id]);
        $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
        $nom = $utilisateur["nom"];
        $prenom = $utilisateur["prenom"];

        $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
        $_SESSION["identifiant"] = $utilisateur["identifiant"];
        $_SESSION["statut"] = $utilisateur["statut"];
        $_SESSION["prenom"] = $prenom;
        $_SESSION["nom"] = $nom;
        $_SESSION["email"] = $utilisateur["email"];
        $_SESSION["dateNaiss"] = $utilisateur["dateNaiss"];
        $_SESSION["idEtude"] = $utilisateur["idEtude"];
        $_SESSION["PremiereConnexion"] = $utilisateur["PremiereConnexion"];
        $this-> idUtilisateur = $utilisateur["idUtilisateur"];
        return true;
    }   

    public function verifMdp($id, $mdp)
    {
        $requete = $this -> getBdd() -> prepare("SELECT mdp FROM utilisateur WHERE identifiant = ?");
        $requete -> execute([$id]);

        if($requete -> rowCount() > 0)
        {
           $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
           if(password_verify($mdp, $utilisateur["mdp"]))
           {
                return true;
           }
           else 
           {
               return "location:../pages/index.php?error=FalseMdp";
           }
        }
        else
        {
            return "location:../pages/index.php?error=FalseId";
        }
    }

    public function rechercheNom($nom)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM utilisateur WHERE nom LIKE ?");
        $requete -> execute(['%'.$nom.'%']);
        $allUsers = $requete ->fetchAll(PDO::FETCH_ASSOC);
        return $allUsers;
    }

    public function selectNom($id)
    {
        
        $requete = $this -> getBdd() -> prepare("SELECT nom, prenom FROM utilisateur WHERE idUtilisateur = ?");
        $requete -> execute([$id]);
        $nom = $requete -> fetch(PDO::FETCH_ASSOC);
        return $nom;
    }
    public function generate_token_connection($idUser)
    {
        $token = $this->randomMdp(26);
        $cookie= $idUser.'-'.$token;
        setCookie("cookie-token", $cookie, time()+60*60*24*30, "/");
        try{
            $requete = $this -> getBdd() -> prepare("UPDATE utilisateur SET token = ? WHERE idUtilisateur = ?");
            $requete->execute([$token,$idUser]);
            
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
    public function connection_by_token($cookie)
    {
        $token = substr($cookie, -26, 26);
        $id = stristr($cookie, '-', true);
        try{
            $requete = $this -> getBdd() -> prepare("SELECT idUtilisateur, identifiant, statut, prenom, nom FROM utilisateur WHERE idUtilisateur = ? AND token = ?");
            $requete->execute([$id,$token]);
            if($requete->rowCount() == 1){
               
                $utilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
                $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
                $_SESSION["identifiant"] = $utilisateur["identifiant"];
                $_SESSION["statut"] = $utilisateur["statut"];
                $_SESSION["prenom"] = $utilisateur["prenom"];
                $_SESSION["nom"] = $utilisateur["nom"];

                return true;
            }else{
                return false;
            }
        }catch(Exception $e)
        {
            return false;
        }
    }
    public function premiere_connexion($idUtilisateur)
    {
        $requete = $this -> getBdd() -> prepare("SELECT PremiereConnexion FROM utilisateur WHERE idUtilisateur = ?");
        $requete -> execute([$idUtilisateur]);
        $info = $requete -> fetch(PDO::FETCH_ASSOC);
        return $info; 
    }
    public function accept_CGU($idUser)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("UPDATE utilisateur SET PremiereConnexion = true WHERE idUtilisateur = ?");
            $requete -> execute([$idUser]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }

    public function recupInfoUser($id)
    {
        $requete = $this -> getBdd() -> prepare("SELECT utilisateur.nom, utilisateur.prenom, dateNaiss, statut, idFiliere, classe, etudes.nom, idEtude FROM utilisateur INNER JOIN eleve USING(idUtilisateur) INNER JOIN etudes USING (idEtude) WHERE idUtilisateur = ?");
        $requete -> execute([$id]);
        $info = $requete -> fetch(PDO::FETCH_ASSOC);
        return $info;
    }
}