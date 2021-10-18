<?php
class Devoirs extends Modele
{
    private $idEtude;
    private $matiere;
    private $titre;
    private $info;
    private $date;


    public function __construct($idDevoir = null)
    {
        if(!empty($idDevoir))
        {
            $requete = $this -> getBdd() -> prepare("SELECT * FROM devoirs WHERE idDevoir = ? ");
            $requete ->execute([$idDevoir]);
            $devoirs = $requete -> fetch(PDO::FETCH_ASSOC);
            $this-> idEtude = $devoirs["idEtude"];
            $this-> matiere = $devoirs["idMatiere"];
            $this-> titre = $devoirs["Titre"];
            $this-> info = $devoirs["Info"];
            $this-> date = $devoirs["laDate"];

        }
    }
    
    public function insertionDevoir($idEtude, $matiere, $titre, $info, $date)
    {
        try{
            $requete = $this -> getBdd() -> prepare("INSERT INTO devoirs (idEtude, idMatiere, Titre, Info, laDate) VALUES (?, ?, ?, ?, ?)");
            $requete -> execute([$idEtude, $matiere, $titre, $info, $date]);
            return true;
        }catch (Exception $e)
        {
            return false;
        }
    }
    public function modificationDevoir($idDevoir, $idEtude, $matiere, $titre, $info, $date)
    {
        try
        {
            $requete = $this->getBdd()->prepare("UPDATE devoirs SET idEtude = ? , idMatiere = ? , Titre = ?, Info = ? , laDate = ? WHERE idDevoir = ?");
            $requete -> execute([$idEtude, $matiere, $titre, $info, $date, $idDevoir ]);
            return true;
        }catch(Exception $e){
            return $e -> getMessage(); 
        }
    }


    public function suppressionDevoir()
    {

    }


     
/////////////////// GET Variable ////////////////////////////
    public function getIdDevoir()
    {
        return $this-> idDevoir;
    }
    public function getidEtude()
    {
        return $this-> idEtude;
    }
    public function getmatiere()
    {
        return $this-> matiere;
    }
    public function getTitre()
    {
        return $this -> titre;
    }
    public function getInfo()
    {
        return $this -> info;
    }
    public function getDate()
    {
        return $this-> date;
    }
/////////////////////////////////////////////////////////////
/////////////////// SET Variable ////////////////////////////
    public function setIdDevoir($idDevoir)
    {
        $this-> idDevoir = $idDevoir;
    }
    public function setidEtude($idEtude)
    {
        $this-> idEtude = $idEtude;
    }
    public function setmatiere($matiere)
    {
        $this-> matiere = $matiere;
    }
    public function setTitre($titre)
    {
        $this-> titre = $titre;
    }
    public function setInfo($info)
    {
        $this-> info = $info;
    }
    public function setDate($date)
    {
        $this-> date = $date;
    }
/////////////////////////////////////////////////////////////
}