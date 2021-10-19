<?php
require_once "../modeles/modeles.php";
require_once "../affichages/fonctionAffichageProf.php";
require_once "../affichages/affichageEleve.php";


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../Affichages/style.css">
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</head>
<!-- Bandeau accueil -->
<nav class="navbar navbar-expand-md navbar-light" style="background-color : rgb(109, 19, 121);">
    <a class="navbar-brand" id="lien" href="index.php"  style="font-size:1.4em; font-weight : bold; color : white;">Estudia</a>
    <?php
    if(!empty($_SESSION["identifiant"]))
    {
      ?>
      <h2><?=$_SESSION["nom"]." ".$_SESSION["prenom"];?></h2>
      <a class="btn btn-primary" style="margin-left:60%" href="../traitements/deconnexion.php">Deconnexion</a>
      <?php
   }
   ?>
</nav>

<nav class="navbar navbar-expand-md navbar-light" style="max-height:10% ; background-color : #C0BEBE;">

    <button class="navbar-toggler" style="background-color : white" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        
      <?php
      
      if(!empty($_SESSION))
      {
        ?>
        <!-- <li class="nav-item">
            <a class="btn" id="lien" href="edt.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">Emploi du temps</a>
        </li> -->
        <li class="nav-item">
              <a class="btn" id="lien" href="messagerie.php?idUtilisateur=<?=$_SESSION["idUtilisateur"];?>"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">Messagerie</a>
          </li>
        <?php
        if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Professeur")
        {
          ?>
              <!-- Lien Professeur -->
            <li class="nav-item">
              <a class="btn" id="lien" href="listeEleve.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">listeEleve</a>
            </li>
            
            <li class="nav-item">
              <a class="btn" id="lien" href="prof.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">Prof</a>
            </li>
            <li class="nav-item">
              <a class="btn" id="lien" href="modifClasse.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">liste Classe</a>
            </li> 

          <?php
        }
        if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
        {
          
          ?>
            <!-- Lien Admin -->

            <li class="nav-item">
              <a class="btn" id="lien" href="formulaireInscription.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">Inscription</a>
            </li>

            <li class="nav-item">
              <a class="btn" id="lien" href="listeEnseignant.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">liste Enseignants</a>
            </li>

            <li class="nav-item">
              <a class="btn" id="lien" href="modifClasse.php"  style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">liste Classe</a>
            </li>  
          <?php
        }
        if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Etudiant")
        {
          
          ?>
          <!-- Lien Eleve -->
          
          <li class="nav-item">
              <a class="btn" id="Profil" href="infoUtilisateur.php?id=<?=$_SESSION["idUtilisateur"];?>" style="border-radius:0; border-right: solid 1px white;font-size:1.1em; font-weight : bold; color : white;">Profil</a>
          </li>
          <?php 
        }
      }
      
      ?>
      </ul>
    </div>
</nav>

<div class="container" style="border-radius:5%; max-width:100%">