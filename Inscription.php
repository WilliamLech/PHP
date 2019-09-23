<?php
include_once("db_info.php");
try{
    $dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    if (isset($_POST["userName"])  && isset($_POST["psw"] )) {
        if ($_POST["userName"]!="" && $_POST["psw"]!="") {
            $id = $_POST["userName"];
            $pw = $_POST["psw"];
            $sql = "INSERT INTO `USER`(`nameUser`, `pwUser`) VALUES ('$id','$pw') ";
            $dbh->exec($sql);
        }
        else{
            $msg="erreur";
        }
    }
}
catch(PDOException $e){
    header("Location: Connecte.php");
    die();
}


?>

<!DOCTYPE html>
<html lang = "fr">
<form method="post" action="Inscription.php">
    Nom utilisateur <input type="text" name="userName">
    Mot de passe <input type="text" name="psw">
    <input type="submit" value="S'inscrire">
    <?php
    echo $msg;
    ?>
</form>
</html>
