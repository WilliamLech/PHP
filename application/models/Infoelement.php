<?php


class Infoelement extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function createElem($nomElem,$descElem,$idList){            //fonction permettant d'ajouter un élément à la liste
		$data = array(
			'NomElem' => $nomElem,
			'DescElem' => $descElem,
			'DateDElem' => date(now()),
			'idList' =>  $idList
		);
		$this->db->insert('ELEMENT',$data) ;   // "INSERT INTO ELEMENT(NomElem,DescElem,DateDElem,idList) VALUES ('$nomElem','$descElem',date(now()),'$idList') ";
		$this->db->truncate();
	}
}
