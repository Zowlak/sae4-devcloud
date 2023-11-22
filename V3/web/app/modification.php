<?php session_start();
	include 'fonction.php';
	include 'formulaire.php';
?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<title>Lebonmanga - Vendeur - Modification</title>
		<script src="js/fonctionsJS.js" type="text/javascript"></script>
		<script src="js/ajax.js" type="text/javascript"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet"> 
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body >
		<header>
			<h1 id="test">Modification</h1>
		</header>
		<nav>
			<?php
			// Si c'est un admin, on affiche le menu
			if(!empty($_SESSION) && isset($_SESSION['statut']) && $_SESSION['statut']=="admin"){
				afficheMenu();
			}
			// Sinon on informe que l'utilisateur n'a pas les droits et on le redirige vers l'index
			elseif(!empty($_SESSION) && isset($_SESSION['statut']) && $_SESSION['statut']!="admin"){
				echo"<p> Vous n'avez pas les droits </p>";
				redirect("index.php",3);
			}
			// Sinon on lui dis de se connecter
			else{
				echo"<p>Veuillez vous connecter d'abord</p>";
				redirect("connexion.php",3);
			}

			// Si il clique sur "modification", on affiche le formulaire dynamique Ajax permettant de choisir le produit à modifier
			if(!empty($_GET) && isset($_GET['action']) && $_GET['action']=="modification"){
				afficheFormulaireAJAX();
			}
			?>
			<div id="tableau"></div>
			<?php
			// On vérifie qu'il y a bien une session et des données dans le POST
			if (!empty($_SESSION) && !empty($_POST)){
				// Si il y a une session, que le post n'est pas vide et qu'il contient les données du formulaire
				if (!empty($_SESSION) && !empty($_POST) && isset($_POST['chemimage']) && isset($_POST['modif'])){
					// on execute la fonction de modification avec les informations récupérées du formulaire
					$res = ModifProduit($_POST['nom'],$_POST['tome'],$_POST['prix'],$_POST['chemimage']);
					// Si la modification a réussi, on l'indique via un message, on enlève le formulaire et on met un bouton pour retourner au choix du produit à modifier
					if ($res!=0){
						echo '<div class="formCenter"> Modification du produit '.($_POST['nom']).' réussie.</div>';
						echo '<div class="d-grid text-center"> <a href="modification.php?action=modification"> <button class="btn btn-secondary btn-login text-uppercase fw-bold"> Retour au choix du produit à modifier </button> </a> </div>';
					}
					// Sinon on informe que la modification a échoué
					else {
						echo '<p> Échec de la modification du produit '.($_POST['nom']).'';
					}
				}
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