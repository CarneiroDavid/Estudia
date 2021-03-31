<?php
session_start();

function getBdd()
{
    return new PDO('mysql:host=localhost;dbname=estudia;charset=UTF8', 'root', '',  array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function randomId($nom, $prenom)
{
    $identifiant = substr($prenom,0 , -strlen($prenom)+1);
    $code = substr(str_shuffle(str_repeat($x='0123456789', ceil(2/strlen($x)) )),1,2);
    $identifiant = $identifiant.$nom.$code;
    return $identifiant;
}


function randomMdp($length = 8) 
{
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
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















?>