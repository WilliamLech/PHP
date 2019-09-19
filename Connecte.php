<!DOCTYPE html>
<html lang="en">
<head>
    <link type="text/css" rel="stylesheet" href="cssRecap.css">
    <meta charset="UTF-8">
    <title>Page de Profil</title>
</head>
<body>
<div class="grid-container">
    <div class="header"></div>
    <div class="profil">
        <?php
            $user = $_POST["config_user"];
            echo("Name : ".$user);
        ?>
    </div>
    <div class="main"></div>
    <div class="footer"></div>
</div>
</body>
</html>
