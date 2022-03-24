<?php
    require_once "entete.php";
if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Administration")
{
    // $statuts = ListeStatut();  
    if(!empty($_GET["error"]))
    {
        ?>
            <div class="alert alert-danger text-center">
                <?php
                switch($_GET["error"])
                {
                    case "FormulaireVide":
                        echo "Erreur, veuillez bien saisir toutes les informations";
                        break;
                    case "VarVide":
                        echo "Veuillez renseigner tous les champs nécéssaire";
                        break;
                    case "AdressMail":
                        echo "Problème adresse mail";
                        break;
                    case "StrlenVar" :
                        echo "Veuillez saisir un nom et un prenom valide";
                        break;
                    case "Inscription":
                        echo "Erreur d'inscription";
                        break;
                    case "InscriptionEleve":
                        echo "Une erreur est survenue lors de 'inscription de l'élève, veuillez réessayer";
                        break;
                }
                ?>
            </div>
        <?php
    }  

    if(!empty($_GET["succes"]))
    {
        ?>
            <div class="alert alert-success text-center">
        <?php
            echo "Inscription réussi";
        ?></div><?php
    }
    ?>



    <h2 class="text-center">Inscription</h2>
    <br>
    <div class="container-xxl">
    
    <form method="POST" id="formulaireIscription" action="../traitements/Inscription.php">
        
        <div class="form-group">
            <label for="mail">Adresse-mail</label>
            <input type="email" class="form-control" name="mail" id="mail" placeholder="Saisissez votre adresse mail" value="<?=isset($_POST["mail"]) ? $_POST["mail"] : ""?>"/>
        </div>
    
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" placeholder="Saisissez votre nom" value="<?=isset($_POST["nom"]) ? $_POST["nom"] : ""?>" />
        </div>
    
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Saisissez votre prenom" value="<?=isset($_POST["prenom"]) ? $_POST["prenom"] : ""?>" />
        </div>
    
        <div class="form-group">
            <label for="dateNaiss">Date de naissance</label>
            <input type="date" class="form-control" name="dateNaiss" id="dateNaiss" placeholder="Saisissez votre âge" value="<?=isset($_POST["dateNaiss"]) ? $_POST["dateNaiss"] : ""?>" />
        </div>
    
        <div class="form-group">
            <label for="statut">Statut</label>
            <select class="form-control" name="statut" id="statut" onChange="inputMat()" aria-label="Default select example">
            <?php 
            foreach($statuts as $statut)
            {
                if($statut["statut"] != "root")
                    {   
                        ?>
                        <option value="<?=$statut["statut"];?>" <?= ($statut["statut"] === "Etudiant" ? "selected" : "");?>>
                            <?=$statut["statut"];?>
                        </option>
                        <?php
                    }
            }
            ?>
            </select>
        </div>
    
        <div class="form-group" id="divMatiere" style="display:none;">
            <label for="matiere">Matiere</label>
            <input type="text" class="form-control" name="matiere" id="matiere"/>
        </div>
    
    
        <div class="form-group text-center"> 
            <button type="submit" name="envoiIns" value="1" class="btn btn-primary">Valider les informations</button>
        </div>
    </form>
    </div>
    
    <?php
}   
else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}

require_once "footer.php";
?>
