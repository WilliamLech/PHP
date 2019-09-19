
<?php
/*
$user = "i180367";
$pass = "vmb89zn";
$host = "http://la-myweb.univ-lemans.fr/phpMyAdmin/";
$base = "INF2_i180367";
try {
    $dbh = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    foreach($dbh->query('SELECT * from USER') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
*/
if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
    if ($_POST["config_user"] == "admin" && $_POST["config_pass"] == "totoro") {
        header("Location: Connecte.php");
        die();
    } else {
        $message= "Identifiant ou mot de passe incorrect, veuillez réessayer.";
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
        Nom d'utilisateur : <label>
                <input type="text" name="config_user" size="20">
            </label><br>
        Mot de passe : <label>
                <input type="text" name="config_pass" size="20">
            </label><br>
        <input type="submit" value="Valider">
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