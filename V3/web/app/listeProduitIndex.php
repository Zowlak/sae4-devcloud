<?php
header('Content-type: text/plain');
include('fonction.php');
include('formulaire.php');
if (!empty($_POST) && isset($_POST["choix"])){		

    // Si le choix est "Tous les produits", on sélectionne tous les produits de la BDD et on les affiche dans un tableau
    if ($_POST["choix"] == '100'){
        $tabs=afficherTous();
        afficheTableauCRUD($tabs);
    }
    // Sinon on affiche juste le produit choisi
    else{
        afficheTableau(listeProduitsIndex($_POST["choix"]));
    }
}
?>