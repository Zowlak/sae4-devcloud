<?php
	function compteExiste($mail,$pass){
		// Fonction qui vérifie qu'un compte est présent dans la BDD
		$retour = false ;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite'); 
		$mail= $madb->quote($mail);
		$pass = $madb->quote($pass);
		$requete = "SELECT login,password FROM comptes WHERE login = $mail AND password = $pass ;" ;	
		$resultat = $madb->query($requete);
		$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);
		if (sizeof($tableau_assoc)!=0) $retour = true;	
		return $retour;
	}
//**************************************************************************************************************************************/
    function estAdmin($mail){
		// Fonction qui vérifie qu'un utilisateur est admin ou non
		$retour = false ;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$mail= $madb->quote($mail);
		$requete = "select statut from comptes where login=$mail;";
		$resultat = $madb->query($requete); 
		if($resultat){
			$res=$resultat->fetch(PDO::FETCH_ASSOC);
			$retour=$res['statut'];
		}
		return $retour;		
	}

//**************************************************************************************************************************************/
	function typeCompte($mail){
		// Fonction qui vérifie le type d'utilisateur (client ou vendeur)
		$retour = false ;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$mail= $madb->quote($mail);
		$requete = "select statut,NC,NR from comptes where login=$mail;";
		$resultat = $madb->query($requete); 
		if($resultat){
			$res=$resultat->fetch(PDO::FETCH_ASSOC);
			$retour=$res;
		}
		if($res['statut']!='admin' && $res['NC']!=null){
			$retour='client';
		}
		elseif($res['statut']!='admin' && $res['NR']!=null){
			$retour='ven';
		}
		return $retour;		
	}

//**************************************************************************************************************************************/

	function statut($mail){
		// Fonction qui retourne le statut de la session (admin ou non-admin)
		$retour=0;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$mail = $madb -> quote($mail);
		$requete="SELECT statut FROM comptes WHERE login=$mail;";
		$res= $madb->query($requete);
		if($res){
			$retour=$res->fetch(PDO::FETCH_ASSOC);
			}
		return $retour;}
//**************************************************************************************************************************************/
	function afficherTous(){
		// Fonction qui permet de récupérer tous les produits de la base de données
		$retour=0;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$requete="SELECT * FROM PRODUITS;";
		$res= $madb->query($requete);
		if($res){
			$retour=$res->fetchAll(PDO::FETCH_ASSOC);
			}
		return $retour;
		}
//**************************************************************************************************************************************/
    function afficheTableau($tab){
		//Fonction qui affiche un tableau des données passées en paramètres
		echo '<table class="tabcenter">';	
		echo '<tr>';// les entetes des colonnes qu'on lit dans le premier tableau par exemple
		foreach($tab[0] as $colonne=>$valeur){		echo "<th>$colonne</th>";		}
		echo "</tr>\n";
		// le corps de la table
		foreach($tab as $ligne){
			echo '<tr>';
			foreach($ligne as $cellule)		{
				if(isset($ligne["IMAGEP"]) && $cellule==$ligne["IMAGEP"]){echo "<td><img class='images' src=$cellule alt=$cellule</td>";}
				else{echo "<td>$cellule</td>";}		
			}
			echo "</tr>\n";
		}
		echo '</table>';
	}
//**************************************************************************************************************************************/
	function AjouterCLI($nom,$ville){
		//Fonction permettant d'ajouter un client dans la BDD
		$retour=0;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$nom = $madb -> quote($nom);
		$ville = $madb -> quote($ville);
		// filtrer les paramètres	
		var_dump($nom,$ville);
		$requete="INSERT INTO CLIENTS (NOMC,VILLE) VALUES ($nom,$ville);";
		var_dump($requete);
		$retour = $madb->exec($requete);
		var_dump($retour);
		return $retour;
	}
//**************************************************************************************************************************************/
	function AjouterVEN($nom,$ville){
		//Fonction permettant d'ajouter un vendeur dans la BDD
		$retour=0;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$nom = $madb -> quote($nom);
		$ville = $madb -> quote($ville);
		// filtrer les paramètres	
		$requete="INSERT INTO VENDEURS (NOMR,VILLE) VALUES ($nom,$ville);";
		$retour = $madb->exec($requete);
		return $retour;
	}
//**************************************************************************************************************************************/
function ModifProduit($NP, $NOMP, $TOME, $PRIX, $IMAGE){
	//Fonction permettant de modifier un produit dans la BDD
	$retour = 0;
    $madb = new PDO('sqlite:bdd/lebonmanga.sqlite');	
	  $NOMP = $madb->quote($NOMP);
    $TOME = $madb->quote($TOME);
    $PRIX = $madb->quote($PRIX);
    $IMAGE = $madb->quote($IMAGE);

	$requete="UPDATE PRODUITS SET NOMP=$NOMP, TOME=$TOME, PRIX=$PRIX, IMAGEP=$IMAGE WHERE NP = $NP;";
	$resultat = $madb->exec($requete);
	if ($resultat == false)
		$retour = 0;
	else
		$retour = $resultat;
	return $retour;
}
//**************************************************************************************************************************************/
    function redirect($url,$tps)
	{
		$temps = $tps * 1000;
		
		echo "<script type=\"text/javascript\">\n"
		. "<!--\n"
		. "\n"
		. "function redirect() {\n"
		. "window.location='" . $url . "'\n"
		. "}\n"
		. "setTimeout('redirect()','" . $temps ."');\n"
		. "\n"
		. "// -->\n"
		. "</script>\n";
		
//**************************************************************************************************************************************/
	}
	function listeProduitsIndex($NP){
		//Fonction permettant de récupérer les informations d'un produit grâce à son identifiant
		$retour=false;
				$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
				$NP = $madb->quote($NP);	
				$requete = "SELECT p.NP, p.NOMP, p.TOME, p.PRIX, p.IMAGEP FROM PRODUITS p WHERE p.np = $NP" ;
				$resultat = $madb->query($requete);
				$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);//var_dump($tableau_assoc);echo "<br/>";   
				if (sizeof($tableau_assoc)!=0) $retour = $tableau_assoc;
		return $retour;
		}
//**************************************************************************************************************************************/

	function afficherClient($ID){
		//Fonction affichant les produits achetés par un client grâce à l'ID et le mail du client
		$retour=false;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$ID= $madb->quote($ID);
		$requete = "SELECT distinct P.NOMP, P.TOME, P.PRIX, P.IMAGEP FROM PRODUITS AS P INNER JOIN VENTES AS V ON P.NP=V.NP INNER JOIN comptes C ON V.NC=C.NC WHERE C.login=$ID;";
		$resultat = $madb->query($requete); 
		if($resultat){
			$res=$resultat->fetchALL(PDO::FETCH_ASSOC);
			$retour=$res;
		}
		return $retour;
	}

//**************************************************************************************************************************************/

	function afficherVen($ID){
		//Fonction affichant les produits vendus par un vendeur grâce à l'ID et le mail du vendeur
		$retour=false;
		$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');
		$ID= $madb->quote($ID);
		$requete = "SELECT distinct P.NOMP, P.TOME, P.PRIX, P.IMAGEP FROM PRODUITS AS P INNER JOIN VENTES AS V ON P.NP=V.NP INNER JOIN comptes C ON V.NR=C.NR WHERE C.login=$ID;";
		$resultat = $madb->query($requete); 
		if($resultat){
			$res=$resultat->fetchALL(PDO::FETCH_ASSOC);
			$retour=$res;
		}
		return $retour;
	}

?>