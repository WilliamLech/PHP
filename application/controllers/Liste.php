<?php
class Liste extends CI_Controller{

    public function verifDoublon($nameList){            //fonction permettant de vérifier l'existence d'une liste portant le même nom dans la base de données
		$this->load->model('infolist');
		$info = $this->infolist->nbrListName($nameList);
        if ($info["nbreList"] <1) return true;
        else return false;
    }

    public function addList($nameList,$idUser){             //fonction permettant d'ajouter une liste
		$this->load->model('Infolist');
		$this->Infolist->createNewList($nameList);

		$this->load->model('Infolist');
		$info = $this->Infolist->searchId($nameList);
       $this->load->model('Infoacess');
       $this->Infoacess->createAccessList($idUser,$info["idList"],'Proprietaire');

    }

    public function suppList($idList){              //fonction permettant de supprimer une liste
		$this->load->model('Infolist');
		$this->Infolist->SuppList($idList);
    }

    public function createAcces($nomUser,$idList,$role){            //fonction permettant de créer un accès à une liste à un utilisateur
		$this->load->model('Infoacess');
		$this->Infoacess->createAccessList($nomUser,$idList,$role);
    }

    public function listElem($idList){                  //fonction permettant de récupérer les éléments d'une liste
		$this->load->model('Infolist');
		$info = $this->Infolist->ElemPossedeListQuerry($idList);
        return $info;
    }

    public function getId($nameList){               //fonction permettant de récupérer l'id de la liste
		$this->load->model('Infolist');
		$info = $this->Infolist->searchId($nameList);
        return $info["idList"];
    }

    public function getName($idList){               //fonction permettant de récupérer le nom de la liste
		$this->load->model('infolist');
		$info = $this->infolist->infoList($idList);
        return $info["nameList"];
    }
}
