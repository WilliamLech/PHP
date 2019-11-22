<?php
include_once("../Model/Connexion.php");

class Utilisateur{

    public function connexion($pass,$nameUser){
        try {
            if ($annexe=infoUser($nameUser, $pass)) {
                //on met l'idUser user en session pour facilement retrouver des info sur l'user
                session_start();
                $formId = filter_var($annexe["idUser"]);
                $_SESSION["id_user"] = $formId;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function createUser($nameUser,$pw,$mail,$tel){
        createNewUser($nameUser,$pw,$mail,$tel);
    }

    public function verifSupp($nameList,$idUser){
        $annexe = infoList($nameList);
        $idlist = $annexe["idList"];
        $annexe2 = checkAccess($idUser,$idlist);
        return $annexe2["roleAcces"];
    }

    public function allListQuerry($idUser){
        return ListPossedeUserQuerry($idUser);
    }

    public function getName($idUser){
        $info = AllinfoUser($idUser);
        return $info["nameUser"];
    }

    public function getMail($idUser){
        $info = AllinfoUser($idUser);
        return $info["mailUser"];
    }

    public function getTel($idUser){
        $info = AllinfoUser($idUser);
        return $info["phoneUser"];
    }

    public function getNbreList($idUser){
        $info = nbrListUser($idUser);
        return $info["nbrList"];
    }
}