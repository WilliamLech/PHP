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
		if ($this->load->form_validation->run() == true) { //vérifie que le nom, la description et l'appui sur le bouton sont vérifiés
			$descElem = $this->input->post('DescElem');
			$nomElem = $this->input->post('NomElem');
			session_start();
			$this-> newElem($nomElem,$descElem,$_SESSION["idList"]);
			$this->load->view('page_elemlist');
		}
	}
}
