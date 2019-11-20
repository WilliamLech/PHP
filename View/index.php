<?php
include_once('../Controller/Element.php');
include_once('../Controller/Liste.php');
include_once('../Controller/Utilisateur.php');
header("Location: PageAccueil.php");

global $erreurPageAccueil;
$erreurPageAccueil = "";
$liste= new Liste();
$elem= new Element();
$user= new Utilisateur();

if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
    $pass = $_POST["config_pass"];
    $nameUser = $_POST["config_user"];
    $validate = $user->connexion($pass,$nameUser);
    if ($validate){
        header("Location: PageProfil.php");
        $erreurPageAccueil = "";
    } else {
        header("Location: PageAccueil.php");
        $erreurPageAccueil = "Mauvais information !";
    }
}

function getErreurPageAccueil(){ // VERIFIER LE FONCTIONNEMENT DANS PageAccueil
    echo($GLOBALS['erreurPageAccueil']);
}