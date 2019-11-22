<?php
include_once('../Controller/Element.php');
include_once('../Controller/Liste.php');
include_once('../Controller/Utilisateur.php');

session_start();
$liste= new Liste();
$elem= new Element();
$user= new Utilisateur();

    if (!isset($_SESSION["lancement"])){
        $validate = filter_var("1");
        $_SESSION["lancement"] = $validate;
        include_once('../View/PageAccueil.php');
    }

    // Page d'Accueil //
    if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
        $pass = $_POST["config_pass"];
        $nameUser = $_POST["config_user"];
        $validate = $user->connexion($pass,$nameUser);

        if ($validate){
            $formErreurPageAccueil = filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageAccueil;
            include_once('../View/PageProfil.php');
        } else {
            $formErreurPageAccueil = filter_var("Mauvaise information !");
            $_SESSION["erreurPage"] = $formErreurPageAccueil;
            include_once('../View/PageAccueil.php');
        }
    }

    // Page d'inscription //
    if (isset($_POST["Inscription"])) {
        if ($_POST["userName"]!="" && $_POST["psw"]!="" && $_POST["mail"]!="" && $_POST["tel"]) {
            $user -> createUser($_POST["userName"],$_POST["psw"],$_POST["mail"],$_POST["tel"]);
            $formErreurPageInscription = filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageInscription;
            include_once('../View/PageAccueil.php');
        }
        else {
            $formErreurPageInscription = filter_var("<br /> Erreur : veuillez renseigner tous les champs.");
            $_SESSION["erreurPage"] = $formErreurPageInscription;
            include_once('../View/PageInscription.php');
        }
    }

    // page de Profil //
    if ($_POST["NameList"] != null && isset($_POST['CreaList'])){
        $nameList = $_POST["NameList"];
        if($liste->verifDoublon($nameList)){ // vérifie qu'il n'y a pas deux liste en commun
            $liste->addList($nameList);
            $formErreurPageProfil= filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageProfil;
        } else {
            $formErreurPageProfil= filter_var("Liste déjà existante");
            $_SESSION["erreurPage"] = $formErreurPageProfil;
        }
        include_once('../View/PageProfil.php');
    }

    if (isset($_POST['SelectList']) && isset($_POST["list"])){
        //pour changer de page
        $annexe = $liste->getId($_POST["list"]);
        $formList = filter_var($annexe["idList"]);
        $_SESSION["idList"] = $formList;
        include_once('../View/PageElemList.php');
    }

    if (isset($_POST['SuppList']) && isset($_POST["list"])){ // A FINIR
        $nameList = $_POST["list"];
        if ($user -> verifSupp($nameList,$_SESSION["id_user"]) == 'Proprietaire') {
            $liste -> SuppList($liste ->getId($nameList));
            $formErreurPageProfil = filter_var("");
            $_SESSION["erreurPage2"] = $formErreurPageProfil;
        } else {
            $formErreurPageProfil = filter_var("Vous n'avez pas les droits");
            $_SESSION["erreurPage2"] = $formErreurPageProfil;
        }
        include_once('../View/PageProfil.php');
    }

    function affInfoProfilUser(){
        echo ("Nom d'utilisateur : ".$GLOBALS['user']->getName($_SESSION["id_user"])."<br/>
                E-mail : ".$GLOBALS['user']->getMail($_SESSION["id_user"]) ."<br/>
                Téléphone : ".$GLOBALS['user']->getTel($_SESSION["id_user"])."<br/>
                Nombre de liste : ".$GLOBALS['user']->getNbreList($_SESSION["id_user"]));
    }

    function affList(){
        $infoList = $GLOBALS['user'] -> allListQuerry($_SESSION["id_user"]);
        foreach($infoList as $item){
            echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
        }
        $_SESSION["erreurPage2"];
    }

    // page Element liste //
    if (isset($_POST['DescElem']) && isset($_POST['NomElem']) && isset($_POST["CreaElem"])){
        $elem-> newElem($_POST['NomElem'],$_POST['DescElem'],$_SESSION["idList"]);
    }

