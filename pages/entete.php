<?php
require_once "../modeles/modeles.php";
require_once "../affichages/fonctionAffichageProf.php";
require_once "../affichages/affichageEleve.php";
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <?php    
        if(isset($_GET["cookie-accept"]) && !isset($_COOKIE["accept-cookie"])){
            setCookie("accept-cookie", 1, time()+60*60*24*30, "/");
            

        }?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecole</title>
        <link rel="stylesheet" href="../fichier/style.css">
        <link rel="shortcut icon" href="logo.png" type="image/x-icon">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="../fichier/main.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>   
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="../fichier/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet"> <!--load all styles -->
    </head>
    <body>
    <!-- Bandeau accueil -->
    <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" id="lien" href="index.php">Estudia</a>
        <?php
            if(!empty($_SESSION["identifiant"]))
            {
            ?>
            <h2><?=$_SESSION["nom"]." ".$_SESSION["prenom"];?></h2>
            <a class="btn btn-primary bouton-deconnexion" href="../traitements/deconnexion.php">Deconnexion</a>
            <?php
            }
        ?>
    </nav>
<?php
if(!empty($_SESSION))
{
    ?>
    <nav class="navbar navbar-expand-md navbar-light navbar-secondaire">
                
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link navbar-lien-index" id="lien" href="index.php"  >Accueil</a>
                </li>

                <?php
                    if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Professeur")
                    {
                        ?>
                        <!-- Lien Professeur -->
                        
                        <li class="nav-item">
                            <a class="nav-link navbar-lien"  href="edt.php" >Emploi du temps</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien" href="prof.php"  class="navbar-lien">Prof</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien"  href="appel.php"  class="navbar-lien">Fiche d'appel des classes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien"  href="noteProf.php"  class="navbar-lien">Note des eleves</a>
                        </li> 

                        <!-- <li class="nav-item">
                            <a class="btn nav-link" id="lien" href="devoirClasse.php"  class="navbar-lien">Devoir des classes</a>
                        </li> -->

                        <li class="nav-item">
                            <a class="nav-link navbar-lien" href="modifClasse.php"  class="navbar-lien">Information des élèves</a>
                        </li>  


                        <?php
                    }
                    if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
                    {
                        ?>
                        <!-- Lien Admin -->

                        <li class="nav-item">
                            <a class="nav-link navbar-lien" href="appel.php" >Fiche d'appel</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien" href="prof.php">Page professeur</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien"  href="modifClasse.php"  class="navbar-lien">Informations de l'élève</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien"  href="formulaireInscription.php"  class="navbar-lien">Inscription</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien"  href="listeEnseignant.php"  class="navbar-lien">liste Enseignants</a>
                        </li>
                        
                        <?php
                    }
                    if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Etudiant")
                    {
                        ?>
                        <!-- Lien Eleve -->

                        <li class="nav-item">
                            <a class="nav-link navbar-lien" href="edt.php">Emploi du temps</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-lien" id="VieScolaire" href="vieScolaire.php?id=<?=$_SESSION["idUtilisateur"];?>">Vie Scolaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navbar-lien" id="noteEleve" href="noteEleve.php<?=($_SESSION["statut"] == "Etudiant") ? "" : "?id=" . $_SESSION['idUtilisateur'];?>" >Notes</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="btn nav-link" id="noteEleve" href="devoirEleve.php<?=($_SESSION["statut"] == "Etudiant") ? "" : "?id=" . $_SESSION['idUtilisateur'];?>" class="navbar-lien">Devoir</a>
                        </li> -->
                        
                        <?php 
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link navbar-lien" href="messagerie.php?idUtilisateur=<?=$_SESSION["idUtilisateur"];?>" >Messagerie</a>
                </li>
                <li class="nav-item">
                    <!-- <a class="btn nav-link" id="Profil" href="profil.php?id=<?=$_SESSION["idUtilisateur"];?>" class="navbar-lien">Profil</a> -->
                </li>
            </ul>
        </div>
    </nav>
    <?php
}
?>
    

    <div id="body" class="container">