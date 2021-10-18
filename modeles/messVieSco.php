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


}