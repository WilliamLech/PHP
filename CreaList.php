<?php
include_once("db_info.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['addELem'])) {
        $msg = "<p>Element : <input type=\"text\"  name=\"Elem1\" size=\"5\" /></p>";
    } else {
        echo("pas ok");
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
}
?>

<html>
<header>Création List</header>
<body>
<form method="post" action="CreaList.php">
    <p>Inserer nom List <input type="text"  name="NameElem" size="5" /></p>
    <p>Element : <input type="text"  name="Elem1" size="5" /></p>
    <?php
    echo($msg);
    ?>
    <p><input type="submit",name="envoyer", value="ajouter"></p>
</form>
<form method="post" action="CreaList.php">
<p><input type="submit",name="addELem", value="ajouter element"></p>
</form>
</body>
</html>
