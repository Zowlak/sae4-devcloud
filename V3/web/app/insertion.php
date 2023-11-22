<?php session_start();
	include 'fonction.php';
	include 'formulaire.php';
?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<title>Lebonmanga - Vendeur - Insertion</title>
		<script src="js/fonctionsJS.js" type="text/javascript"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet"> 
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body >
		<header>
			<h1>Insertion</h1>
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
				echo"<p>Veullez vous connecter d'abord</p>";
				redirect("connexion.php",3);
			}
			//Si il clique sur "Intertion", on lui affiche le menu de choix d'insertion d'un client ou d'un vendeur
			if(!empty($_GET) && isset($_GET['action']) && $_GET['action']=="insertion"){
				choixIntertion();
			}
			//Une fois que la réponse du choix a été récupéré, on affiche le formulaire d'insertion de client ou de vendeur
			if(!empty($_POST) && isset($_POST['choix'])){
				afficheFormulaireAjoutCliVen($_POST['choix']);
			}
			// On vérifie que tout a été renseigné (nom de la personne, sa ville, le captcha et le bouton envoyé)
            if(!empty($_POST) && isset($_POST['nom']) && isset($_POST['ville']) && isset($_POST['table'])){
					
							// Si le bouton envoyé correspondant à l'insertion d'un client, on execute la fonction d'insertion d'un client
              if($_POST['table']=="CLIENTS"){
								$res=AjouterCLI($_POST['nom'],$_POST['ville']);
							}
							// Sinon si le bouton envoyé correspond à l'insertion d'un vendeur, on execute la fonction d'insertion d'un vendeur
              elseif($_POST['table']=="VENDEURS"){
								$res=AjouterVEN($_POST['nom'],$_POST['ville']);
							}
							// On affiche un message si l'insertion est réussi
              if($res){
                echo '<p>Insertion réussie de '.$_POST['nom'].'</p>';
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