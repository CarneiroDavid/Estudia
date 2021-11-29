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
        $requete = $this -> getBdd() -> prepare("SELECT idCours, idUtilisateur, idSalle, idClasse, edt.matiere, date, horaireDebut, horaireFin, enseignants.Nom, numero from edt LEFT JOIN enseignants using(idUtilisateur) INNER JOIN salle using(idSalle) WHERE idClasse = ? AND date = ?");
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