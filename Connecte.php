<?php
include_once("db_info.php");
session_start();
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
$pass = $_SESSION["config_pass"];
$user = $_SESSION["config_user"];
$sql = "SELECT phoneUser,mailUser from USER WHERE nameUser = '$user' AND pwUser = '$pass';";
$result = $dbh->query($sql);
$annexe =$result ->fetch();
$sql2 = "SELECT count(idList) as nbrList from USER NATURAL JOIN ACCES NATURAL JOIN LIST  WHERE nameUser = '$user' AND pwUser = '$pass';";
$result2 = $dbh->query($sql2);
$annexe2 =$result2 ->fetch();

if (isset($_POST['CreaList']) && isset($_POST["NameElem"])){
    $nam = $_POST["NameElem"];
    $sql3 = "INSERT INTO LIST(nameList) VALUES ($nam) "; // faire la liaison avec l'utilisateur
    $dbh->exec($sql3);
    header("Location: Connexion.php");
} else echo("erreur");
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
        <form method="post" action="listeRecap.php">
            <?php
            $sql3 = "SELECT nameList from LIST NATURAL JOIN ACCES NATURAL JOIN USER WHERE nameUser = '$user' AND pwUser = '$pass';";
            $list = $dbh->query($sql3);
            foreach($list as $item){
                echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
            }?>
            <input type="submit" value="Valider">
        </form>
        <form method="post" action="listeRecap.php">
            <br/><br/>
            <p>Inserer nom List <input type="text"  name="NameList" size="5" /></p>
            <input type="submit" name="CreaList" value="Création d'une liste">
        <form/>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>
