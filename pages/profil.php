<?php
require_once "entete.php";
$objetUser = new User();
$verif = $objetUser -> verif_identifiant($_GET["id"]);
$info = $objetUser -> recupInfoUser($_GET["id"]);
print_r($info);
if($verif == true)
{
    ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?=$info["nom"];?> <?=$info["prenom"];?></h5>
            <p class="card-subtitle mb-2 text-muted"><?=$info["idEtude"];?></p>
            
        </div>
    </div>
    <?php
}else
{
    header("location:index.php");
}