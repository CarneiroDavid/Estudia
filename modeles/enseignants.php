<?php

class Enseignant extends Modele
{
    private $idUtilisateur;
    private $nom;
    private $prenom;
    private $idFiliere;
    private $matiere;

    public function __construct()
    {
        
    }
    public function setEnseignant($idUser = null)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM enseignants WHERE idUtilisateur = ?");
        $requete -> execute([$idUser]);
        // $requete -> execute([$idUser]);
        $enseignant = $requete -> fetch(PDO::FETCH_ASSOC);

        $this -> idUtilisateur = $idUser;
        $this -> nom = $enseignant["Nom"];
        $this -> prenom = $enseignant["Prenom"];
        $this -> idFiliere = $enseignant["idFiliere"];
        $this -> matiere = $enseignant["matiere"];
    }
    public function ajouterProf($identifiant)
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
}