<?php
require_once "entete.php";
$objetUser = new User();
$verif = $objetUser -> verif_identifiant($_GET["id"]);

if($verif == true)
{
    $info = $objetUser -> recupInfoUser($_GET["id"]);
    ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?=$info["nomUser"]. " ". $info["prenom"];?></h5>
            <p class="card-subtitle mb-2 text-muted"><?=$info["nom"] . " " . $info["classe"];?></p>
            <p> Date de naissance : <?=$info["dateNaiss"];?></p>

        </div>
    </div>
    <?php
}else
{
    header("location:index.php");
}