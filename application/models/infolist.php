<?php


class Infolist extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function nbrListName($namList){                     //fonction permettant de compter le nombre de listes que possède un utilisateur
		$query = $this->db->select("SELECT count(idList) as nbreList from LIST Where nameList = '$namList'",false);
		return $query->get()->row_array();
	}

	function createNewList($namList){                   //fonction permettant de créer une liste
		$data = array(
			'nameList' => $namList,
		);
		$this->db->insert('LIST',$data) ;   // "INSERT INTO LIST(nameList) VALUES ('$namList') ";
		$this->db->truncate();
	}

	function infoList($idList){                         //fonction permettant de récupérer toutes les informations des listes
		$query = $this->db->select("SELECT * from LIST Where idList = '$idList'",false);
		return $query->get()->row_array();
	}

	function searchId($nameList){//fonction permettant de récupérer l'id d'une liste grâce à son nom
		$this->db->select('*');
		$this->db->from('LIST');
		$this->db->where('nameList',$nameList);
		return $this->db->get();
	}

	function SuppList($idlist){                         //fonction permettant de supprimer une liste via son id
		$this->db->delete('LIST',array('idList' => $idlist));
	}

	function ElemPossedeListQuerry($idList){            //fonction permettant de récupérer les éléments d'une liste
		$this->db->select('*');
		$this->db->from('ELEMENT');
		$this->db->join('LIST');
		 $querry = $this->db->where('idList',$idList);
		return $querry;
	}

	function ElemPossedeList($idList){                  //fonction permettant de retourner le string de la fonction 'ElemPossedeListQuerry'
		return ElemPossedeListQuerry($idList)->fetch()->get();
	}
}
