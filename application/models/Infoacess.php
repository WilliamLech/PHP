<?php
class Infoacess extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	function createAccessList($iduser,$idlist,$role){//fonction permettant la création d'accès à une liste pour un utilisateur
		$data = array(
			'idUser' => $iduser,
			'idlist' => $idlist,
			'roleAcces' =>  $role
		);
		$this->db->insert('ACCES',$data) ;
	}

	function checkAccess($idUser,$idList){			//fonction permettant de vérifier l'accès à une liste pour un utilisateur
		$query = $this->db->select("roleAcces from ACCES Where idUser = '$idUser' AND idList = '$idList'",false);
		return $query->get()->row_array();
	}

}
