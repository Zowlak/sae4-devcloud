<?php
header('Content-type: text/plain');
include('fonction.php');
include('formulaire.php');
if (!empty($_POST) && isset($_POST["choix"])){		


    // On affiche le formulaire de modification pour le produit choisi 
    afficheFormulaireModif($_POST["choix"]);

}
?>