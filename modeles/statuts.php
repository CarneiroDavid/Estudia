<?php

class Statut extends Modele
{
    private $idStatut;
    private $statut;
    
    // public function __construct()
    // {

    // }
    public function ListeStatut()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM statuts");
        $requete -> execute();
        $statuts = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $statuts;
    }
}
