<?php
class Utilisateur extends CI_Controller{

    public function connexion($pass,$nameUser){             //fonction permettant à un utilisateur de se connecter
        try {
			$this->load->model('Infoutilisateur');
			$annexe= $this->Infoutilisateur->infoUser($nameUser, $pass);
            if ($annexe) {
                //on met l'idUser user en session pour facilement retrouver des info sur l'user
                session_start();
                $formId = filter_var($annexe["idUser"]);
                $_SESSION["id_user"] = $formId;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";        //affichage d'une erreur quand le nom et/ou le mot de passe de l'utilisateur sont erronés
            die();
        }
    }

    public function createUser($nameUser,$pw,$mail,$tel){           //fonction permettant de créer un utilisateur avec pour paramètres un nom, un mot de passe, un email et un numéro de téléphone
		$this->load->model('Infoutilisateur');
		$this->Infoutilisateur->createNewUser($nameUser,$pw,$mail,$tel);
    }

    public function exist($nameUser){               //fonction pour vérifier si le nom de l'utilisater existe dans la base de données
		$this->load->model('Infoutilisateur');
		$annexe= $this->Infoutilisateur->infoUserAjoutList($nameUser);
    	if($annexe) return true ;
        else return false;
    }

    public function allListQuerry($idUser){         //fonction permettant de récupérer toutes les informations des listes que l'utilisateur possède
		$this->load->model('Infoutilisateur');
		$annexe= $this->Infoutilisateur->ListPossedeUserQuerry($idUser);
    	return $annexe;
    }

    public function listeRole($idUser,$idList){                 //fonction permettant de vérifier l'accès que possède l'utilisateur sur une liste (propriétaire ou collaborateur)
		$this->load->model('Infoacess');
		$info = $this->Infoacess->checkAccess($idUser,$idList);
        if ( $info["roleAcces"]== 'Proprietaire') return 1;
        else if ($info["roleAcces"] == 'Collaborateur') return 0;
        else return -1;
    }

    public function getName($idUser){           //fonction pour récupérer le nom de l'utilisateur
		$this->load->model('Infoutilisateur');
		$info= $this->Infoutilisateur->AllinfoUser($idUser);
        return $info["nameUser"];
    }

    public function getMail($idUser){           //fonction pour récupérer le mail de l'utilisateur
		$this->load->model('Infoutilisateur');
		$info= $this->Infoutilisateur->AllinfoUser($idUser);
        return $info["mailUser"];
    }

    public function getTel($idUser){            //fonction pour récupérer le numéro de téléphone de l'utilisateur
		$this->load->model('Infoutilisateur');
		$info= $this->Infoutilisateur->AllinfoUser($idUser);
        return $info["phoneUser"];
    }

    public function getNbreList($idUser){       //fonction pour récupérer le nombre de listes que l'utilisateur possède
		$this->load->model('Infoutilisateur');
		$info= $this->Infoutilisateur->nbrListUser($idUser);
        return $info["nbrList"];
    }

    public function getId($nameUser){           //fonction pour récupérer l'id de l'utilisateur
		$this->load->model('Infoutilisateur');
		$info= $this->Infoutilisateur->infoUserAjoutList($nameUser);
        return $info["idUser"];
    }

    // -----------------------------------------------------------------

	public function index(){
		$this->load->view('page_accueil');
	}

	public function verificationUser(){
    	$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->load->form_validation->run() == true) {
			$pass = $this->input->post('config_pass');
			$nameUser = $this->input->post('config_user');
			session_start();
			$validate = $this->connexion($pass,$nameUser);
            if ($validate){         //envoie vers la page des listes
           		 $formErreurPageAccueil = filter_var("");
           		 $_SESSION["erreurPage"] = $formErreurPageAccueil;
           		 $this->load->view('page_profil');
            } else {                //renvoie vers la page de connexion
            	$formErreurPageAccueil = filter_var("Mauvaise information !");
				$_SESSION["erreurPage"] = $formErreurPageAccueil;
				$this->load->view('page_accueil');
            }
		}
	}

	public function pageinscription(){
		$this->load->view('page_inscription');
	}

	public function  pageProfil(){
		$this->load->view('page_profil');
	}

	public function newUser(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->load->form_validation->run() == true) {
			$userName = $this->input->post('userName');
			$psw = $this->input->post('psw');
			$mail = $this->input->post('mail');
			$tel = $this->input->post('tel');
			session_start();
			if ($userName!="" && $psw!="" && $mail!="" && $tel !="") {           //vérifie si tous les champs sont remplis
				$this->createUser($userName,$psw,$mail,$tel);
				$_SESSION["erreurPage"] = ""; //inscrit l'utilisateur dans la base de données
				$this->load->view('page_accueil');
			}
			else {                          //affichage d'un message préventif
				$_SESSION["erreurPage"] = "<br /> Erreur : veuillez renseigner tous les champs.";
				$this->load->view('page_inscription');
			}
		}
	}
}
