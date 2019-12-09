<?php


class Infolist extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function nbrListName($namList){                     //fonction permettant de compter le nombre de listes que possède un utilisateur
		$dbh = $GLOBALS["dbh"];
		$sql = "SELECT count(idList) as nbreList from LIST Where nameList = '$namList'";
		$result = $dbh->query($sql);
		return $result->fetch();
	}

	function createNewList($namList){                   //fonction permettant de créer une liste
		$dbh = $GLOBALS["dbh"];
		$sql = "INSERT INTO LIST(nameList) VALUES ('$namList') ";
		$dbh->exec($sql);
	}

	function infoList($idList){                         //fonction permettant de récupérer toutes les informations des listes
		$dbh = $GLOBALS["dbh"];
		$sql = "SELECT * from LIST Where idList = '$idList'";
		$result = $dbh->query($sql);
		return $result->fetch();
	}

	function searchId($nameList){                       //fonction permettant de récupérer l'id d'une liste grâce à son nom
		$dbh = $GLOBALS["dbh"];
		$sql = "SELECT idList from LIST Where nameList = '$nameList'";
		$result = $dbh->query($sql);
		return $result->fetch();
	}

	function SuppList($idlist){                         //fonction permettant de supprimer une liste via son id
		$dbh = $GLOBALS["dbh"];
		$sql = "DELETE FROM LIST WHERE idList = '$idlist'";
		$dbh->exec($sql);
	}

	function ElemPossedeListQuerry($idList){            //fonction permettant de récupérer les éléments d'une liste
		$dbh = $GLOBALS["dbh"];
		$sql = "SELECT * from ELEMENT NATURAL JOIN LIST WHERE idList = '$idList' ";
		return $dbh->query($sql);
	}

	function ElemPossedeList($idList){                  //fonction permettant de retourner le string de la fonction 'ElemPossedeListQuerry'
		return ElemPossedeListQuerry($idList)->fetch();
	}
}
