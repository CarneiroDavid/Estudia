<?php
class MessVieSco extends Modele
{
    private $idPunition;
    private $idEleve;
    private $idUtilisateur;
    private $motif;
    private $date;
    private $punition;
    private $rapport;

    public function selectMess($idUtilisateur)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM punition WHERE idUtilisateur = ?");
        $requete -> execute([$idUtilisateur]);
        $allMess = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $allMess;
    }


    /* SET */
    public function setidPunition($idPunition)
    {
        $this -> idPunition = $idPunition;
    }
    public function setidEleve($idEleve)
    {
        $this -> idEleve = $idEleve;
    }
    public function setidUtilisateur($idUtilisateur)
    {
        $this -> idUtilisateur = $idUtilisateur;
    }
    public function setMotif($motif)
    {
        $this -> motif = $motif;
    }
    public function setDate($date)
    {
        $this -> date = $date;
    }
    public function setRapport($rapport)
    {
        $this -> rapport = $rapport;
    }

    /* GET */
    public function getidPunition()
    {
        return $this -> idPunition;
    }
    public function getidEleve()
    {
        return $this -> idEleve;
    }
    public function getidUtilisateur()
    {
        return $this -> idUtilisateur;
    }
    public function getMotif()
    {
        return $this -> motif;
    }
    public function getDate()
    {
        return $this -> date;
    }
    public function getRapport()
    {
        return $this -> rapport;
    }


}