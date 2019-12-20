<?php
$this->load->helper('html');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/page_profil.css">                      <!--liaison avec le css correspondant-->
    <meta charset="UTF-8">
    <title>Page de Profil</title>                               <!--nom de la page-->
</head>
<body>
<div class="grid-container">
    <div class="header"></div>
    <div class="profil">
        <?php affInfoProfilUser() ?>                            <!--appel d'une fonction permettant d'afficher les données de l'utilisateur (nom, email, numéro de téléphone et le nombre de listes qu'il possède-->
    </div>
    <div class="main">
        <form method="post"  action="indexe.php">                <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <?php affList() ?>                                  <!--appel d'une fonction permettant d'afficher les listes de l'utilisateur-->
            <br/>
            <input type="submit" name="SelectList" value="Valider">                     <!--bouton permettant d'accéder au contenu de la liste choisie au préalable-->
            <input type="submit" name="SuppList" value="Supprimer">                     <!--bouton permettant de supprimer une liste choisie au préalable-->
        </form>
        <br/><br/><br/>
        <form method="post" action="indexe.php">                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            Nom Liste <input type="text"  name="NameList" size="5" /><br/>              <!--formulaire permettant de créer une nouvelle liste avec un nom-->
            <?php echo $_SESSION["erreurPage"]."<br/>"?>                                <!--affiche une erreur gérée par l'index lorsqu'une liste portant le même nom est déjà disponible-->
            <input type="submit" name="CreaList" value="Création d'une liste">          <!--bouton permettant de créer la liste dans la base de données-->
        </form>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>


<?php
function affInfoProfilUser(){           //affiche le nom, l'email, le numéro de téléphone et le nombre de listes que l'utilisateur possède
	echo ("Nom d'utilisateur : ".$GLOBALS['user']->getName($_SESSION["id_user"])."<br/>
                E-mail : ".$GLOBALS['user']->getMail($_SESSION["id_user"]) ."<br/>
                Téléphone : ".$GLOBALS['user']->getTel($_SESSION["id_user"])."<br/>
                Nombre de liste : ".$GLOBALS['user']->getNbreList($_SESSION["id_user"]));
}

function affList(){                     //affiche les noms des listes que possède l'utilisateur
	$infoList = $GLOBALS['user']->allListQuerry($_SESSION["id_user"]);
	foreach($infoList as $item){
		echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
	}
	$_SESSION["erreurPage2"];
}
?>
