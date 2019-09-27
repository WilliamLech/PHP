<?php
include_once("db_info.php");
try{
    $dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    if (isset($_POST["userName"]) && isset($_POST["psw"] ) && isset($_POST["mail"]) && isset($_POST["tel"])) {
        if ($_POST["userName"]!="" && $_POST["psw"]!="" && $_POST["mail"]!="" && $_POST["tel"]) {
            $id = $_POST["userName"];
            $pw = $_POST["psw"];
            $mail = $_POST["mail"];
            $tel = $_POST["tel"];
            $sql = "INSERT INTO `USER`(`nameUser`, `pwUser`, `mailUser`, `telUser`) VALUES ('$id','$pw', '$mail', '$tel') ";
            $dbh->exec($sql);
            header("Location: Connexion.php");
        }
        else{
            $msg="<br />"."Erreur : veuillez renseigner tous les champs.";
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
<head>
    <link type="text/css" rel="stylesheet" href="cssInscription.css">
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <div class="inscription">
        <form method="post" action="Inscription.php">
            Nom utilisateur<br /><input type="text" name="userName"><br /><br />
            Mot de passe<br /><input type="password" name="psw"><br /><br />
            E-mail<br /><input type="email" name="mail"><br /><br />
            Tel.<br /><input type="tel" name="tel"><br /><br />
            <input type="submit" value="S'inscrire"><br />
            <?php
            echo $msg;
            ?>
        </form>
    </div>
</body>
</html>
