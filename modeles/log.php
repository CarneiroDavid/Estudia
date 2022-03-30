<?php

class Log extends Modele
{
    private $idLog;
    private $idUtilisateur;
    private $date;
    private $ip;

    public function __construct($idLog = null)
    {
        if($idLog != null)
        {
            $requete = $this ->getBdd() -> prepare("SELECT * FROM logs WHERE idLog = ?");
            $requete -> execute([$idLog]);
            $logs = $requete -> fetch(PDO::FETCH_ASSOC);

            $this -> idLog = $logs["idLog"];
            $this -> idUtilisateur = $logs["idUtilisateur"];
            $this -> date = $logs["date"];
            $this -> ip = $logs["ip"];
        }
    }

    public function insertionLog($idUser, $ip)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO logs (idUtilisateur, date, ip) VALUES (?, NOW(), ?)");
            $requete -> execute([$idUser, $ip]);
            return true;
        }
        catch(Exception $e)
        {
            return $e -> getMessage();
        }
        
    }
}