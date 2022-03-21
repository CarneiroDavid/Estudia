<?php
require_once "entete.php";
// $objetEleve = new Eleves();
// $eleves = $objetEleve -> listeEleves();

// $objetClasse = new Classes();
// $classes = $objetClasse -> allClasse();

?>
<!-- <h3 id="titre">Fiche d'appel</h3> -->
<?php
if($_SESSION["statut"] == "Professeur" || $_SESSION["statut"] == "Administration")
{
    ?>

    <h2>Définitions</h2>
    <p><b>Client :</b> tout professionnel ou personne physique capable au sens des articles 1123 et suivants du Code civil, ou personne morale, qui visite le Site objet des présentes conditions générales.<br>
    <b>Prestations et Services :</b> <a href="https://Estudia.fr">https://Estudia.fr</a> met à disposition des Clients :</p>

    <p><b>Contenu :</b> Ensemble des éléments constituants l’information présente sur le Site, notamment textes – images – vidéos.</p>

    <p><b>Informations clients :</b> Ci après dénommé « Information (s) » qui correspondent à l’ensemble des données personnelles susceptibles d’être détenues par <a href="https://Estudia.fr">https://Estudia.fr</a> pour la gestion de votre compte, de la gestion de la relation client et à des fins d’analyses et de statistiques.</p>


    <p><b>Utilisateur :</b> Internaute se connectant, utilisant le site susnommé.</p>
    <p><b>Informations personnelles :</b> « Les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).</p>
    <p>Les termes « données à caractère personnel », « personne concernée », « sous traitant » et « données sensibles » ont le sens défini par le Règlement Général sur la Protection des Données (RGPD : n° 2016-679)</p>

    <h2>1. Présentation du site internet.</h2>
    <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site internet <a href="https://Estudia.fr">https://Estudia.fr</a> l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi:
    </p><p><strong>Propriétaire</strong> :  SARL WeDev   – 270 rue Nationale 78140 Vélizy<br>
                    
    <strong>Responsable publication</strong> : Carneiro David – 0615151515<br>
    Le responsable publication est une personne physique ou une personne morale.<br>
    <strong>Webmaster</strong> : Carneiro David – 0615151515<br>
    <strong>Hébergeur</strong> : ovh – 2 rue Kellermann 59100 Roubaix 1007<br>
    <strong>Délégué à la protection des données</strong> : Carneiro David – Estudia@gmail.com<br>
    </p>
    <?php
}else
{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
require_once "footer.php";