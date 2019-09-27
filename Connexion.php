<?php
include_once("db_info.php");

if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
    $dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
    $pass = $_POST["config_pass"];
    $user = $_POST["config_user"];
    $sql = "SELECT * from USER WHERE nameUser = '$user' AND pwUser = '$pass';";
    try {
        $result = $dbh->query($sql);
        if ($result->fetch()) {
            session_start();
            $formUser = filter_var($user);
            $formPass = filter_var($pass);
            $_SESSION["config_pass"] = $formPass;
            $_SESSION["config_user"] = $formUser;
            header("Location: Connecte.php");
        } else {
            $message = "Identifiant ou mot de passe incorrect, veuillez réessayer.";
        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link type="text/css" rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>
<div class="grid-container">
    <div class="top"></div>

    <div class="login">
            <form method="post" action="Connexion.php">
                Nom d'utilisateur : <label><input type="text" name="config_user" size="20"></label><br>
                Mot de passe : <label><input type="password" name="config_pass" size="20"></label><br>
                <input type="submit" value="Valider">
             </form>
        <form method="post" action="Inscription.php">
            <input type="submit" value="S'inscrire">
        </form>
        <?php
        echo $message;
        ?>
    </div>

    <div class="main">Salut !</div>

    <div class="footer"></div>
</div>

</body>
</html>