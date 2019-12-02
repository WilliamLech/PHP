<?php
include_once("../Model/Connexion.php");

class Element extends CI_Controller {
    public function newElem($nomElem,$descElem,$idList){            //fonction permettant de créer un élément dans une liste avec pour
        createElem($nomElem,$descElem,$idList);                     //paramètres un nom, une description et un id
    }
}
