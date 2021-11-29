<?php
session_start();

class Modele
{
    public function getBdd()
    {
        return new PDO('mysql:host=localhost;dbname=estudia;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function randomId($nom, $prenom)
    {
        $identifiant = substr($prenom,0 , -strlen($prenom)+1);
        $code = substr(str_shuffle(str_repeat($x='0123456789', ceil(2/strlen($x)) )),1,2);
        $identifiant = $identifiant.$nom.$code;
        return $identifiant;
    }
    public function randomMdp($length = 8) 
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}

require_once "classes.php";
require_once "eleves.php";
require_once "enseignants.php";
require_once "filiere.php";
require_once "matieres.php";
require_once "notes.php";
require_once "statuts.php";
require_once "users.php";
require_once "devoirs.php";
require_once "conversations.php";
require_once "messages.php";
require_once "messVieSco.php";
require_once "punitions.php";
require_once "edt.php";
require_once "absence.php";
require_once "presence.php";
require_once "retard.php";
require_once "examen.php";
?>