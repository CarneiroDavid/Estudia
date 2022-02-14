<?php
require_once "entete.php";

// $objet_eleve = new Eleves();
// $eleve = $objet_eleve-> affichageEleve($_SESSION["idUtilisateur"]);

// $objet_matiere = new Matieres();
// $matieres = $objet_matiere -> listeMatiere();

// $objet_classes = new Classes();
// $classes = $objet_classes -> allClasse();

$objet_notes = new Notes();
$notes = $objet_notes -> noteEleve($_SESSION["idUtilisateur"]);

$listenote = [];
$i = 0;

////////////////////// Organisation des Notes et affichage //////////////////////

foreach($notes as $note)
{
    $listenote[$note["matiere"]][$i]["notes"] = $note["Note"];
    $listenote[$note["matiere"]][$i]["designation"] = $note["designation"];
    $listenote[$note["matiere"]][$i]["idProf"] = $note["idProf"];
    $listenote[$note["matiere"]][$i]["idNote"] = $note["idNote"];
    $listenote[$note["matiere"]][$i]["noteMax"] = $note["NoteMax"];
    $listenote[$note["matiere"]][$i]["commentaire"] = $note["commentaire"];
    $i++;
}

?>

<div class="div_liste_note" style="border: 1px solid;">
    <div class="enteteNote">
        <h3> Notes de l'élève</h3>
    </div>
</div>