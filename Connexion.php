
<?php
<<<<<<< HEAD
include_once("db_info.php");
$sql = "SELECT nameUser,pwUser from USER";
$dbh = new PDO("$server:host=$host;dbname=$base", $user, $pass);
try {
    foreach($dbh->query($sql) as $ligne) {
        if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
            if ($_POST["config_user"] == $ligne['nameUser'] && $_POST["config_pass"] == $ligne['pwUser']) {
                header("Location: Connecte.php");
                die();
            } else {
                $message= "Identifiant ou mot de passe incorrect, veuillez réessayer.";
            }
        }
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

=======
>>>>>>> 1181d373ca431edc71ed0eec5f4e3c13b4fce596



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
        Nom d'utilisateur : <label>
                <input type="text" name="config_user" size="20">
            </label><br>
        Mot de passe : <label>
                <input type="text" name="config_pass" size="20">
            </label><br>
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