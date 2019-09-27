<?php
include_once("db_info.php");

if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
    $dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    if (isset($_POST["userName"])  && isset($_POST["psw"] )) {
        if ($_POST["userName"]!="" && $_POST["psw"]!="") {
            $id = $_POST["userName"];
            $pw = $_POST["psw"];
            $sql = "INSERT INTO `USER`(`nameUser`, `pwUser`) VALUES ('$id','$pw') ";
            $dbh->exec($sql);
            header("Location: Connexion.php");
        }
        else{
            $msg="erreur";
        }
    }
}
?>

<html>
<header>Création List</header>
<body>
<form method="post" action="CreaList.php">
    <p>Inserer nom Liste<input type="text"  name="NameElem" size="5" /></p>
    <p><textarea cols=40" rows="5" name="CtElem">Contenu de votre Liste</textarea></p>
    <p><input type="submit", value="ajouter"></p>
</form>
</body>
</html>
