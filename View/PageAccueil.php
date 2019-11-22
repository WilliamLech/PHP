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
            <form method="post" action="index.php">
                Nom d'utilisateur : <label><input type="text" name="config_user" size="20"></label><br>
                Mot de passe : <label><input type="password" name="config_pass" size="20"></label><br>
                <input type="submit" value="Valider">
             </form>
        <form method="post" action="PageInscription.php">
            <input type="submit" value="S'inscrire">
        </form>
        <?php
            echo($_SESSION["erreurPage"]);
        ?>
    </div>
    <div class="main"></div>
    <div class="footer"></div>
</div>

</body>
</html>