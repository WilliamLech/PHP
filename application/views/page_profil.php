<?php
$this->load->helper('html');
$this->load->helper('url');
$this->load->helper('form');
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
		<?php
		$this->load->helper('directory'); //charge le dossier helper
		$dir = "images/"; //chemin jusqu'au fichier
		$map = directory_map($dir);
		?>
		<img src="<?php echo base_url($dir)."/user.png";?>" alt="" height="100"><br /><br />
		<?php echo ("<span class=\"label\">Nom d'utilisateur</span><br />".$nameUser."<br/><br /> <!--affiche le nom, l'email, le numéro de téléphone et le nombre de listes que l'utilisateur possède -->
                <span class=\"label\">E-mail</span><br />".$mailUser."<br/><br />
                <span class=\"label\">Téléphone</span><br />".$phoneUser."<br/><br />
               <span class=\"label\">Nombre de listes</span><br />".$nbList); ?>
	</div>
    <div class="main">
		<?php echo form_open('liste/gestionList'); ?>                <!--envoi vers le controller liste pour exécuter la fonction gestionList-->
            <?php 	$infoList = $listUser;
			foreach($infoList as $item){ //affiche les noms des listes que possède l'utilisateur
				echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
			}
			if ($erreur2 != null){		//erreur liée à l'interaction faite avec une liste
				echo($erreur2);
			}
			?>
            <br/>
            <input type="submit" name="SelectList" value="Valider">                     <!--bouton permettant d'accéder au contenu de la liste choisie au préalable-->
            <input type="submit" name="SuppList" value="Supprimer">                     <!--bouton permettant de supprimer une liste choisie au préalable-->
        </form>
        <br/><br/><br/>

		<?php echo form_open('liste/gestionList'); ?>                 <!--envoi vers le controller liste pour exécuter la fonction gestionList-->
            <input type="text"  name="NameList" size="5" placeholder="Nom de la liste"/><br/>              <!--formulaire permettant de créer une nouvelle liste avec un nom-->
            <?php
			if ($erreur != null){		//erreur liée à l'interaction faite avec une liste
				echo($erreur."<br/>");
			}
			?>
            <input type="submit" name="CreaList" value="Créer la liste">          <!--bouton permettant de créer la liste dans la base de données-->
        </form>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>
