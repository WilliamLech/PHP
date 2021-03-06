<?php
$this->load->helper('html');
$this->load->helper('form');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/page_inscription.css">          <!--liaison avec le css correspondant-->
    <meta charset="UTF-8">
    <title>Inscription</title>                  <!--nom de la page-->
</head>
<body>
    <div class="inscription">
		<header>Inscription</header>
		<?php
		$this->load->helper('directory'); //charge le dossier helper
		$dir = "images/"; //chemin jusqu'au fichier
		$map = directory_map($dir);
		?>
		<img src="<?php echo base_url($dir)."/user.png";?>" alt="" height="100">          <!--liaison avec l'image présente sur la page-->
		<?php echo form_open('utilisateur/newUser'); ?>               <!--envoi vers le controller utilisateur pour exécuter la fonction newUser-->
			<input type="text" name="userName" placeholder="Nom d'utilisateur"><br/><br/>   <!--formulaire pour rentrer le nom d'utilisateur que la personne veut utiliser-->
			<input type="password" name="psw" placeholder="Mot de passe"><br/><br/>         <!--formulaire pour rentrer le mot de passe que la personne veut utiliser-->
			<input type="email" name="mail" placeholder="Adresse mail"><br/><br/>           <!--formulaire pour rentrer l'adresse mail de la personne-->
			<input type="tel" name="tel" placeholder="Num. de téléphone"><br/><br/>         <!--formulaire pour rentrer le numéro de téléphone de la personne-->
			<input type="submit" name='Inscription' value="S'inscrire"><br/>                <!--bouton permettant de vérifier l'existence ou non du nom d'utilisateur afin de s'inscrire-->
			<?php          //affiche une erreur lorsque tous les champs ne sont pas renseignés
			if ($erreur != null){
				echo($erreur);
			}
			?>
		</form>
		<?php echo form_open('utilisateur/index'); ?>   <!--envoi vers le controller utilisateur pour exécuter la fonction index-->
		<input type="submit" value="Retour">        <!--bouton permettant de retourner à la page d'accueil-->
		</form>
    </div>

</body>
</html>
