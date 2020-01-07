<?php
$this->load->helper('html');
$this->load->helper('form');
$this->load->helper('url');
?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/page_accueil.css">         <!--liaison avec le css correspondant-->
	<!--liaison avec le css correspondant-->
    <meta charset="UTF-8">
    <title>Page d'accueil</title>           <!--nom de la page-->
</head>
<body>
<div class="grid-container">
    <div class="top"></div>
    <div class="login">
		<?php echo form_open('utilisateur/verificationUser'); ?>  <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
			Nom d'utilisateur : <label><input type="text" name="config_user" size="20" ></label><br>     <!--formulaire pour rentrer le nom d'utilisateur des listes-->
			Mot de passe : <label><input type="password" name="config_pass" size="20" ></label><br>      <!--formulaire pour rentrer le mot de passe de l'utilisateur-->
			<input type="submit" value="Valider">       <!--bouton pour vérifier si l'utilisateur est bien connecté avec son mot de passe-->
		</form>

		<?php echo form_open('utilisateur/pageinscription'); ?>   <!--envoi vers la page d'inscription-->
            <input type="submit" value="S'inscrire">        <!--bouton pour s'inscrire dans la base de données-->
        </form>

		<?php
		//	session_start();
        //  echo($_SESSION["erreurPage"]);          //affiche une erreur gérée par l'index lors d'une mauvaise rentrée d'identifiant et/ou de mot de passe
        ?>
    </div>
    <div class="main"></div>
    <div class="footer"></div>
</div>

</body>
</html>
