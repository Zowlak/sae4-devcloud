<?php
	session_start();
	include "fonction.php";
	include "formulaire.php";
?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<?php
		if(!empty($_SESSION) && estAdmin($_SESSION['login'])=="admin"){
			?>
			<title>Lebonmanga - Espace admin</title>
		<?php
		}
		else{
			?>
			<title>Lebonmanga - Espace client</title>
		<?php
		}
		?>
		<link href="css/bootstrap.min.css" rel="stylesheet"> 
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<script src="js/ajax.js" type="text/javascript"></script>
	</head>
	<body>
		<h1> Accueil </h1>
		<?php 
			//Si l'utilisateur n'est pas connecté on le redirige vers page de connexion
			if(empty($_SESSION)){
				echo"Redirection";
				redirect("connexion.php",1);
			}
			// Sinon si c'est un client, on affiche ses produits achetés
			elseif(typeCompte($_SESSION['login'])=='client') {afficheMenu();
				 $tab=afficherClient($_SESSION['login']);
				 afficheTableau($tab);}
			// Sinon si c'est un représentant, on affiche les produits qu'il vends
			elseif(typeCompte($_SESSION['login'])=='rep') {afficheMenu();
				$tab=afficherVen($_SESSION['login']);
				afficheTableau($tab);}
			//Sinon on affiche juste un texte pour un admin
			else{
				afficheMenu();
				echo '<h2> Bienvenue sur votre espace admin </h2>';
			}
			// Si il y a une session et que l'utilisateur clique sur "Voir produits", on lui affiche un
			// formulaire dynamique Ajax qui affiche les informatiosn du produit qu'il choisi dans le select
			if(!empty($_SESSION) && !empty($_GET) && isset($_GET['action']) && $_GET['action']=="tri" ){
				afficheMenu();
				afficheFormulaireAJAXIndex();
			}

			?>
			<div id="tableau"></div>
			<?php
			// Si il appuie sur "Deconnexion", fin de la session et redirigé vers page de connexion
			if(!empty($_SESSION) && !empty($_GET) && isset($_GET['action']) && $_GET['action']=="deconnection" ){
				echo '<h1>Vous êtes déconnecté.</h1>';
				session_destroy();
				$_SESSION=array();
				redirect("connexion.php",3);
			}
		?>	
	</body>
	<footer class="page-footer">
<!-- Copyright -->
<div class="footer-copyright text-center py-3 fixed-bottom bg-dark"> 
    <a id="foot-text"> © 2023 - SILLIAU Kévin</a> 
</div>
<!-- Copyright -->

</footer>
</html>