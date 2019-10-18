<?php
include_once("Connexion.php");
if (isset($_POST["Inscription"])) {
    if ($_POST["userName"]!="" && $_POST["psw"]!="" && $_POST["mail"]!="" && $_POST["tel"]) {
        $nameUser = $_POST["userName"];
        $pw = $_POST["psw"];
        $mail = $_POST["mail"];
        $tel = $_POST["tel"];
        createUser($nameUser,$pw,$mail,$tel);
        header("Location: PageAccueil.php");
    }
    else{
        $msg="<br />"."Erreur : veuillez renseigner tous les champs.";
    }
}
?>

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
        <header>Inscription</header>
        <img src="images/resume.png" alt="inscription" height="70" /><br />
        <form method="post" action="PageInscription.php">
            Nom utilisateur<br/><input type="text" name="userName"><br/><br/>
            Mot de passe<br/><input type="password" name="psw"><br/><br/>
            E-mail<br/><input type="email" name="mail"><br/><br/>
            Tel.<br/><input type="tel" name="tel"><br/><br/>
            <input type="submit" name='Inscription' value="S'inscrire"><br/>
            <?php
            echo $msg;
            ?>
        </form>
    </div>
</body>
</html>