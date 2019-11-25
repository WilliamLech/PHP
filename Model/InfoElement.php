<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);        //connexion à la base de données

function createElem($nomElem,$descElem,$idList){            //fonction permettant d'ajouter un élément à la liste
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO ELEMENT(NomElem,DescElem,DateDElem,idList) VALUES ('$nomElem','$descElem',date(now()),'$idList') ";
    $validate = $dbh->exec($sql);

}