<?php
class Element extends CI_Controller {

    public function newElem($nomElem,$descElem,$idList){            //fonction permettant de créer un élément dans une liste avec pour
		$this->load->model('Infoelement');
		$this->Infoelement->createElem($nomElem,$descElem,$idList);                     //paramètres un nom, une description et un id
    }

	// -----------------------------------------------------------------

	public function addElem(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if (!is_null($this->input->post('DescElem')) &&  !is_null($this->input->post('NomElem'))){ //vérifie que le nom, la description et l'appui sur le bouton sont vérifiés
			$descElem = $this->input->post('DescElem');
			$nomElem = $this->input->post('NomElem');
			session_start();
			$this-> newElem($nomElem,$descElem,$_SESSION["idList"]);
			$this->showPageElemList();
			//$this->load->view('page_elemlist');
		}
	}

	// -----------------------------------------------------------------

	public function showPageElemList(){
		$data['erreur'] = null;
		$data['erreur2'] = null;
		$this->load->model('Infolist');
		$data['listElem'] = $this->Infolist->ElemPossedeListQuerry($_SESSION["idList"]);
		$info = $this->Infolist->infoList($_SESSION["idList"]);
		$data['nameList'] = $info["nameList"];

		$this->load->model('infoacess');
		$infoUtilisateur = $this->infoacess->checkAccess($_SESSION["id_user"],$_SESSION["idList"]);
		$data['roleAcces'] = $infoUtilisateur["roleAcces"];
		$this->load->view('page_elemlist',$data);
	}
}
