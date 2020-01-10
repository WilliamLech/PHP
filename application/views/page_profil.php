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
		$this->load->helper('directory'); //load directory helper
		$dir = "images/"; // Your Path to folder
		$map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
		?>
		<img src="<?php echo base_url($dir)."/user.png";?>" alt="" height="100"><br /><br />
		<?php echo ("<span class=\"label\">Nom d'utilisateur</span><br />".$nameUser."<br/><br /> <!--affiche le nom, l'email, le numéro de téléphone et le nombre de listes que l'utilisateur possède -->
                <span class=\"label\">E-mail</span><br />".$mailUser."<br/><br />
                <span class=\"label\">Téléphone</span><br />".$phoneUser."<br/><br />
               <span class=\"label\">Nombre de listes</span><br />".$nbList); ?>
	</div>
    <div class="main">
		<?php echo form_open('liste/gestionList'); ?>                <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <?php 	$infoList = $listUser;
			foreach($infoList as $item){ //affiche les noms des listes que possède l'utilisateur
				echo("<input type=\"radio\" name=\"list\" value=\"$item[nameList]\"> $item[nameList]<br>");
			}
			// $_SESSION["erreurPage2"];
			if ($erreur2 != null){
				echo($erreur2);
			}
			?>
            <br/>
            <input type="submit" name="SelectList" value="Valider">                     <!--bouton permettant d'accéder au contenu de la liste choisie au préalable-->
            <input type="submit" name="SuppList" value="Supprimer">                     <!--bouton permettant de supprimer une liste choisie au préalable-->
        </form>
        <br/><br/><br/>

		<?php echo form_open('liste/gestionList'); ?>                 <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
            <input type="text"  name="NameList" size="5" placeholder="Nom de la liste"/><br/>              <!--formulaire permettant de créer une nouvelle liste avec un nom-->
            <?php //echo $_SESSION["erreurPage"]."<br/>"
			if ($erreur != null){
				echo($erreur."<br/>");
			}
			?>                                <!--affiche une erreur gérée par l'index lorsqu'une liste portant le même nom est déjà disponible-->
            <input type="submit" name="CreaList" value="Créer la liste">          <!--bouton permettant de créer la liste dans la base de données-->
        </form>
    </div>
    <div class="footer"></div>
</div>
</body>
</html>
