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
    function selectEDT_Prof($idUtilisateur,$date)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idCours, edt.idUtilisateur, idSalle, idClasse, edt.matiere, date, horaireDebut, horaireFin, utilisateur.nom, utilisateur.prenom ,numero from edt INNER JOIN utilisateur on edt.idUtilisateur = utilisateur.idUtilisateur INNER JOIN salle using(idSalle) WHERE edt.idUtilisateur = ? AND date = ? ORDER BY horaireDebut");
        $requete->execute([$idUtilisateur,$date]);
        $edt = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $edt;
    }
    /* SET */
    function selectCours($idCours){
        try{
            $requete = $this -> getBdd() -> prepare("SELECT idCours, idClasse, etudes.classe, etudes.nom as classe2 ,edt.matiere, resumeCours ,date, horaireDebut, horaireFin, utilisateur.nom, utilisateur.prenom ,edt.idUtilisateur, numero , edt.appel from edt INNER JOIN utilisateur on edt.idUtilisateur = utilisateur.idUtilisateur INNER JOIN salle using(idSalle) INNER JOIN etudes on edt.idClasse = etudes.idEtude WHERE edt.idCours = ?");
            $requete->execute([$idCours]);
            $edt = $requete->fetch(PDO::FETCH_ASSOC);
            return $edt;
        }catch( Exception $e){
            return false;
        }
    }
    function postResume($idCours,$resume){
        try{
            $requete = $this -> getBdd() -> prepare("UPDATE edt SET resumeCours = ? WHERE idCours = ?");
            $requete->execute([$resume,$idCours]);
            return true;
        }catch(Exception $e){
            return false;
        }
    }
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