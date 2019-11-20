<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);

function createElem($nomElem,$descElem,$idList){
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO ELEMENT(NomElem,DescElem,DateDElem,idList) VALUES ('$nomElem','$descElem',date(now()),'$idList') ";
    $validate = $dbh->exec($sql);

}