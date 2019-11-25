<?php
include_once('../Controller/Element.php');
include_once('../Controller/Liste.php');
include_once('../Controller/Utilisateur.php');

session_start();
$listee= new Liste();
$elem= new Element();
$user= new Utilisateur();


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
        if($listee->verifDoublon($nameList)){ // vérifie qu'il n'y a pas deux liste en commun
            $listee->addList($nameList,$_SESSION["id_user"]);
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
        $formList = filter_var($listee->getId($_POST["list"]));
        $_SESSION["idList"] = $formList;
        include_once('../View/PageElemList.php');
    }

    if (isset($_POST['SuppList']) && isset($_POST["list"])){
        $nameList = $_POST["list"];
        $idList=$listee ->getId($nameList);
        if ($user ->listeRole($_SESSION["id_user"],$idList) == 1) {
            $listee -> suppList($idList);
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
        $infoList = $GLOBALS['user']->allListQuerry($_SESSION["id_user"]);
        foreach($infoList as $item){
            echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
        }
        $_SESSION["erreurPage2"];
    }

    // page Element liste //
    if (isset($_POST['DescElem']) && isset($_POST['NomElem']) && isset($_POST["CreaElem"])){
        $elem-> newElem($_POST['NomElem'],$_POST['DescElem'],$_SESSION["idList"]);
        include_once('../View/PageElemList.php');
    }

    if (isset($_POST['nomPerson']) && isset($_POST['AjoutPerson'])){
        if ($user -> exist($_POST['nomPerson'])){
            $listee -> createAcces($user ->getId($_POST['nomPerson']),$_SESSION["idList"],'Collaborateur');
            $formErreurPageElemList= filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageElemList;
        } else {
            $formErreurPageElemList= filter_var("Cette personne n'existe pas");
            $_SESSION["erreurPage"] = $formErreurPageElemList;
        }
        include_once('../View/PageElemList.php');
    }

    function gestionList(){
        echo("Il s'agit de la liste : ".$GLOBALS['listee']->getName($_SESSION["idList"])."<br/>");
        if ($GLOBALS['user']->listeRole($_SESSION["id_user"],$_SESSION["idList"]) == 1){
            echo("<br/><form method=\"post\" action=\"index.php\">
            <input type=\"text\"  name=\"nomPerson\" size=\"40\"/><input type=\"submit\" name=\"AjoutPerson\" value=\"Ajouter une personne\">
            </form>");
        }
    }

    function affElem(){
        $result = $GLOBALS['listee']->listElem($_SESSION["idList"]);
        $n=1;
        foreach($GLOBALS['listee']->listElem($_SESSION["idList"]) as $item){
            echo("Element n°".$n." nommé ".$item['NomElem']." ajouté le ".$item['DateDElem']." dit :  ".$item['DescElem']."<br/>");
            $n++;
        }
        if ($n==1) echo ("Pas d'element dans la liste.");
    }

    if (isset($_POST['retour'])){
        include_once('../View/PageProfil.php');
    }