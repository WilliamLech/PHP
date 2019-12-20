<?php
/// on les appelle pas dans le code, on le fait via l'url
/// mettre les fonctions selon les controllers adaptés
/// utiliser les helpers si on est perdu
///
/// Ce fichier sera plustard enlevé
/*
$this->load->controller('Element');
$this->load->helper('Liste');
$this->load->helper('Utilisateur');

session_start();                    //lancement de la session
$listee= new Liste();               //création d'une liste
$elem= new Element();               //création d'un élément
$user= new Utilisateur();           //création d'un utilisateur*/


    // Page d'Accueil //
    /*if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {       //vérifie si l'utilisateur est présent dans la base de données
        $pass = $_POST["config_pass"];
        $nameUser = $_POST["config_user"];
        $validate = $user->connexion($pass,$nameUser);

        if ($validate){         //envoie vers la page des listes
            $formErreurPageAccueil = filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageAccueil;
			$this->load->view('page_profil');
        } else {                //renvoie vers la page de connexion
            $formErreurPageAccueil = filter_var("Mauvaise information !");
            $_SESSION["erreurPage"] = $formErreurPageAccueil;
			$this->load->view('page_accueil');
        }
    }*/

    // Page d'inscription //
    if (isset($_POST["Inscription"])) {
        if ($_POST["userName"]!="" && $_POST["psw"]!="" && $_POST["mail"]!="" && $_POST["tel"]) {           //vérifie si tous les champs sont remplis
            $user -> createUser($_POST["userName"],$_POST["psw"],$_POST["mail"],$_POST["tel"]);
            $formErreurPageInscription = filter_var("");            //inscrit l'utilisateur dans la base de données
            $_SESSION["erreurPage"] = $formErreurPageInscription;
			$this->load->view('page_accueil');
        }
        else {                          //affichage d'un message préventif
            $formErreurPageInscription = filter_var("<br /> Erreur : veuillez renseigner tous les champs.");
            $_SESSION["erreurPage"] = $formErreurPageInscription;
			$this->load->view('page_inscription');
        }
    }

    // page de Profil //
    if ($_POST["NameList"] != null && isset($_POST['CreaList'])){           //création d'une nouvelle liste
        $nameList = $_POST["NameList"];
        if($listee->verifDoublon($nameList)){               // vérifie qu'il n'y a pas deux listes en commun
            $listee->addList($nameList,$_SESSION["id_user"]);
            $formErreurPageProfil= filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageProfil;
        } else {                //affichage d'un message en cas de doublon de liste
            $formErreurPageProfil= filter_var("Liste déjà existante");
            $_SESSION["erreurPage"] = $formErreurPageProfil;
        }
		$this->load->view('page_profil');
    }

    if (isset($_POST['SelectList']) && isset($_POST["list"])){          //affiche la page de la liste sélectionnée
        //pour changer de page
        $formList = filter_var($listee->getId($_POST["list"]));
        $_SESSION["idList"] = $formList;
		$this->load->view('page_elemlist');
    }

    if (isset($_POST['SuppList']) && isset($_POST["list"])){            //vérifie si l'utilisateur peut supprimer une liste
        $nameList = $_POST["list"];
        $idList=$listee ->getId($nameList);
        if ($user ->listeRole($_SESSION["id_user"],$idList) == 1) {         //si l'utilisateur est propriétaire il peut supprimer
            $listee -> suppList($idList);
            $formErreurPageProfil = filter_var("");
            $_SESSION["erreurPage2"] = $formErreurPageProfil;
        } else {                //affiche un message si l'utilisateur est collaborateur
            $formErreurPageProfil = filter_var("Vous n'avez pas les droits");
            $_SESSION["erreurPage2"] = $formErreurPageProfil;
        }
		$this->load->view('page_profil');
    }

    /// préférable de les mettre dans les view directement
    /*function affInfoProfilUser(){           //affiche le nom, l'email, le numéro de téléphone et le nombre de listes que l'utilisateur possède
        echo ("Nom d'utilisateur : ".$GLOBALS['user']->getName($_SESSION["id_user"])."<br/>
                E-mail : ".$GLOBALS['user']->getMail($_SESSION["id_user"]) ."<br/>
                Téléphone : ".$GLOBALS['user']->getTel($_SESSION["id_user"])."<br/>
                Nombre de liste : ".$GLOBALS['user']->getNbreList($_SESSION["id_user"]));
    }

    function affList(){                     //affiche les noms des listes que possède l'utilisateur
        $infoList = $GLOBALS['user']->allListQuerry($_SESSION["id_user"]);
        foreach($infoList as $item){
            echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
        }
        $_SESSION["erreurPage2"];
    }*/

    // page Element liste //
    if (isset($_POST['DescElem']) && isset($_POST['NomElem']) && isset($_POST["CreaElem"])){            //vérifie que le nom, la description et l'appui sur le bouton sont vérifiés
        $elem-> newElem($_POST['NomElem'],$_POST['DescElem'],$_SESSION["idList"]);
		$this->load->view('page_elemlist');
    }

    if (isset($_POST['nomPerson']) && isset($_POST['AjoutPerson'])){                //vérifie si la personne ajoutée en collaboratrice existe dans la base de données
        if ($user -> exist($_POST['nomPerson'])){
            $listee -> createAcces($user ->getId($_POST['nomPerson']),$_SESSION["idList"],'Collaborateur');
            $formErreurPageElemList= filter_var("");
            $_SESSION["erreurPage"] = $formErreurPageElemList;
        } else {
            $formErreurPageElemList= filter_var("Cette personne n'existe pas");
            $_SESSION["erreurPage"] = $formErreurPageElemList;
        }
		$this->load->view('page_elemlist');
    }

    /*function gestionList(){                     //affiche le nom de la liste et le formulaire permettant d'ajouter une personne en collaboratrice
        echo("Il s'agit de la liste : ".$GLOBALS['listee']->getName($_SESSION["idList"])."<br/>");
        if ($GLOBALS['user']->listeRole($_SESSION["id_user"],$_SESSION["idList"]) == 1){
            echo(">
            </form>\"");
        }
    }

    function affElem(){                 //affiche le détails des éléments des listes
        $n=1;
        foreach($GLOBALS['listee']->listElem($_SESSION["idList"]) as $item){
            echo("Element n°".$n." nommé ".$item['NomElem']." ajouté le ".$item['DateDElem']." dit :  ".$item['DescElem']."<br/>");
            $n++;
        }
        if ($n==1) echo ("Pas d'element dans la liste.");
    }*/

    if (isset($_POST['retour'])){               //vérifie l'appui sur le bouton Retour pour ramener à la page de sélection des listes
		$this->load->view('page_profil');
    }
