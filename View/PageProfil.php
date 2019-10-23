<?php
include_once("../Model/Connexion.php");
session_start();
$pass = $_SESSION["config_pass"];
$nameUser = $_SESSION["config_user"];
$annexe = infoUser($nameUser, $pass);
$idUser = $annexe[idUser];

if ($_POST["NameList"] != null && isset($_POST['CreaList'])){
    $nameList = $_POST["NameList"];
    $annexe9 = nbrListName($nameList);
    if($annexe9[nbreList] < 1){ // vérifie qu'il n'y a pas deux liste en commun
        createNewList($nameList);
        $annexe4 = infoList($nameList);
        $idlist = $annexe4[idList];
        createAccessList($idUser,$idlist,'Proprietaire');
    }  else {
        $msgError2 = "Liste déjà existante";
    }
}

if (isset($_POST['SelectList']) && isset($_POST["list"])){
    $formList = filter_var($_POST["list"]);
    $_SESSION["List"] = $formList;
    header("Location: PageElemList.php");
}

if (isset($_POST['SuppList']) && isset($_POST["list"])){
    $nameList = $_POST["list"];
    $annexe4 = infoList($nameList);
    $idlist = $annexe4[idList];
    $annexe8 = checkAccess($idUser,$idlist);
    if ($annexe8[roleAcces] == 'Proprietaire') {
        SuppList($idlist);
    } else {
        $msgError = "Vous n'avez pas les droits";
    }
}
$annexe2 = nbrListUser($nameUser,$pass)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link type="text/css" rel="stylesheet" href="PageProfil.css">
    <meta charset="UTF-8">
    <title>Page de Profil</title>
</head>
<body>
<div class="grid-container">
    <div class="header"></div>
    <div class="profil">
        <?php
        echo ("Nom d'utilisateur : ".$nameUser  ."<br/>
                E-mail : ".$annexe[mailUser]  ."<br/>
                Téléphone : ".$annexe[phoneUser]  ."<br/>
                Nombre de liste : ".$annexe2[nbrList]);
        ?>
    </div>
    <div class="main">
        <form method="post"  action="PageProfil.php">
            <?php
            $infoList = ListPossedeUserQuerry($nameUser,$pass);
            foreach($infoList as $item){
                echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
            }
            echo ($msgError) ?>
            <br/>
            <input type="submit" name="SelectList" value="Valider">
            <input type="submit" name="SuppList" value="Supprimer">
        </form>
        <br/><br/><br/>
        <form method="post" action="PageProfil.php">
            Nom Liste <input type="text"  name="NameList" size="5" /><br/>
            <?php echo ($msgError2)."<br/>"?>
            <input type="submit" name="CreaList" value="Création d'une liste">
        </form>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>