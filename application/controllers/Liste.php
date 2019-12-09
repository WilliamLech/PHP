<?php
include_once("../Model/Connexion.php");

class Liste extends CI_Controller{

    public function verifDoublon($nameList){            //fonction permettant de vérifier l'existence d'une liste portant le même nom dans la base de données
        $annexe = nbrListName($nameList);
        if ($annexe["nbreList"] <1) return true;
        else return false;
    }

    public function addList($nameList,$idUser){             //fonction permettant d'ajouter une liste
        createNewList($nameList);
        $annexe = searchId($nameList);
       $this->load->model('Infoacess');
       $this->Infoacess->createAccessList($idUser,$annexe["idList"],'Proprietaire');

    }

    public function suppList($idList){              //fonction permettant de supprimer une liste
        SuppList($idList);
    }

    public function createAcces($nomUser,$idList,$role){            //fonction permettant de créer un accès à une liste à un utilisateur
		$this->load->model('Infoacess');
		$this->Infoacess->createAccessList($nomUser,$idList,$role);
    }

    public function listElem($idList){                  //fonction permettant de récupérer les éléments d'une liste
        return ElemPossedeListQuerry($idList);
    }

    public function getId($nameList){               //fonction permettant de récupérer l'id de la liste
        $info = searchId($nameList);
        return $info["idList"];
    }

    public function getName($idList){               //fonction permettant de récupérer le nom de la liste
        $info = infoList($idList);
        return $info["nameList"];
    }
}
