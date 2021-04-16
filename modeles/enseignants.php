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
}

function ajouterProf($nom, $prenom, $identifiant)
{
    $requete = getBdd() -> prepare("SELECT idUtilisateur FROM utilisateur WHERE identifiant = ?");
    $requete -> execute([$identifiant]);
    $idUtilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
    try{
        $requete = getBdd() -> prepare("INSERT INTO enseignants (nom, prenom, idUtilisateur) VALUES (?, ?, ?)");
        $requete -> execute([$nom, $prenom, $idUtilisateur["idUtilisateur"]]);
        return true;
    }catch(Exception $e)
    {
        return false;
    }
}

function modifMatiere($idUtilisateur,$matiere)
{
    try{
    $requete = getBdd()->prepare("UPDATE enseignants SET matiere = ? WHERE idUtilisateur = ?");
    $requete->execute([$matiere,$idUtilisateur]);
    return "success";
    }catch(Exception $e){
        return $e;
    }
}