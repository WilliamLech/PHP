<?php
include_once("db_info.php");
    if (isset($_POST['envoyer'])){
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
                    echo("erreur");
                }
            }
        }
    }
?>

<html>
<header>Création List</header>
<body>
<form method="post" action="CreaList.php">
    <p>Inserer nom List <input type="text"  name="NameElem" size="5" /></p>
    <p>Element : <input type="text"  name="Elem" size="5" /></p>
    <?php
    $nbre = 1;
    if (isset($_POST['addELem'])) {
        echo("<p>Element : <input type=\"text\"  name=\"Elem\" size=\"5\" /></p>");
        $nbre++;
    }
    ?>
    <input type="submit" name='envoyer'  value="ajouter"><br/>
</form>
<form method="post" action="CreaList.php">
    <input type="submit" name='addELem'  value="ajouter element">
</form>
</body>
</html>