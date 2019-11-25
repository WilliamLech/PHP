<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);

function nbrListName($namList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT count(idList) as nbreList from LIST Where nameList = '$namList'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function createNewList($namList){
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO LIST(nameList) VALUES ('$namList') ";
    $dbh->exec($sql);
}

function infoList($idList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from LIST Where idList = '$idList'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function searchId($nameList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT idList from LIST Where nameList = '$nameList'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function SuppList($idlist){
    $dbh = $GLOBALS["dbh"];
    $sql = "DELETE FROM LIST WHERE idList = '$idlist'";
    $dbh->exec($sql);
}

function ElemPossedeListQuerry($idList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from ELEMENT NATURAL JOIN LIST WHERE idList = '$idList' ";
    return $dbh->query($sql);
}
function ElemPossedeList($idList){
    return ElemPossedeListQuerry($idList)->fetch();
}