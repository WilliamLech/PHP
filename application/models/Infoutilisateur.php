<?php


class Infoutilisateur extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	function infoUser($nameUser, $pass){                //fonction permettant de vérifier le nom et le mot de passe de l'utilisateur
		$query = $this->db->select("SELECT idUser from USER WHERE nameUser = '$nameUser' AND pwUser = '$pass'", false);
		return $query->row_array();
	}

	function AllinfoUser($idUser){                      //fonction permettant de récupérer toutes les informations de l'utilisateur
		$query = $this->db->select("SELECT * from USER WHERE idUser = '$idUser'", false);
		return $query->row_array();
	}

	function infoUserAjoutList($nameUser){              //fonction permettant d'ajouter un collaborateur à une liste
		$query = $this->db->select("SELECT idUser from USER WHERE nameUser = '$nameUser'", false);
		return $query->row_array();
	}

	function createNewUser($nameUser,$pw,$mail,$tel){               //fonction permettant d'ajouter un nouvel utilisateur à la base de données
		$data = array(
			'nameUser' => $nameUser,
			'pwUser' => $pw,
			'mailUser' => $mail,
			'phoneUser' => $tel
		);

		$this->db->insert('USER', $data);
	}

	function nbrListUser($idUser){              //fonction permettant de récupérer le nombre de listes qu'un utilisateur possède
		$this->db->select('idList');
		$this->db->from('USER');
		$this->db->join('ACCES', 'USER.idUser = ACCES.idUser');
		$this->db->join('ACCES', 'USER.idUser = ACCES.idUser');
		$query = $this->db->get_where('idUser', $idUser);

		return $this->db->count_all($query);
	}

	function ListPossedeUserQuerry($idUser){            //fonction permettant de récupérer toutes les informations des listes que possède l'utilisateur
		$this->db->select('*');
		$this->db->from('LIST');
		$this->db->join('ACCES', 'LIST.idList = ACCES.idList');
		$this->db->join('USER', 'USER.idUser = ACCES.idUser');
		return $query = $this->db->get_where('idUser', $idUser);
	}
	function ListPossedeUser($idUser){                  //fonction permettant de retourner le string de la fonction 'ListPossedeUserQuerry'
		return ListPossedeUserQuerry($idUser)->row_array();
	}

}
