<?php
include_once("../Model/Connexion.php");

class Liste{

    public function verifDoublon($nameList){
        $annexe = nbrListName($nameList);
        if ($annexe["nbreList"] <1) return true;
        else return false;
    }

    public function addList($nameList){
        createNewList($nameList);
        $annexe = infoList($nameList);
        createAccessList($_SESSION["id_user"],$annexe["idList"],'Proprietaire');
    }

    public function getId($nameList){
        $info = infoList($nameList);
        return $info["idList"];
    }

    public function suppList($idList){
        SuppList($idList);
    }
}