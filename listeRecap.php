<?php
include_once("db_info.php");
session_start();
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$pass = $_SESSION["config_pass"];
$user = $_SESSION["config_user"];
$list = $_SESSION["List"];

$sql2 = "SELECT idList from LIST Where nameList = '$list'";
$result2 = $dbh->query($sql2);
$annexe2 =$result2 ->fetch();

if (isset($_POST['DescElem']) && isset($_POST['NomElem']) && isset($_POST["CreaElem"])){
    $descElem = $_POST['DescElem'];
    $nomElem = $_POST['NomElem'];
    $idList = $annexe2['idList'];
    $sql3 = "INSERT INTO ELEMENT(NomElem,DescElem,DateDElem,idList) VALUES ('$nomElem','$descElem',date(now()),'$idList') ";
    $dbh->exec($sql3);
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
        echo("Il s'agit de la liste : ".$list."<br/>")
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
    <div class="footer"></div>
</div>
</body>
</html>