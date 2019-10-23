<?php
include_once("../Model/Connexion.php");

if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
    $pass = $_POST["config_pass"];
    $nameUser = $_POST["config_user"];
    try {
        if (infoUser($nameUser, $pass)) {
            session_start();
            $formUser = filter_var($nameUser);
            $formPass = filter_var($pass);
            $_SESSION["config_pass"] = $formPass;
            $_SESSION["config_user"] = $formUser;
            header("Location: PageProfil.php");
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
    <link type="text/css" rel="stylesheet" href="PageAccueil.css">
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>
<div class="grid-container">
    <div class="top"></div>
    <div class="login">
            <form method="post" action="PageAccueil.php">
                Nom d'utilisateur : <label><input type="text" name="config_user" size="20"></label><br>
                Mot de passe : <label><input type="password" name="config_pass" size="20"></label><br>
                <input type="submit" value="Valider">
             </form>
        <form method="post" action="PageInscription.php">
            <input type="submit" value="S'inscrire">
        </form>
        <?php
        echo $message;
        ?>
    </div>

    <div class="main"></div>

    <div class="footer"></div>
</div>

</body>
</html>