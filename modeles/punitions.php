<?php

Class Punition extends Modele {
    private $idPunition;
    private $idEleve;
    private $idUtilisateur;
    private $motif;
    private $date;
    private $punition;
   

    public function __construct($idPunition = null)
    {
        if(!empty($idPunition))
        {
            $requete = $this->getBdd() -> prepare("SELECT * FROM Punition Where idPunition = ?");
            $requete -> execute([$idPunition]);
            $punition = $requete->fetch(PDO::FETCH_ASSOC);
            $this-> idPunition = $punition["idPunition"];
            $this-> idEleve = $punition["idEleve"];
            $this-> idUtilisateur = $punition["idUtilisateur"];
            $this-> motif = $punition["motif"];
            $this-> date = $punition["ladate"];
            $this-> punition = $punition["punition"];
           
        }
    }

    public function punitionEleve($idEleve)
    {
        try{
            $requete = $this->getBdd() -> prepare("SELECT motif,punition,ladate,punition.idPunition,nom,prenom,statut,punition.idUtilisateur FROM punition INNER JOIN utilisateur USING(idUtilisateur) WHERE idEleve = ? ORDER BY ladate DESC");
            $requete -> execute([$idEleve]);
            $punitions = $requete -> fetchAll(PDO::FETCH_ASSOC);
            return $punitions;
        }
        catch(Exception $e){
            return $e->getMessage();
        }

    }
    
    public function insertionPunition($idEleve, $idUtilisateur, $motif, $punition , $date)
    {
        
        try
        {
            $requete = $this -> getBdd() -> prepare("INSERT INTO punition (idEleve, idUtilisateur, motif, ladate, punition) VALUES (?, ?, ?, ?, ?)");
            $requete -> execute([$idEleve, $idUtilisateur, $motif, $date, $punition]);
            return true;
        }
        catch(Exception $e)
        {
            return $e -> getMessage();        
        }
    }

    public function modificationPunition($idPunition, $motif, $date, $punition)
        {
            try
            {
                $requete = $this -> getBdd()-> prepare("UPDATE punition SET  motif = ? , ladate = ? , punition = ? WHERE idPunition = ? ");
                $requete -> execute([$motif, $date, $punition, $idPunition ]);
                return true;
            }catch(Exception $e){
                echo $e -> getMessage(); 
            }
        }

    public function suppressionPunition($id)
    {
        try
        {
            $requete = $this -> getBdd() -> prepare("DELETE FROM punition WHERE idPunition = ?");
            $requete -> execute([$id]);
            return true;        
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    public function verificationRapport($idEleve, $idUtilisateur, $idPunition)
    {
        if($_SESSION["statut"] == "Administration")
        {
            $requete = $this -> getBdd() -> prepare("SELECT idEleve, idPunition FROM punition WHERE idEleve = ?AND idPunition = ?");
            $requete -> execute([$idEleve, $idPunition]);
            $id = $requete -> fetch(PDO::FETCH_ASSOC);

            return $id;
           
        }
        else if($_SESSION["statut"] == "Professeur")
        {
            $requete = $this -> getBdd() -> prepare("SELECT idEleve, idUtilisateur, idPunition FROM punition WHERE idEleve = ? AND idUtilisateur = ? AND idPunition = ?");
            $requete -> execute([$idEleve, $idUtilisateur, $idPunition]);
            $id = $requete -> fetch(PDO::FETCH_ASSOC);

            return $id;
        }
        else
        {
            return false;
        }
    }



    
/////////////////// GET Variable ////////////////////////////
    public function getIdPunition()
    {
        return $this-> idPunition;
    }
    public function getidEleve()
    {
        return $this-> idEleve;
    }
    public function getidUtilisateur()
    {
        return $this -> idUtilisateur;
    }
    public function getmotif()
    {
        return $this-> motif;
    }
    public function getDate()
    {
        return $this-> date;
    }
    public function getPunition()
    {
        return $this-> punition;
    }

/////////////////// SET Variable ////////////////////////////
    public function setIdPunition($idPunition)
    {
        $this-> idPunition = $idPunition;
    }
    public function setidEleve($idEleve)
    {
        $this-> idEleve = $idEleve;
    }
    public function setidUtilisateur($idUtilisateur)
    {
        $this-> idUtilisateur = $idUtilisateur;
    }
    public function setmotif($motif)
    {
        $this-> motif = $motif;
    }
    public function setDate($Date)
    {
        $this-> date = $Date;
    }
    public function setPunition($punition)
    {
        $this-> punition = $punition;
    }

/////////////////////////////////////////////////////////////
}