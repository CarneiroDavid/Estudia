<?php
class Eleves extends Modele
{
    private $nom;
    private $prenom;
    private $idUtilisateur;
    private $idFiliere;
    private $idEtude;

    public function __construct($idUtilisateur = null)
    {
        if(!empty($idUtilisateur))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM eleve WHERE idUtilisateur = ?");
            $requete -> execute([$idUtilisateur]);
            $eleve = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> nom = $eleve["nom"];
            $this -> prenom = $eleve["prenom"];
            $this -> idUtilisateur = $eleve["idUtilisateur"];
            $this -> idFiliere = $eleve["idFiliere"];
            $this -> idEtude = $eleve["idEtude"];

        }
    }
}





function ajouterEleve($nom, $prenom, $identifiant)
{
    $requete = getBdd() -> prepare("SELECT idUtilisateur FROM utilisateur WHERE identifiant = ?");
    $requete -> execute([$identifiant]);
    $idUtilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
    try{
        $requete = getBdd() -> prepare("INSERT INTO eleve (nom, prenom, idUtilisateur) VALUES (?, ?, ?)");
        $requete -> execute([$nom, $prenom, $idUtilisateur["idUtilisateur"]]);
    }catch(Exception $e)
    {
        ?>

        <div class="alert alert-danger mt-3">
            Erreur d'enregisrement.<br>
            <?= $e -> getMessage();?>
        </div>
        
        <?php
    }
}

function modifClasse($idEtude, $idUtilisateur)
{
    try
    {
        $requete = getBdd() -> prepare("UPDATE eleve SET idEtude = ? WHERE idUtilisateur = ?");
        $requete -> execute([$idEtude, $idUtilisateur]);
        return true;
    }
    catch(Exception $e)
    {
        return false;
    }
}