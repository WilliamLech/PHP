<?php
$this->load->helper('html');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/page_elemlist.css">         <!--liaison avec le css correspondant-->
    <meta charset="UTF-8">
    <title>Détails Liste</title>                  <!--nom de la page-->
</head>
<body>
<div class="grid-container">
    <div class="categorie">
        <?php
        gestionList();                      //appel d'une fonction permettant d'ajouter un collaborateur à une liste
        echo $_SESSION["erreurPage"];          //affiche une erreur gérée par l'index lorsque le nom du collaborateur n'existe pas dans la base de données
        ?>
    </div>
    <div class="ajout">
        <form method="post" action="indexe.php">                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            Nom Element <input type="text"  name="NomElem" size="20" /><br/>            <!--formulaire permettant de rentrer le nom des éléments de la liste-->
            Description <input type="text"  name="DescElem" size="20" /><br/>           <!--formulaire permettant de rentrer la description des éléments de la liste-->
            <input type="submit" name="CreaElem" value="Création d'un element">         <!--bouton permettant d'ajouter l'élément dans la base de données-->
        </form>
    </div>
    <div class="fiches">
        <?php
        affElem();                          //appel d'une fonction permettant d'afficher les éléments de la liste
        ?>
        <div class="blocListe"></div>
    </div>
    <div class="footer">
        <form method="post" action="indexe.php">             <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <input class="retour" type="submit" name="retour"  value="Retour">          <!--bouton permettant de retourner à la page des listes-->
        </form>
    </div>
</div>
</body>
</html>
