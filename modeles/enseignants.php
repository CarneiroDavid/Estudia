<?php

class Enseignant extends Modele
{
    private $idEnseignant;
    private $nom;
    private $prenom;
    private $idUtilisateur;
    private $idFiliere;
    private $idMatiere;
    private $matiere;
    private $devoirs = [];
    private $examens = [];

    public function __construct($idUtilisateur = null)
    {
        if(!empty($idUtilisateur))
        {
            $requete = $this -> getBdd() -> prepare("SELECT idEnseignant, Nom, Prenom,idUtilisateur, idFiliere, idMatiere, matiere FROM enseignants WHERE idUtilisateur = ?");
            $requete -> execute([$idUtilisateur]);
            $info = $requete ->fetch(PDO::FETCH_ASSOC);

            $this -> idEnseignant = $info["idEnseignant"];
            $this -> nom = $info["Nom"];
            $this -> prenom = $info["Prenom"];
            $this -> idUtilisateur = $info["idUtilisateur"];
            $this -> idFiliere = $info["idFiliere"];
            $this -> idMatiere = $info["idMatiere"];
            $this -> matiere = $info["matiere"];

            $requete = $this -> getBdd() -> prepare("SELECT * FROM devoirs WHERE idProf = ?");
            $requete -> execute([$idUtilisateur]);
            $devoirs = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($devoirs as $devoir)
            {
                $this -> devoirs[] = new Devoir($devoir["idDevoir"]);
            }

            $requete = $this -> getBdd() -> prepare("SELECT * FROM examen WHERE idProf = ?");
            $requete -> execute([$idUtilisateur]);
            $examens = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($examens as $examen)
            {
                $this -> examens[] = new Examen($examen["idExamen"]);
            }
        }
    }
    public function infoEnseignant($idEnseignant)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM enseignants  WHERE idUtilisateur = ? ");
        $requete -> execute([$idEnseignant]);
        $enseignant = $requete -> fetch(PDO::FETCH_ASSOC);
        return $enseignant;
    }
    public function listeEnseignants()
    {
        $requete = $this->getBdd() -> prepare("SELECT *  FROM enseignants  ORDER BY Nom ASC ");
        $requete -> execute();
        $enseignants = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $enseignants;
    }
    
    public function ajouter($identifiant)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idUtilisateur, nom, prenom FROM utilisateur WHERE identifiant = ?");
        $requete -> execute([$identifiant]);
        $idUtilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
        try{
            $requete = $this -> getBdd() -> prepare("INSERT INTO enseignants (nom, prenom, idUtilisateur) VALUES (?, ?, ?)");
            $requete -> execute([$idUtilisateur["nom"], $idUtilisateur["prenom"], $idUtilisateur["idUtilisateur"]]);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
    public function modifMatiere($idUtilisateur,$matiere)
    {
        try{
            $requete = $this -> getBdd()->prepare("UPDATE enseignants SET matiere = ? WHERE idUtilisateur = ?");
            $requete->execute([$matiere,$idUtilisateur]);
            return "success";
        }
        catch(Exception $e)
        {
            return $e;
        }
    }
    public function verifProf($id)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idUtilisateur FROM enseignants WHERE idUtilisateur = ?");
        $requete -> execute([$id]);
        
        if($requete -> rowCount() === 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /* SET */
    public function setIdUEnseignant($idEnseignant)
    {
        $this -> idUtilisateur = $idEnseignant;
    }
    public function setIdUtilisateur($idUtilisateur)
    {
        $this -> idUtilisateur = $idUtilisateur;
    }
    public function setNom($nom)
    {
        $this -> nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $this -> prenom = $prenom;
    }
    public function setIdFiliere($idFiliere)
    {
        $this -> idFiliere = $idFiliere;
    }
    public function setIdMatiere($idMatiere)
    {
        $this -> idFiliere = $idMatiere;
    }
    public function setMatiere($matiere)
    {
        $this -> matiere = $matiere;
    }

    /* GET */
    public function getIdEnseignant()
    {
        return $this -> idEnseignant;
    }
    public function getIdUtilisateur()
    {
        return $this -> idUtilisateur;
    }
    public function getNom()
    {
        return $this -> nom;
    }
    public function getPrenom()
    {
        return $this -> prenom;
    }
    public function getIdFiliere()
    {
        return $this -> idFiliere;
    }
    public function getIdMatiere()
    {
        return $this -> idMatiere;
    }
    public function getMatiere()
    {
        return $this -> matiere;
    }

}