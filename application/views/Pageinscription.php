<!DOCTYPE html>
<html lang = "fr">
<head>
    <link type="text/css" rel="stylesheet" href="Pageinscription.css">          <!--liaison avec le css correspondant-->
    <meta charset="UTF-8">
    <title>Inscription</title>                  <!--nom de la page-->
</head>
<body>
<a href="Pageaccueil.php" class="bouton">Retour</a>             <!--liaison avec la page d'accueil via un bouton-->
    <div class="inscription">
        <img src="../images/new-user.png" alt="inscription" height="70" /><br />            <!--liaison avec l'image présente sur la page-->
        <form method="post" action="index.php">                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <input type="text" name="userName" placeholder="Nom d'utilisateur"><br/><br/>   <!--formulaire pour rentrer le nom d'utilisateur que la personne veut utiliser-->
            <input type="password" name="psw" placeholder="Mot de passe"><br/><br/>         <!--formulaire pour rentrer le mot de passe que la personne veut utiliser-->
            <input type="email" name="mail" placeholder="Adresse mail"><br/><br/>           <!--formulaire pour rentrer l'adresse mail de la personne-->
            <input type="tel" name="tel" placeholder="Num. de téléphone"><br/><br/>         <!--formulaire pour rentrer le numéro de téléphone de la personne-->
            <input type="submit" name='Inscription' value="S'inscrire"><br/>                <!--bouton permettant de vérifier l'existence ou non du nom d'utilisateur afin de s'inscrire-->
            <?php
                echo($_SESSION["erreurPage"]);          //affiche une erreur gérée par l'index lorsque tous les champs ne sont pas renseignés
            ?>
        </form>
    </div>
</body>
</html>
