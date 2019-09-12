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
        $message = "Identification incorrecte";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>
<form method="post" action="Connexion.php">
    Login <label>
        <input type="text" name="config_user" size="10">
    </label><br>
    Password <label>
        <input type="text" name="config_pass" size="10">
    </label><br>
    <input type="submit" value="Valider">
</form>

<?php
    echo $message;
?>

</body>
</html>