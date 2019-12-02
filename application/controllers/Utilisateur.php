<?php
class Utilisateur extends CI_Controller{

    public function connexion($pass,$nameUser){             //fonction permettant à un utilisateur de se connecter
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
            print "Erreur !: " . $e->getMessage() . "<br/>";        //affichage d'une erreur quand le nom et/ou le mot de passe de l'utilisateur sont erronés
            die();
        }
    }

    public function createUser($nameUser,$pw,$mail,$tel){           //fonction permettant de créer un utilisateur avec pour paramètres un nom, un mot de passe, un email et un numéro de téléphone
        createNewUser($nameUser,$pw,$mail,$tel);
    }

    public function exist($nameUser){               //fonction pour vérifier si le nom de l'utilisater existe dans la base de données
        if(infoUserAjoutList($nameUser)) return true ;
        else return false;
    }

    public function allListQuerry($idUser){         //fonction permettant de récupérer toutes les informations des listes que l'utilisateur possède
        return ListPossedeUserQuerry($idUser);
    }

    public function listeRole($idUser,$idList){                 //fonction permettant de vérifier l'accès que possède l'utilisateur sur une liste (propriétaire ou collaborateur)
		$this->load->model('Infoacess');
		$info = $this->Infoacess->checkAccess($idUser,$idList);
        if ( $info["roleAcces"]== 'Proprietaire') return 1;
        else if ($info["roleAcces"] == 'Collaborateur') return 0;
        else return -1;
    }

    public function getName($idUser){           //fonction pour récupérer le nom de l'utilisateur
        $info = AllinfoUser($idUser);
        return $info["nameUser"];
    }

    public function getMail($idUser){           //fonction pour récupérer le mail de l'utilisateur
        $info = AllinfoUser($idUser);
        return $info["mailUser"];
    }

    public function getTel($idUser){            //fonction pour récupérer le numéro de téléphone de l'utilisateur
        $info = AllinfoUser($idUser);
        return $info["phoneUser"];
    }

    public function getNbreList($idUser){       //fonction pour récupérer le nombre de listes que l'utilisateur possède
        $info = nbrListUser($idUser);
        return $info["nbrList"];
    }

    public function getId($nameUser){           //fonction pour récupérer l'id de l'utilisateur
        $info = infoUserAjoutList($nameUser);
        return $info["idUser"];
    }
}
