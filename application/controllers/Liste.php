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

	// -----------------------------------------------------------------

	public function gestionList(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->load->form_validation->run() == true) {
			session_start();
			if ($this->input->post('CreaList')){  // si le bouton CreaList a été appuyé
				$nameList = $this->input->post('NameList');
				if($this->verifDoublon($nameList)){               // vérifie qu'il n'y a pas deux listes en commun
					$this->addList($nameList,$_SESSION["id_user"]);
					$_SESSION["erreurPage"] = "";
				} else {                //affichage d'un message en cas de doublon de liste
					$_SESSION["erreurPage"] = "Liste déjà existante";
				}
				$this->load->view('page_profil');
			}
			else if ($this->input->post('SelectList')){ // si le bouton SelectList a été appuyé
				//pour changer de page
				$_SESSION["idList"] = $this->getId($_POST["list"]);
				$this->load->view('page_elemlist');
			}
			else if ($this->input->post('SuppList')){ // si le bouton SuppList a été appuyé
				$nameList = $this->input->post('list');
				$idList= $this->getId($nameList);
				$user = new Utilisateur();
				if ($user ->listeRole($_SESSION["id_user"],$idList) == 1) {         //si l'utilisateur est propriétaire il peut supprimer
					$this -> suppList($idList);
					$_SESSION["erreurPage2"] = "";
				} else {                //affiche un message si l'utilisateur est collaborateur
					$_SESSION["erreurPage2"] = "Vous n'avez pas les droits";
				}
				$this->load->view('page_profil');
			}
		}
	}

	public function addMember(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->load->form_validation->run() == true) { //vérifie si la personne ajoutée en collaboratrice existe dans la base de données
			$nomPerson = $this->input->post('nomPerson');
			$user = new Utilisateur();
			session_start();
			if ($user -> exist($nomPerson)){
				$this -> createAcces($user ->getId($nomPerson),$_SESSION["idList"],'Collaborateur');
				$_SESSION["erreurPage"] = "";
			} else {
				$_SESSION["erreurPage"] = "Cette personne n'existe pas";
			}
			$this->load->view('page_elemlist');
		}
	}
}
