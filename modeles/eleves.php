<?php
class Eleves extends Modele
{
    private $nom;
    private $prenom;
    private $idUtilisateur;
    private $Filiere;
    private $idEtude;
    private $notes = [];
    private $matieres = [];

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
            $this -> Filiere = new Filiere();
            $this -> idEtude = $eleve["idEtude"];

            $requete = $this -> getBdd() -> prepare("SELECT * FROM notes WHERE idUtilisateur = ?");
            $requete -> execute([$idUtilisateur]);
            $allNotes = $requete -> fetchAll(PDO::FETCH_ASSOC);
            foreach($allNotes as $notes)
            {
                $this -> notes[] = new Notes($notes["idNote"]);
            }
        }
    }
    public function ajouterEleve($nom, $prenom, $identifiant)
        {
        $requete = $this -> getBdd() -> prepare("SELECT idUtilisateur FROM utilisateur WHERE identifiant = ?");
        $requete -> execute([$identifiant]);
        $idUtilisateur = $requete -> fetch(PDO::FETCH_ASSOC);
        try{
            $requete = $this -> getBdd() -> prepare("INSERT INTO eleve (nom, prenom, idUtilisateur) VALUES (?, ?, ?)");
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

    public function modifClasse($idEtude, $idUtilisateur)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("UPDATE eleve SET idEtude = ? WHERE idUtilisateur = ?");
            $requete -> execute([$idEtude, $idUtilisateur]);
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }

    public function affichageEleve($idEleve)
    {
        $requete = getBdd() -> prepare("SELECT eleve.nom AS nom, etudes.nom AS titre, etudes.classe, prenom, idUtilisateur FROM eleve LEFT JOIN etudes USING(idEtude) WHERE idUtilisateur = ?");
        $requete -> execute([$idEleve]);
        $eleve = $requete -> fetch(PDO::FETCH_ASSOC); 

        return $eleve;
    }
    public function listeEleves()
    {
        $requete = getBdd() -> prepare("SELECT eleve.nom AS nom, etudes.nom AS titre, etudes.classe, prenom, idUtilisateur FROM eleve LEFT JOIN etudes USING(idEtude) ORDER BY eleve.nom ASC ");
        $requete -> execute();
        $eleves = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $eleves;
    }

    /* GET */
    public function getNom()
    {
        return $this -> nom;
    }
    public function getPrenom()
    {
        return $this -> prenom;
    }
    public function getIdUtilisateur()
    {
        return $this -> idUtilisateur;
    }
    public function getFiliere()
    {
        return $this -> Filiere;
    }
    public function getIdEtude()
    {
        return $this -> idEtude;
    }
    public function getNotes()
    {
        return $this -> notes;
    }
    public function getMatiere()
    {
        return $this -> matiere;
    }

    /* SET */
    public function setNom($nom)
    {
        $this -> nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $this -> prenom = $prenom;
    }
    public function setIdUtilisateur($idUtilisateur)
    {
        $this -> idUtilisateur = $idUtilisateur;
    }
    public function setFiliere($Filiere)
    {
        $this -> Filiere = $Filiere;
    }
    public function setNotes($notes)
    {
        $this -> notes = $notes;
    }
    public function setMatiere($matiere)
    {
        $this -> matiere = $matiere;
    }
}