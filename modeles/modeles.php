<?php
session_start();

class Modele
{
    public function getBdd()
    {
        return new PDO('mysql:host=localhost;dbname=estudia2;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // return new PDO('mysql:host=ipssisqestudia.mysql.db;dbname=ipssisqestudia;charset=UTF8', 'ipssisqestudia', 'Ipssi2022estudia',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

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
function getShift($day){
    if($day  == 'Mon'){
        return 0;
    }else if($day  == 'Tue'){
        return -1;
    }else if($day  == 'Wed'){
        return -2;
    }else if($day  == 'Thu'){
        return -3;
    }else if($day  == 'Fri'){
        return -4;
    }else if($day  == 'Sat'){
        return -5;
    }else if($day  == 'Sun'){
        return -6;
    }
}
require_once "classes.php";
require_once "eleves.php";
require_once "enseignants.php";
require_once "filiere.php";
require_once "matieres.php";
require_once "note.php";
require_once "statuts.php";
require_once "users.php";
require_once "devoir.php";
require_once "conversations.php";
require_once "messages.php";
require_once "messVieSco.php";
require_once "punitions.php";
require_once "edts.php";
require_once "absence.php";
require_once "presence.php";
require_once "retard.php";
require_once "examen.php";
require_once "log.php";
require_once "ipAdmin.php";

?>