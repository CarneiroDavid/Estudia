<?php
class Message extends Modele
{
    private $idMessage;
    private $idEnvoyeur;
    private $idReceveur;
    private $message;
    private $date_envoie;
    private $heure_envoie;

    public function __construct()
    {

    }

    public function recupMessage($idEnvoyeur, $idReceveur)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idEnvoyeur, idReceveur, message, date_envoie, heure_envoie FROM messages WHERE idEnvoyeur = ? && idReceveur = ? OR idEnvoyeur = ? AND idReceveur = ? ORDER BY date_envoie ");
        $requete -> execute([$idEnvoyeur, $idReceveur, $idReceveur,$idEnvoyeur]);
        $messages = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }

    public function insertMessage($idConversation, $idEnvoyeur, $idReceveur, $message)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO messages (idConversation, idEnvoyeur, idReceveur, message, date_envoie, heure_envoie) VALUES (?, ?, ?, ?, NOW(), NOW())");
            $requete -> execute([$idConversation, $idEnvoyeur, $idReceveur, $message]);
            return true;
        }
        catch(Exception $e)
        {
            echo $e -> getMessage();
        }
    }
    public function verifConversation($idEnvoyeur, $idReceveur)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM conversations WHERE idEnvoyeur = ? && idReceveur = ?");
        $requete -> execute([$idEnvoyeur, $idReceveur]);
        $verifConv = $requete ->fetchAll(PDO::FETCH_ASSOC);
        return $verifConv;
    }

    /* SET */
    public function setIdMessage($idMessage)
    {
        $this -> idMessage = $idMessage;
    }
    public function setIdEnvoyeur($idEnvoyeur)
    {
        $this -> idEnvoyeur = $idEnvoyeur;
    }
    public function setIdReceveur($idReceveur)
    {
        $this -> idReceveur = $idReceveur;
    }
    public function setMessage($message)
    {
        $this -> message = $message;
    }
    public function setDateEnvoie($date_envoie)
    {
        $this -> date_envoie = $date_envoie;
    }
    public function setHeureEnvoie($heure_envoie)
    {
        $this -> heure_envoie = $heure_envoie;
    }

    /* GET */
    public function getIdMessage()
    {
        return $this -> idMessage;
    }
    public function getIdEnvoyeur()
    {
        return $this -> idEnvoyeur;
    }
    public function getIdReceveur()
    {
        return $this -> idReceveur;
    }
    public function getMessage()
    {
        return $this -> message;
    }
    public function getDateEnvoie()
    {
        return $this -> date_envoie;
    }
    public function getHeureEnvoie()
    {
        return $this -> heure_envoie;
    }
}