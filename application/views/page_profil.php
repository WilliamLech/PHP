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
        <?php echo ("Nom d'utilisateur : ".$nameUser."<br/> <!--affiche le nom, l'email, le numéro de téléphone et le nombre de listes que l'utilisateur possède -->
                E-mail : ".$mailUser."<br/>
                Téléphone : ".$phoneUser."<br/>
                Nombre de liste : ".$nbList); ?>
	</div>
    <div class="main">
		<?php echo form_open('liste/gestionList'); ?>                <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <?php 	$infoList = $listUser;
			foreach($infoList as $item){ //affiche les noms des listes que possède l'utilisateur
				echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
			}
			// $_SESSION["erreurPage2"];
			?>
            <br/>
            <input type="submit" name="SelectList" value="Valider">                     <!--bouton permettant d'accéder au contenu de la liste choisie au préalable-->
            <input type="submit" name="SuppList" value="Supprimer">                     <!--bouton permettant de supprimer une liste choisie au préalable-->
        </form>
        <br/><br/><br/>

		<?php echo form_open('liste/gestionList'); ?>                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            Nom Liste <input type="text"  name="NameList" size="5" /><br/>              <!--formulaire permettant de créer une nouvelle liste avec un nom-->
            <?php //echo $_SESSION["erreurPage"]."<br/>"
			if ($erreur != null){
				echo($erreur);
			}
			?>                                <!--affiche une erreur gérée par l'index lorsqu'une liste portant le même nom est déjà disponible-->
            <input type="submit" name="CreaList" value="Création d'une liste">          <!--bouton permettant de créer la liste dans la base de données-->
        </form>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>
