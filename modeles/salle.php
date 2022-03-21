<?php

class Salle extends Modele
{
    private $idSalle;
    private $numero;
    
    public function listeSalle()
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM salle");
        $requete -> execute();
        $salles = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $salles;
    }
    
    public function getNumero()
    {
        return $this -> numero;
    }

    public function setNumero($numero)
    {
        $this -> numero = $numero;

        return $this;
    }
}