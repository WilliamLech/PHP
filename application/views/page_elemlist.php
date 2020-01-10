<?php
$this->load->helper('html');
$this->load->helper('url');
$this->load->helper('form');
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
		echo("Il s'agit de la liste : ".$nameList."<br/>");
		if ($roleAcces == 'Proprietaire') {				//appel d'une fonction permettant d'ajouter un collaborateur à une liste
			echo(form_open('liste/addMember').
				" <input type=\"text\"  name=\"nomPerson\" size=\"40\"/><input type=\"submit\" name=\"AjoutPerson\" value=\"Ajouter une personne\">
            </form>");
		}

		if ($erreur != null){
			echo($erreur."<br/>");		//affiche une erreur lorsque le nom du collaborateur n'existe pas dans la base de données
		}
        ?>
    </div>
    <div class="ajout">
		<?php echo form_open('element/addElem'); ?>                 <!--envoi vers le controller element pour exécuter la fonction addElem-->
            <input type="text"  name="NomElem" size="20" placeholder="Nom Element"/><br/>            <!--formulaire permettant de rentrer le nom des éléments de la liste-->
            <input type="text"  name="DescElem" size="20" placeholder="Description"/><br/>           <!--formulaire permettant de rentrer la description des éléments de la liste-->
            <input type="submit" name="CreaElem" value="Créer l'élément">         <!--bouton permettant d'ajouter l'élément dans la base de données-->
        </form>
    </div>
    <div class="fiches">
        <?php
			$n=1;
			$infoList = $listElem;
			foreach($infoList as $item){			//appel d'une fonction permettant d'afficher les éléments de la liste
				echo("Element n°".$n." nommé ".$item['NomElem']." ajouté le ".$item['DateDElem']." dit :  ".$item['DescElem']."<br/>");
				$n++;
			}
			if ($n==1) echo ("Aucun élément dans la liste.");
        ?>
        <div class="blocListe"></div>
    </div>

    <div class="footer">
		<?php echo form_open('utilisateur/retourProfil'); ?>             <!--envoi vers le controller utilisateur pour exécuter la fonction retourProfil-->
			<input type="submit" value="Retour">          <!--bouton permettant de retourner à la page des listes-->
        </form>
    </div>
</div>
</body>
</html>
