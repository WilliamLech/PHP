<?php
include_once("../Model/Connexion.php");

class Liste{

    public function verifDoublon($nameList){
        $annexe = nbrListName($nameList);
        if ($annexe["nbreList"] <1) return true;
        else return false;
    }

    public function addList($nameList,$idUser){
        createNewList($nameList);
        $annexe = searchId($nameList);
        createAccessList($idUser,$annexe["idList"],'Proprietaire');
    }

    public function suppList($idList){
        SuppList($idList);
    }

    public function createAcces($nomUser,$idList,$role){
        createAccessList($nomUser,$idList,$role);
    }

    public function listElem($idList){
        return ElemPossedeListQuerry($idList);
    }

    public function getId($nameList){
        $info = searchId($nameList);
        return $info["idList"];
    }

    public function getName($idList){
        $info = infoList($idList);
        return $info["nameList"];
    }
}