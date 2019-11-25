<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);        //connexion à la base de données

function createAccessList($iduser,$idlist,$role){           //fonction permettant la création d'accès à une liste pour un utilisateur
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO ACCES(idUser,idList,roleAcces) VALUES ('$iduser','$idlist','$role') ";
    $dbh->exec($sql);
}

function checkAccess($idUser,$idList){                      //fonction permettant de vérifier l'accès qu'un utilisateur possède sur une liste
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT roleAcces from ACCES Where idUser = '$idUser' AND idList = '$idList'";
    $result = $dbh->query($sql);
    return $result->fetch();
}