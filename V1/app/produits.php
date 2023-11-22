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
		<h1> Découvrir les produits </h1>
		<?php 
			//Si l'utilisateur n'est pas connecté on le redirige vers page de connexion
			if(empty($_SESSION)){
				echo"Redirection";
				redirect("connexion.php",1);
			}
			// Sinon on affiche le menu
			else {afficheMenu();}

			// Si l'utilisateur a cliquer sur "Voir les produits" (action==tri)
			if(!empty($_SESSION) && !empty($_GET) && isset($_GET['action']) && $_GET['action']=="tri" ){
				// On affiche le menu ainsi qu'un formulaire ajax dynamique où on peut choisir le produit à voir
				afficheMenu();
				afficheFormulaireAJAXIndex();
			}

			?>
			<div id="tableau"></div>
			<?php
			// Si l'utilisateur clique sur "déconnexion", on détruit la session et on le redirige vers la page de connexion
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