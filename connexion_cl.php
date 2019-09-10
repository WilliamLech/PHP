<!DOCTYPE html>
<html lang="fr">
<head>
    <link type="text/css" rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>

<?php

$id = "Sam";
$pass = "password";

if (isset($_POST["id"]) && isset($_POST["pass"])){
    if ($_POST["id"]==$id && $_POST["pass"]==$pass){
    echo("Identifiant et mot de passe corrects, vous êtes connecté(e).");
    die();
} else {
        echo("Identifiant ou mot de passe incorrect, veuillez réessayer.");
    }
}

?>

<div class="main">
    <form method="post" action="connexion_cl.php">
        Nom d'utilisateur : <input type="text" name="id" size="20"><br>
        Mot de passe : <input type="text" name="pass" size="20"><br>
        <input type="submit" value="Valider">
    </form>
</div>
</body>
</html>