<?php
include_once("db_info.php");

if(isset($_POST["addElem"])){
    $msg = " <p>Element : <input type=\"text\"  name=\"Elem1\" size=\"5\" /></p>";
}
else {
    if (isset($_POST["NameElem"]) && isset($_POST["CtElem"])) {
        $dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
        if (isset($_POST["NameElem"]) && isset($_POST["CtElem"])) {
            if ($_POST["NameElem"] != "" && $_POST["CtElem"] != "") {
                $nam = $_POST["NameElem"];
                $Cont = $_POST["CtElem"];
                $sql = "INSERT INTO `LIST`(`nameList`) VALUES ('$nam') ";
                $sql2 = "INSERT INTO `ELEMENT`(`TextElem`) VALUES ('$Cont')";
                $dbh->exec($sql);
                $dbh->exec($sql2);
                header("Location: Connexion.php");
            } else {
                $msg = "erreur";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang = "fr">
<head>
    <link type="text/css" rel="stylesheet" href="cssCreaList.css">
    <meta charset="UTF-8">
    <title>Créer une Liste</title>
</head>
<body>
    <div class="creaList">
        <header>Création d'une Liste</header>
        <img src="images/list.png" alt="liste" height="70" />
        <form method="post" action="CreaList.php">
            <p>Insérer le nom de la Liste<br /><input type="text"  name="NameElem" size="20" /></p>
            <p>Insérer un Element<br /><input type="text"  name="Elem1" size="20" /></p>
            <?php
               echo($msg);
            ?>
            <p><input type="submit", name="envoyer", value="Ajouter"></p>
            <p><input type="submit", name="addELem", value="Ajouter l'élément"></p>
        </form>
    </div>
</body>
</html>
