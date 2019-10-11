<?php
include_once("db_info.php");
session_start();
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$pass = $_SESSION["config_pass"];
$user = $_SESSION["config_user"];
$list = $_SESSION["List"];
$idUser = $_SESSION["idUser"];

$sql2 = "SELECT idList from LIST Where nameList = '$list'";
$result2 = $dbh->query($sql2);
$annexe2 =$result2 ->fetch();
$idList = $annexe2['idList'];

if (isset($_POST['DescElem']) && isset($_POST['NomElem']) && isset($_POST["CreaElem"])){
    $nomElem = $_POST['NomElem'];
    if ($nomElem != null){
        $descElem = $_POST['DescElem'];
        $sql3 = "INSERT INTO ELEMENT(NomElem,DescElem,DateDElem,idList) VALUES ('$nomElem','$descElem',date(now()),'$idList') ";
        $dbh->exec($sql3);
    }
}

if (isset($_POST['nomPerson']) && isset($_POST['AjoutPerson'])){
    $nameAjout = $_POST['nomPerson'];
    $sql6 = "SELECT idUser from USER Where nameUser = '$nameAjout'";
    $result6 = $dbh->query($sql6);
    $annexe6 =$result6 ->fetch();
    $idAjout = $annexe6[idUser];
    if ($idAjout != null){
        $sql5 = "INSERT INTO ACCES(idUser,idList,roleAcces) VALUES ('$idAjout','$idList','Collaborateur') ";
        $dbh->exec($sql5);
    } else {
        $msgError = "Cette personne n'existe pas";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link type="text/css" rel="stylesheet" href="cssListeRecap.css">
    <meta charset="UTF-8">
    <title>Recap</title>
</head>
<body>
<div class="grid-container">
    <div class="categorie">
        <?php
        echo("Il s'agit de la liste : ".$list."<br/>");

        $sql4 = "SELECT roleAcces from ACCES Where idUser = '$idUser' AND idList = '$idList'";
        $result4 = $dbh->query($sql4);
        $annexe4 =$result4 ->fetch();
        if ($annexe4[roleAcces] == "Proprietaire"){
            echo("<br/>
            <form method=\"post\" action=\"listeRecap.php\">
            <input type=\"text\"  name=\"nomPerson\" size=\"40\" /><input type=\"submit\" name=\"AjoutPerson\" value=\"Ajouter une personne\">
            </form>");
        }
        echo $msgError;
        ?>
    </div>
    <div class="ajout">
        <form method="post" action="listeRecap.php">
            Nom Element <input type="text"  name="NomElem" size="20" /><br/>
            Description <input type="text"  name="DescElem" size="20" /><br/><br/>
            <input type="submit" name="CreaElem" value="Création d'un element">
        </form>
    </div>
    <div class="fiches">
        <?php
        $sql = "SELECT NomElem,DescElem,DateDElem from ELEMENT NATURAL JOIN LIST WHERE nameList = '$list' ";
        $result = $dbh->query($sql);
        if ($result != null){
            $n=1;
            foreach($result as $item){
                echo("Element n°".$n." nommé ".$item[NomElem]." ajouté le ".$item[DateDElem]." dit :  ".$item[DescElem]."<br/>");
                $n++;
            }
        } else echo ("Pas d'element dans la liste.")
        ?>
        <div class="blocListe"></div>
    </div>
    <div class="footer">
        <a href="http://la-myweb.univ-lemans.fr/~i180394/Connecte.php" class="bouton">Retour</a>
    </div>
</div>
</body>
</html>