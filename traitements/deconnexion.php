<?php
setCookie("cookie-token", $cookie, -3600, "/");
session_start();
session_destroy();

header("location:../pages/formulaireConnexion.php");
?>