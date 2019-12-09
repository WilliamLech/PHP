<?php
include_once("db_info.php");
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);        //connexion à la base de données

function infoUser($nameUser, $pass){                //fonction permettant de vérifier le nom et le mot de passe de l'utilisateur
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT idUser from USER WHERE nameUser = '$nameUser' AND pwUser = '$pass'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function AllinfoUser($idUser){                      //fonction permettant de récupérer toutes les informations de l'utilisateur
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from USER WHERE idUser = '$idUser'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function infoUserAjoutList($nameUser){              //fonction permettant d'ajouter un collaborateur à une liste
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT idUser from USER WHERE nameUser = '$nameUser'";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function createNewUser($nameUser,$pw,$mail,$tel){               //fonction permettant d'ajouter un nouvel utilisateur à la base de données
    $dbh = $GLOBALS["dbh"];
    $sql = "INSERT INTO USER( nameUser, pwUser, mailUser,phoneUser) VALUES ('$nameUser','$pw','$mail','$tel') ";
    $dbh->exec($sql);
}

function nbrListUser($idUser){              //fonction permettant de récupérer le nombre de listes qu'un utilisateur possède
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT count(idList) as nbrList from USER NATURAL JOIN ACCES NATURAL JOIN LIST  WHERE idUser = '$idUser';";
    $result = $dbh->query($sql);
    return $result->fetch();
}

function ListPossedeUserQuerry($idUser){            //fonction permettant de récupérer toutes les informations des listes que possède l'utilisateur
    $dbh = $GLOBALS["dbh"];
    $sql = "SELECT * from LIST NATURAL JOIN ACCES NATURAL JOIN USER WHERE idUser = '$idUser'";
    return $dbh->query($sql);
}
function ListPossedeUser($idUser){                  //fonction permettant de retourner le string de la fonction 'ListPossedeUserQuerry'
    return ListPossedeUserQuerry($idUser)->fetch();
}