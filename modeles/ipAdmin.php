<?php

class ipAdmin extends Modele
{
    private $idIpdAllowed;
    private $ip;

    public function __construct($idIpdAllowed = null)
    {
        if($idIpdAllowed != null)
        {
            $requete = $this ->getBdd() -> prepare("SELECT * FROM ipAdmin WHERE idIpAllowed = ?");
            $requete -> execute([$idIpdAllowed]);
            $ipAdmin = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> idIpdAllowed = $ipAdmin["idIpAllowed"];
            $this -> ip = $ipAdmin["ip"];   
        }
    }
    public function recupIpAdmin($ip)
    {
        $requete = $this ->getBdd() -> prepare("SELECT * FROM ipAdmin WHERE ip = ?");
        $requete -> execute([$ip]);
        if($requete -> rowCount() > 0)
        {
            return true;
        }       
        else
        {
            return false;
        } 
    }

    
}