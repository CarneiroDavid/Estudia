<?php
require_once "entete.php";
// $requete = getBdd() -> prepare("SELECT nom, prenom, idUtilisateur FROM eleve WHERE idUtilisateur = ?");
// $requete -> execute([$_GET["idUtilisateur"]]);
// $eleves = $requete -> fetch(PDO::FETCH_ASSOC);
// print_r($eleves);

// $requete = getBdd() -> prepare("SELECT matiere, idMatiere FROM matieres");
// $requete -> execute();
// $matieres = $requete -> fetchAll(PDO::FETCH_ASSOC);
// print_r($matieres);

if(!empty($_SESSION["statut"]) && $_SESSION["statut"] == "Etudiant")
{
    if($_GET["idUtilisateur"] == $_SESSION["idUtilisateur"])
    {
        $objetNote = new Notes();
        $notesEleve = $objetNote -> noteEleve($_SESSION["idUtilisateur"]);
        ?>
        <pre>
            <?php
                // print_r($notesEleve);

            ?>
        </pre>
        
        
        <br>
        <?php
        affichageNote($_SESSION["idUtilisateur"]);
    }
    else
    {
        header("location:index.php");
    }
}
?>
    
<?php
require_once "footer.php";
?>