<!DOCTYPE html>
<html lang = "fr">
<head>
    <link type="text/css" rel="stylesheet" href="PageInscription.css">
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
<a href="PageAccueil.php" class="bouton">Retour</a>
    <div class="inscription">
        <img src="../images/new-user.png" alt="inscription" height="70" /><br />
        <form method="post" action="index.php">
            <input type="text" name="userName" placeholder="Nom d'utilisateur"><br/><br/>
            <input type="password" name="psw" placeholder="Mot de passe"><br/><br/>
            <input type="email" name="mail" placeholder="Adresse mail"><br/><br/>
            <input type="tel" name="tel" placeholder="Num. de téléphone"><br/><br/>
            <input type="submit" name='Inscription' value="S'inscrire"><br/>
            <?php
                echo($_SESSION["erreurPage"]);
            ?>
        </form>
    </div>
</body>
</html>