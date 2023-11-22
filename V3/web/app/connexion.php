<?php
	session_start();
	include "fonction.php";
	include "formulaire.php";
?>
<!DOCTYPE html>
<html lang="fr" >
	<head>
		<meta charset="utf-8">
		<title>Lebonmanga - Connexion</title>
		<script src="js/fonctionsJS.js" type="text/javascript"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet"> 
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<header>
		<nav id="visi" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
        <h1 class="navbar-brand">Lebonmanga</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Connexion</a>
            </li>
          </ul>
        </div>
        </div>
      </nav>
	<header>
	<body><?php
		if(empty($_SESSION)){
			// Si il n'y a pas de session, on affiche le formulaire de connexion
			afficherFormulaireConnexion();
		}
		// test de la connexion
		if(empty($_SESSION) && !empty($_POST) && isset($_POST["login"]) && isset($_POST["pass"])){
			//echo"passé";
			//var_dump($_POST);
			if(compteExiste($_POST["login"],$_POST["pass"])){
				$_SESSION['login']=$_POST["login"];
				$_SESSION['statut']=estAdmin($_POST["login"]);
				$statut=statut($_POST['login'])['statut'];
				// On enregistre dans un fichier log le mail, l'@IP, la date, le statut et que l'authenfication a réussi
				$monfichier = fopen('log/access.log', 'a+');
				fputs($monfichier, $_POST['login']." de ".$_SERVER['REMOTE_ADDR']." à ".date('ljS \of F Y h:i:s A')." status : ".$statut." -> Authentification réussie");
				fputs($monfichier, "\n");
				fclose($monfichier);
				echo "<p>Authentification réussie de ".$_SESSION['login']."</p>";
				//On redirige l'utilisateur vers l'espace client
				redirect("index.php?action=index",3);
			}
			else{
				echo "<p>Echec de l'authentification</p>";
				// On enregistre dans un fichier log le mail, l'@IP, la date eque l'authenfication n'a pas réussi
				$monfichier = fopen('log/access.log', 'a+');
				fputs($monfichier, $_POST['login']." de ".$_SERVER['REMOTE_ADDR']." à ".date('ljS \of F Y h:i:s A')." -> Echec de authentification");
				fputs($monfichier, "\n");
				fclose($monfichier);
				redirect($_SERVER['PHP_SELF'],3);
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