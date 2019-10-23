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