<?php
include_once("db_info.php");
session_start();
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$pass = $_SESSION["config_pass"];
$user = $_SESSION["config_user"];

$sql = "SELECT phoneUser,mailUser,idUser from USER WHERE nameUser = '$user' AND pwUser = '$pass';";
$result = $dbh->query($sql);
$annexe =$result ->fetch();

$sql2 = "SELECT count(idList) as nbrList from USER NATURAL JOIN ACCES NATURAL JOIN LIST  WHERE nameUser = '$user' AND pwUser = '$pass';";
$result2 = $dbh->query($sql2);
$annexe2 =$result2 ->fetch();

if
if (isset($_POST['CreaList']) && isset($_POST["NameList"])){
    $nam = $_POST["NameList"];
    $sql3 = "INSERT INTO LIST(nameList) VALUES ('$nam') ";
    $dbh->exec($sql3);

    $sql4 = "SELECT idList from LIST Where nameList = '$nam'";
    $result4 = $dbh->query($sql4);
    $annexe4 =$result4 ->fetch();

    $iduser = $annexe[idUser];
    $IDlist = $annexe4[idList];
    $sql5 = "INSERT INTO ACCES(idUser,idList,roleAcces) VALUES ('$iduser','$IDlist','Proprietaire') ";
    $dbh->exec($sql5);
}

if (isset($_POST['SuppList']) && isset($_POST["NameList"])){
    $nam = $_POST["NameList"];
    $sql6 = "DELETE FROM LIST WHERE nameList = '$nam'";
    $dbh->exec($sql6);
}

if (isset($_POST['SelectList']) && isset($_POST["list"])){
    $formList = filter_var($_POST["list"]);
    $_SESSION["List"] = $formList;
    header("Location: listeRecap.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link type="text/css" rel="stylesheet" href="cssRecap.css">
    <meta charset="UTF-8">
    <title>Page de Profil</title>
</head>
<body>
<div class="grid-container">
    <div class="header"></div>
    <div class="profil">
        <?php
        echo ("Nom d'utilisateur : ".$user."<br/>
                E-mail : ".$annexe[mailUser]."<br/>
                Téléphone : ".$annexe[phoneUser]."<br/>
                Nombre de liste : ".$annexe2[nbrList]);
        ?>
    </div>
    <div class="main">
        <form method="post"  action="Connecte.php">
            <?php
            $sql6 = "SELECT nameList from LIST NATURAL JOIN ACCES NATURAL JOIN USER WHERE nameUser = '$user' AND pwUser = '$pass'";
            $list = $dbh->query($sql6);
            foreach($list as $item){
                echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
            }?>
            <input type="submit" name="SelectList" value="Valider"> <input type="submit" name="SupptList" value="Supprimer">
        </form>

        <br/><br/>

        <form method="post" action="Connecte.php">
            <p>Nom Liste <input type="text"  name="NameList" size="5" /></p>
            <input type="submit" name="CreaList" value="Création d'une liste">
        </form>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>
