<?php

function insertionDevoir($idEtude, $matiere, $titre, $info, $date)
{
    try{
        $requete = getBdd() -> prepare("INSERT INTO devoirs (idEtude, idMatiere, Titre, Info, laDate) VALUES (?, ?, ?, ?, ?)");
        $requete -> execute([$idEtude, $matiere, $titre, $info, $date]);
        return true;
    }catch (Exception $e)
    {
        return false;
    }
}