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
    <div class="connexion">
		<header>Connexion</header>
		<?php
		$this->load->helper('directory'); //load directory helper
		$dir = "images/"; // Your Path to folder
		$map = directory_map($dir); /* This function reads the directory path specified in the first parameter and builds an array representation of it and all its contained files. */
		?>
		<img src="<?php echo base_url($dir)."/user.png";?>" alt="" height="100">
		<?php echo form_open('utilisateur/verificationUser'); ?>  <!--envoi vers l'index pour exécuter les différentes fonctions de l'index en lien avec la page-->
			<input type="text" name="config_user" size="20" placeholder="Nom d'utilisateur"><br/><br/>     <!--formulaire pour rentrer le nom d'utilisateur des listes-->
			<input type="password" name="config_pass" size="20" placeholder="Mot de passe"><br/><br/>      <!--formulaire pour rentrer le mot de passe de l'utilisateur-->
			<input type="submit" value="Valider">       <!--bouton pour vérifier si l'utilisateur est bien connecté avec son mot de passe-->
		</form>

		<?php echo form_open('utilisateur/pageinscription'); ?>   <!--envoi vers la page d'inscription-->
            <input type="submit" value="S'inscrire">        <!--bouton pour s'inscrire dans la base de données-->
        </form>

		<?php
		//	session_start();
        //  echo($_SESSION["erreurPage"]);          //affiche une erreur gérée par l'index lors d'une mauvaise rentrée d'identifiant et/ou de mot de passe
        if ($erreur != null){
        	echo($erreur);
		}
		?>
    </div>
</body>
</html>
