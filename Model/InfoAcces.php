<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);

function createAccessList($iduser,$idlist,$role){
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO ACCES(idUser,idList,roleAcces) VALUES ('$iduser','$idlist','$role') ";
    $dbh->exec($sql);
}

function checkAccess($idUser,$idList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT roleAcces from ACCES Where idUser = '$idUser' AND idList = '$idList'";
    $result = $dbh->query($sql);
    return $result->fetch();
}