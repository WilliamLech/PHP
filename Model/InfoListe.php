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

function infoList($nameList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from LIST Where nameList = '$nameList'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function SuppList($idlist){
    $dbh = $GLOBALS["dbh"];
    $sql = "DELETE FROM LIST WHERE idList = '$idlist'";
    $dbh->exec($sql);
}

function ElemPossedeListQuerry($nameList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from ELEMENT NATURAL JOIN LIST WHERE nameList = '$nameList' ";
    return $dbh->query($sql);
}
function ElemPossedeList($nameList){
    return ElemPossedeListQuerry($nameList)->fetch();
}