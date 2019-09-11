<?php
if (isset($_POST["config_user"])  && isset($_POST["config_pass"] )) {
    if ($_POST["config_user"] == "admin" && $_POST["config_pass"] == "totoro") {
        header("Location: Page_connecte.html");
        die();
    } else {
        $message = "Identification incorrecte";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
</head>
<body>
<form method="post" action="Connexion.php">
    Login <input type="text" name="config_user" size="10"><br>
    Password <input type="text" name="config_pass" size="10"><br>
    <input type="submit" value="Valider">
</form>

<?php
    echo $message;
?>

</body>
</html>