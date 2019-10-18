<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);

function infoUser($nameUser, $pass){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from USER WHERE nameUser = '$nameUser' AND pwUser = '$pass'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function infoUserAjoutList($nameUser){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT idUser from USER WHERE nameUser = '$nameUser'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function createUser($nameUser,$pw,$mail,$tel){
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO USER( nameUser, pwUser, mailUser,phoneUser) VALUES ('$nameUser','$pw','$mail','$tel') ";
    $dbh->exec($sql);
}

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

function SuppList($idlist){
    $dbh = $GLOBALS["dbh"];
    $sql = "DELETE FROM LIST WHERE idList = '$idlist'";
    $dbh->exec($sql);
}

function nbrListUser($nameUser,$pass){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT count(idList) as nbrList from USER NATURAL JOIN ACCES NATURAL JOIN LIST  WHERE nameUser = '$nameUser' AND pwUser = '$pass';";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function ListPossedeUserQuerry($nameUser,$pass){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from LIST NATURAL JOIN ACCES NATURAL JOIN USER WHERE nameUser = '$nameUser' AND pwUser = '$pass'";
    return $dbh->query($sql);
}
function ListPossedeUser($nameUser,$pass){
    return ListPossedeUserQuerry($nameUser,$pass)->fetch();
}

function ElemPossedeListQuerry($nameList){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from ELEMENT NATURAL JOIN LIST WHERE nameList = '$nameList' ";
    return $dbh->query($sql);
}
function ElemPossedeList($nameList){
    return ElemPossedeListQuerry($nameList)->fetch();
}

function createElem($nomElem,$descElem,$idList){
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO ELEMENT(NomElem,DescElem,DateDElem,idList) VALUES ('$nomElem','$descElem',date(now()),'$idList') ";
    $dbh->exec($sql);
}