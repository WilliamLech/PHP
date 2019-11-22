<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);

function infoUser($nameUser, $pass){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT idUser from USER WHERE nameUser = '$nameUser' AND pwUser = '$pass'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function AllinfoUser($idUser){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from USER WHERE idUser = '$idUser'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function infoUserAjoutList($nameUser){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT idUser from USER WHERE nameUser = '$nameUser'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function createNewUser($nameUser,$pw,$mail,$tel){
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO USER( nameUser, pwUser, mailUser,phoneUser) VALUES ('$nameUser','$pw','$mail','$tel') ";
    $dbh->exec($sql);
}

function nbrListUser($idUser){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT count(idList) as nbrList from USER NATURAL JOIN ACCES NATURAL JOIN LIST  WHERE idUser = '$idUser';";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function ListPossedeUserQuerry($idUser){
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from LIST NATURAL JOIN ACCES NATURAL JOIN USER WHERE idUser = '$idUser'";
    return $dbh->query($sql);
}
function ListPossedeUser($idUser){
    return ListPossedeUserQuerry($idUser)->fetch();
}