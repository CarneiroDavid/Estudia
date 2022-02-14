<?php 
require_once "../modeles/modeles.php";
print_r($_SESSION);
?>
<link rel="stylesheet" href="../fichier/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="../fichier/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet"> <!--load all styles -->

<?php
if(!empty($_SESSION) && $_SESSION["PremiereConnexion"] == 0)
{
    ?>
    <div>    
        <div class="card col-12", style="margin-top : 100px">
            <div class="card-body">
                <h4>Condition Générale d'utilisation</h4>
                <div>
                    <p>
                    Les présentes conditions générales d'utilisation (dites « CGU ») ont pour objet l'encadrement juridique des modalités de mise à disposition du site et des services par WeDev et de définir les conditions d’accès et d’utilisation des services par « l'Utilisateur ». Les présentes CGU sont accessibles sur le site à la rubrique «CGU».Toute inscription ou utilisation du site implique l'acceptation sans aucune réserve ni restriction des présentes CGU par l’utilisateur. Lors de l'inscription sur le site via le formulaire d’inscription, chaque
                    utilisateur accepte expressément les présentes CGU en cochant la case précédant le texte suivant : «
                    Je reconnais avoir lu et compris les CGU et je les accepte ».
                    En cas de non-acceptation des CGU stipulées dans le présent contrat, l'Utilisateur se doit de renoncer
                    à l'accès des services proposés par le site.
                    https://estudia.ipssi-sio.fr/pages/index.php se réserve le droit de modifier unilatéralement et à tout
                    moment le contenu des présentes CGU
                    </p>
                </div>
                <div>
                    <h4>Article 1 : Les mentions légales <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article1">
                    L’édition et la direction de la publication du site https://estudia.ipssi-sio.fr/pages/index.php est assurée
                    par David Carneiro, domicilié 25 rue du Chevalier Blanc, 78180, Saint-Quentin-en-Yvelines.
                    Numéro de téléphone est 0615151515
                    Adresse e-mail david.carneiro@WeDev.com.
                    L'hébergeur du site https://estudia.ipssi-sio.fr/pages/index.php est la société OVH, dont le siège social
                    est situé au 2 rue Kellermann - 59100 Roubaix - France, avec le numéro de téléphone : 1007.
                    </p>
                </div>
                <div>
                    <h4>Article 2 : Accès au site <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article2">
                    Le site https://estudia.ipssi-sio.fr/pages/index.php permet à l'Utilisateur un accès gratuit aux services
                    suivants.
                    Les services du site internet sont divisés en 3 parties :
                    - Étudiant ;
                    - Enseignant;
                    -Administration.
                    Chaque partie recevra un identifiants et un mot de passe déjà actif, créé aléatoirement. Ils pourrons s'authentifier par le biais de ces derniers.
                    Concernant la partie étudiante, il aura la possibilité de :
                    - Visualiser son emploi du temps du jour ainsi que de la semaine ;
                    - Visualiser ses notes ;
                    - Visualiser ses devoirs ;
                    - Visualiser ses absences ;
                    - Visualiser les rapports administratifs ;
                    - Accéder à la messagerie ;
                    Concernant la partie "Enseignant", il aura la possibilité de :
                    - Attribuer des notes aux étudiants ;
                    - Attribuer des devoirs à une classe ;
                    - Attribuer des messages administratifs aux étudiants;
                    - Visualiser son emploi du temps du jour ainsi que de la semaine ;
                    - Visualiser les notes qu'il a attribué;
                    - Visualiser les devoirs qu'il a attribué ;
                    - Visualiser les rapports administratifs qu'il a attribué;
                    - Accéder à l'appel d'une classe ;
                    - Accéder au profil des élèves ;
                    - Accéder à la messagerie ;
                    Concernant la partie "Administration", il aura la possibilité de :
                    - Visualiser la liste des classes créée ;
                    - Visualiser la liste des élèves en fonction des classes ;
                    - Visualiser les informations de l'élève sélectionné ;
                    - Visualiser la liste des enseignants ;
                    - Accéder à la messagerie.
                    Le site est accessible gratuitement en tout lieu à tout Utilisateur ayant un accès à Internet. Tous les
                    frais supportés par l'Utilisateur pour accéder au service (matériel informatique, logiciels, connexion
                    Internet, etc.) sont à sa charge.
                    L’Utilisateur non membre n'a pas accès aux services réservés. Pour cela, il doit s’inscrire en
                    remplissant le formulaire. En acceptant de s’inscrire aux services réservés, l’Utilisateur membre
                    s’engage à fournir des informations sincères et exactes concernant son état civil et ses coordonnées,
                    notamment son adresse email.
                    Pour accéder aux services, l’Utilisateur doit ensuite s'identifier à l'aide de son identifiant et de son mot
                    de passe qui lui seront communiqués après son inscription.
                    Tout Utilisateur inscrit pourra également solliciter sa désinscription en contactant l'administration de l'etablissement. Celle-ci sera effective dans un délai raisonnable.
                    Tout événement dû à un cas de force majeure ayant pour conséquence un dysfonctionnement du site
                    ou serveur et sous réserve de toute interruption ou modification en cas de maintenance, n'engage pas
                    la responsabilité de https://estudia.ipssi-sio.fr/pages/index.php. Dans ces cas, l’Utilisateur accepte
                    ainsi à ne pas tenir rigueur à l’éditeur de toute interruption ou suspension de service, même sans
                    préavis.
                    L'Utilisateur a la possibilité de contacter le site par messagerie électronique à l’adresse email de
                    l’éditeur communiqué à l’ARTICLE 1.

                    </p>
                </div>
                <div>
                    <h4>Article 3 : Collecte de données <i class="fas fa-chevron-down"></i></h4>
                    <div id="CGU_article3">
                    Le site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect
                    de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers
                    et aux libertés.
                    En vertu de la loi Informatique et Libertés, en date du 6 janvier 1978, l'Utilisateur dispose d'un droit
                    d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur
                    exerce ce droit :
                    <ul>
                        <li>via un formulaire de contact ;</li>
                        <li>via son espace personnel ;</li>
                    </ul>
                </div>
                <div>
                    <h4>Article 4 : Propriété intellectuelle <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article4" >
                    Les marques, logos, signes ainsi que tous les contenus du site (textes, images, son…) font l'objet
                    d'une protection par le Code de la propriété intellectuelle et plus particulièrement par le droit d'auteur.
                    L'Utilisateur doit solliciter l'autorisation préalable du site pour toute reproduction, publication, copie des
                    différents contenus. Il s'engage à une utilisation des contenus du site dans un cadre strictement privé,
                    toute utilisation à des fins commerciales et publicitaires est strictement interdite.
                    Toute représentation totale ou partielle de ce site par quelque procédé que ce soit, sans l’autorisation
                    expresse de l’exploitant du site Internet constituerait une contrefaçon sanctionnée par l’article L 335-2
                    et suivants du Code de la propriété intellectuelle.
                    Il est rappelé conformément à l’article L122-5 du Code de propriété intellectuelle que l’Utilisateur qui
                    reproduit, copie ou publie le contenu protégé doit citer l’auteur et sa source.
                    </p>
                </div>
                <div>
                    <h4>Article 5 : Responsabilité <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article5" >
                    Les sources des informations diffusées sur le site https://estudia.ipssi-sio.fr/pages/index.php sont
                    réputées fiables mais le site ne garantit pas qu’il soit exempt de défauts, d’erreurs ou d’omissions.
                    Les informations communiquées sont présentées à titre indicatif et général sans valeur contractuelle.
                    Malgré des mises à jour régulières, le site https://estudia.ipssi-sio.fr/pages/index.php ne peut être tenu
                    responsable de la modification des dispositions administratives et juridiques survenant après la
                    publication. De même, le site ne peut être tenue responsable de l’utilisation et de l’interprétation de
                    l’information contenue dans ce site.
                    L'Utilisateur s'assure de garder son mot de passe secret. Toute divulgation du mot de passe, quelle
                    que soit sa forme, est interdite. Il assume les risques liés à l'utilisation de son identifiant et mot de
                    passe. Le site décline toute responsabilité.
                    Le site https://estudia.ipssi-sio.fr/pages/index.php ne peut être tenu pour responsable d’éventuels
                    virus qui pourraient infecter l’ordinateur ou tout matériel informatique de l’Internaute, suite à une
                    utilisation, à l’accès, ou au téléchargement provenant de ce site.
                    La responsabilité du site ne peut être engagée en cas de force majeure ou du fait imprévisible et
                    insurmontable d'un tiers.
                    </p>
                </div>
                <div>
                    <h4>Article 6 : Liens hypertextes <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article6">
                    Des liens hypertextes peuvent être présents sur le site.
                    L’Utilisateur est informé qu’en cliquant sur ces liens, il sortira du site https://estudia.ipssi-sio.fr/pages/index.php.
                    Ce dernier n’a pas de contrôle sur les pages web sur lesquelles aboutissent ces liens et ne saurait, en aucun cas, être responsable de leur contenu.
                    </p>
                </div>
                <div>
                    <h4>Article 7 : Cookies <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article7">
                    Des liens hypertextes peuvent être présents sur le site. L’Utilisateur est informé qu’en cliquant sur ces liens, il sortira du site https://estudia.ipssi-sio.fr/pages/index.php. 
                    Ce dernier n’a pas de contrôle sur les pages web sur lesquelles aboutissent ces liens et ne saurait, en aucun cas, être responsable de leur contenu.
                    L’Utilisateur est informé que lors de ses visites sur le site, un cookie peut s’installer automatiquement sur son logiciel de navigation.
                    Les cookies sont de petits fichiers stockés temporairement sur le disque dur de l’ordinateur de l’Utilisateur par votre navigateur et qui sont nécessaires à l’utilisation du site https://estudia.ipssisio.fr/pages/index.php.
                    Les cookies ne contiennent pas d’information personnelle et ne peuvent pas être utilisés pour identifier quelqu’un.
                    Un cookie contient un identifiant unique, généré aléatoirement et donc anonyme.
                    Certains cookies expirent à la fin de la visite de l’Utilisateur, d’autres restent.
                    L’information contenue dans les cookies est utilisée pour améliorer le site https://estudia.ipssi-sio.fr/pages/index.php.
                    En naviguant sur le site, L’Utilisateur les accepte.
                    L’Utilisateur doit toutefois donner son consentement quant à l’utilisation de certains cookies.
                    A défaut d’acceptation, l’Utilisateur est informé que certaines fonctionnalités ou pages risquent de lui être refusées.
                    L’Utilisateur pourra désactiver ces cookies par l’intermédiaire des paramètres figurant au sein de son logiciel de navigation.
                    </p>
                </div>
                <div>
                    <h4>Article 8 : Publication par l'Utilisateur <i class="fas fa-chevron-down"></i></h4>
                    <div id="CGU_article8">
                    Le site permet aux membres de publier les contenus suivants :
                    <ul>
                        <li>Information sur les notes, devoirs, appréciations, emploi du temps.</li>
                        <li>
                            Utilisation de la messagerie.
                        </li>
                    </ul>
                    Dans ses publications, le membre s’engage à respecter les règles de la Netiquette (règles de bonne
                    conduite de l’internet) et les règles de droit en vigueur.
                    Le site peut exercer une modération sur les publications et se réserve le droit de refuser leur mise en
                    ligne, sans avoir à s’en justifier auprès du membre.
                    Le membre reste titulaire de l’intégralité de ses droits de propriété intellectuelle. Mais en publiant une
                    publication sur le site, il cède à la société éditrice le droit non exclusif et gratuit de représenter,
                    reproduire, adapter, modifier, diffuser et distribuer sa publication, directement ou par un tiers autorisé,
                    dans le monde entier, sur tout support (numérique ou physique), pour la durée de la propriété
                    intellectuelle. Le Membre cède notamment le droit d'utiliser sa publication sur internet et sur les
                    réseaux de téléphonie mobile.
                    La société éditrice s'engage à faire figurer le nom du membre à proximité de chaque utilisation de sa
                    publication.
                    Tout contenu mis en ligne par l'Utilisateur est de sa seule responsabilité. L'Utilisateur s'engage à ne
                    pas mettre en ligne de contenus pouvant porter atteinte aux intérêts de tierces personnes. Tout
                    recours en justice engagé par un tiers lésé contre le site sera pris en charge par l'Utilisateur.
                    Le contenu de l'Utilisateur peut être à tout moment et pour n'importe quelle raison supprimé ou modifié
                    par le site, sans préavis.

                    </div>
                </div>
                <div>
                    <h4>Article 9 : Droit applicable et juridiction compétente <i class="fas fa-chevron-down"></i></h4>
                    <p id="CGU_article9">
                    La législation française s'applique au présent contrat. En cas d'absence de résolution amiable d'un
                    litige né entre les parties, les tribunaux français seront seuls compétents pour en connaître.
                    Pour toute question relative à l’application des présentes CGU, vous pouvez joindre l’éditeur aux
                    coordonnées inscrites à l’ARTICLE 1.

                    </p>
                </div>
            </div>
        </div>
        <?php
        if(!empty($_SESSION))
        {
            ?>
            <div>
                <form action="../traitements/premiereConnexion.php" method="post">
                    <div class="mb-3 form-check">
                        <label class="form-check-label" for="exampleCheck1">J'accepte les conditions d'utilisations générales</label>
                        <input type="checkbox" name="acceptBoxCGU" class="form-check-input" id="exampleCheck1">
                    </div>
                    <button type="submit" value="1" name="acceptCGU" class="btn btn-primary">Valider</button>
                    
                </form>
            </div>
            <?php
        }
        ?>
    
    </div>
    <?php
}
else
{
    header("location:index.php");
}