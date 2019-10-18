<?php
include_once("Connexion.php");
session_start();
$pass = $_SESSION["config_pass"];
$nameUser = $_SESSION["config_user"];
$nameList = $_SESSION["List"];

$annexe = infoUser($nameUser, $pass);
$idUser = $annexe[idUser];
$annexe2 = infoList($nameList);
$idList = $annexe2[idList];

if (isset($_POST['DescElem']) && isset($_POST['NomElem']) && isset($_POST["CreaElem"])){
    $nomElem = $_POST['NomElem'];
    if ($nomElem != null){
        $descElem = $_POST['DescElem'];
        createElem($nomElem,$descElem,$idList);
    }
}

if (isset($_POST['nomPerson']) && isset($_POST['AjoutPerson'])){
    $nameAjout = $_POST['nomPerson'];
    $annexe6 = infoUserAjoutList($nameAjout);
    $idAjout = $annexe6[idUser];
    if ($idAjout != null){
        createAccessList($idAjout,$idList,'Collaborateur');
    } else {
        $msgError = "Cette personne n'existe pas";
    }
}
?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <link type="text/css" rel="stylesheet" href="PageElemList.css">
    <meta charset="UTF-8">
    <title>Recap</title>
</head>
<body>
<div class="grid-container">
    <div class="categorie">
        <?php
        echo("Il s'agit de la liste : ".$nameList."<br/>");
        $annexe4 = checkAccess($idUser,$idList);
        if ($annexe4[roleAcces] == 'Proprietaire'){
            echo("<br/><form method=\"post\" action=\"PageElemList.php\">
            <input type=\"text\"  name=\"nomPerson\" size=\"40\"/><input type=\"submit\" name=\"AjoutPerson\" value=\"Ajouter une personne\">
            </form>");
        }
        echo $msgError;
        ?>
    </div>
    <div class="ajout">
        <form method="post" action="PageElemList.php">
            Nom Element <input type="text"  name="NomElem" size="20" /><br/>
            Description <input type="text"  name="DescElem" size="20" /><br/>
            <input type="submit" name="CreaElem" value="Création d'un element">
        </form>
    </div>
    <div class="fiches">
        <?php
        $result = ElemPossedeListQuerry($nameList);
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
    <div class="footer"><a href="PageProfil.php" class="retour">Retour</a></div>
</div>
</body>
</html>