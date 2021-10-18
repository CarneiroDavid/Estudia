<?php

class Conversation extends Modele
{
    private $idConversation;
    private $idEnvoyeur;
    private $idReceveur;

    public function __construct()
    {
        
    }

    public function insertConversation($idEnvoyeur, $idReceveur)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO conversations (idEnvoyeur, idReceveur) VALUES (?, ?)");
            $requete -> execute([$idEnvoyeur, $idReceveur]);
            return true;
        }
        catch(Exception $e)
        {

        }
    }

    public function verifConv($idEnvoyeur, $idReceveur)
    {
        $requete = $this -> getBdd() -> prepare("SELECT * FROM conversations WHERE idEnvoyeur = ? && idReceveur = ?");
        $requete -> execute([$idEnvoyeur, $idReceveur]);
        $conv = $requete ->fetch(PDO::FETCH_ASSOC);
        return $conv;
        // return $conv;

    }

    public function conversation($idEnvoyeur)
    {
        $requete = $this-> getBdd() -> prepare("SELECT idConversation, idEnvoyeur, idReceveur FROM conversations WHERE idEnvoyeur = ? || idReceveur = ?");
        $requete -> execute([$idEnvoyeur, $idEnvoyeur]);
        $conversations = $requete -> fetchAll(PDO::FETCH_ASSOC);
        return $conversations;
    }

    /* SET */
    public function setIdConversation($idConversation)
    {
        $this -> idConversation = $idConversation;
    }
    public function setIdEnvoyeur($IdEnvoyeur)
    {
        $this -> IdEnvoyeur = $IdEnvoyeur;
    }
    public function setIdReceveur($IdReceveur)
    {
        $this -> IdReceveur = $IdReceveur;
    }

    /* GET */
    public function getIdConversation()
    {
        return $this -> idConversation;
    }
    public function getIdEnvoyeur()
    {
        return $this -> idEnvoyeur;
    }
    public function getIdReceveur()
    {
        return $this -> idReceveur;
    }
}
