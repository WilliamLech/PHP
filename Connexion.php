
<?php

$id = "Sam";
$pass = "password";

if (isset($_POST["id"]) && isset($_POST["pass"])){
    if ($_POST["id"]==$id && $_POST["pass"]==$pass){
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
        Nom d'utilisateur : <input type="text" name="id" size="20"><br>
        Mot de passe : <input type="text" name="pass" size="20"><br>
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