<?php 

class Edt extends Modele
{
    private $idCours;
    private $idUtilisateur;
    private $idSalle;
    private $matiere;
    private $date;
    private $horaireDebut;
    private $horaireFin;
    private $groupe;

    function selectEDT($idEtude,$date)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idCours, edt.idUtilisateur, idSalle, idClasse, edt.matiere, date, horaireDebut, horaireFin, utilisateur.nom, utilisateur.prenom ,numero from edt INNER JOIN utilisateur on edt.idUtilisateur = utilisateur.idUtilisateur INNER JOIN salle using(idSalle) WHERE idClasse = ? AND date = ? ORDER BY horaireDebut");
        $requete->execute([$idEtude,$date]);
        $edt = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $edt;
    }
    
    /* SET */
    
    public function setMatiere($matiere)
    {
        $this -> matiere = $matiere;
    }

    /* GET */
    public function getMatiere()
    {
        return $this -> matiere;
    }
}