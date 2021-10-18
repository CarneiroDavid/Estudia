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

    public function recupMessage($idEnvoyeur)
    {
        $requete = $this -> getBdd() -> prepare("SELECT idEnvoyeur, idReceveur, message, date_envoie, heure_envoie FROM messages WHERE idEnvoyeur = ? || idReceveur = ?");
        $requete -> execute([$idEnvoyeur, $idEnvoyeur]);
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
}