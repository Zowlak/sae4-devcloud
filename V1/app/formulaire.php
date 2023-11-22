<?php
	function afficherFormulaireConnexion(){
    // Formulaire de connexion (connexion.php)
    ?><div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
              <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Connexion</h5>
                <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateLog();">
                    <div class="form-floating mb-3">
                        <label for="floatingInput">Email</label>
                        <input type="email" name="login" class="form-control" id="id_mail" placeholder="identifiant@mail.fr" required size="20" /><p id="alert"></p></div>
                    <div class="form-floating mb-3">
                        <label for="floatingPassword">Mot de Passe</label>
                            <input type="password" name="pass" class="form-control" id="id_pass" placeholder="Mot de passe" required size="10" /></div>
                    <div class="d-grid text-center">
                        <button class="btn btn-primary btn-login text-uppercase fw-bold" name="connect" type="submit">Se connecter</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
                
        <?php
        }
    //******************************************************************************************************************************/

    function afficheMenu(){
        // Formulaire qui affiche le menu général sur toutes les pages de l'espace utilisateur / admin
            ?>
           <nav id="visi" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand">Lebonmanga</h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                        <?php 
                            if(!empty($_GET) && isset($_GET['action']) && $_GET['action']=="index"){
                        ?>
                                <a class="nav-link active" aria-current="page" href="index.php?action=index">Accueil</a>
                        <?php
                            }
                            else{
                        ?>
                                <a class="nav-link" aria-current="page" href="index.php?action=index">Accueil</a>
                        <?php
                            }
                        ?>
                        </li>
                        <li class="nav-item">
                        <?php 
                            if(!empty($_GET) && isset($_GET['action']) && $_GET['action']=="tri"){
                        ?>
                                <a class="nav-link active" aria-current="page" href="produits.php?action=tri">Voir produits</a>
                        <?php
                            }
                            else{
                        ?>
                                <a class="nav-link" aria-current="page" href="produits.php?action=tri">Voir produits</a>
                        <?php
                            }
                        ?>
                        </li>
                    <?php
                    if($_SESSION['statut']=='admin'){
                    ?>
                        <li class="nav-item">
                        <?php 
                            if(!empty($_GET) && isset($_GET['action']) && $_GET['action']=="insertion"){
                        ?>
                            <a class="nav-link active" aria-current="page" href="insertion.php?action=insertion">Insertion</a>
                        <?php
                            }
                            else{
                        ?>
                            <a class="nav-link" aria-current="page" href="insertion.php?action=insertion">Insertion</a>
                        <?php
                            }
                        ?>
                        </li>
                        <li class="nav-item">
                        <?php 
                            if(!empty($_GET) && isset($_GET['action']) && $_GET['action']=="modification"){
                        ?>
                            <a class="nav-link active" aria-current="page" href="modification.php?action=modification">Modification</a>
                        <?php
                            }
                            else{
                        ?>
                            <a class="nav-link" aria-current="page" href="modification.php?action=modification">Modification</a>
                        <?php
                            }
                        ?>
                        </li>
                    <?php
                    }
                    ?>
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php?action=deconnection">Déconnexion</a>
                        </li>
                    </ul>
                </div>
                </div>
                <a id="statuser"> <?php echo 'Votre login est '.$_SESSION['login'].'';?> </a>
          </nav>
            <?php
            }
    
//******************************************************************************************************************************/
function choixIntertion(){
    // Fonction permettant d'afficher un formulaire où l'admin choisi si il veut insérer un client ou un représentant
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="formCenter">
        <fieldset> 
            <select id="id_mail" name="choix" size="1">
                <option value="CLIENTS">Client</option>
                <option value="VENDEURS">Vendeur</option>
            </select>
            <input type="submit" value="Choix" />
        </fieldset>
    </form> <?php
    }
//******************************************************************************************************************************/
    function afficheFormulaireAjoutCliVen($choix){
    // Formulaire d'ajout client / vendeur
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="formCenter">
            <fieldset> 
            <label for="id_mail">Nom :</label><input type="nom" name="nom" id="id_mail" required size="20" /><br />
            <label for="id_pass">Ville :</label><input type="ville" name="ville" required id="id_ville" size="20" /><br />
            <input type="submit" value="<?php echo $choix; ?>" name="table" />
            </fieldset>
        </form>
        <?php
    
    }

//******************************************************************************************************************************/
function afficheFormulaireModif($NP){
    // Formulaire modification produit
    $madb = new PDO('sqlite:bdd/lebonmanga.sqlite');	
	$requete = 'SELECT DISTINCT p.NP, p.NOMP, p.TOME, p.PRIX, p.IMAGEP FROM PRODUITS p WHERE p.NP=='.$NP.'';
	$resultat = $madb->query($requete);
    if ($resultat){
        $prod = $resultat->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <form action="modification.php" method="post" class="formCenter">
        <fieldset> 
            <label for="id_np">ID produit :</label><input type="np" name="idprod" id="id_np" value="<?php echo $prod[0]["NP"];?>"/><br/>
            <label for="id_nom">Nom manga :</label><input type="nom" name="nom" id="id_nom" value="<?php echo $prod[0]["NOMP"];?>"/><br/>
            <label for="id_tome">Tome manga :</label><input type="tome" name="tome" id="id-tome" value="<?php echo $prod[0]["TOME"];?>"/><br/>
            <label for="id_prix">Prix manga :</label><input type="prix" name="prix" id="id_prix" value="<?php echo $prod[0]["PRIX"];?>"/><br/>
            <label for="id_chemimage">Chemin image :</label><input type="chemimage" name="chemimage" id="id_chemimage" value="<?php echo $prod[0]["IMAGEP"];?>"/><br/>
            <input type="submit" name="modif" value="Modifier"/>
        </fieldset>
    </form>
    <?php
    }
//******************************************************************************************************************************/
function afficheFormulaireAJAX(){
     // Formulaire dynamique ajax listant les produits présents dans la BDD
	$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');	
	$requete = 'SELECT DISTINCT p.NP, p.NOMP, p.TOME, p.PRIX, p.IMAGEP FROM PRODUITS p';
	$resultat = $madb->query($requete);
	$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);	

?>
<form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="get" class="formCenter">
<fieldset> 
<label for="id_prod">Rechercher manga par nom</label> 
<select id="id_prod" name="prod" size="1" onchange="listeFiltreProduits(this.value)">
			<option value="0">Choisir un manga</option>
			<?php
			foreach ($tableau_assoc as $ligne)	{	
				echo '<option value="'.$ligne["NP"].'">'.$ligne["NOMP"]."</option>"."\n";			
			}
            ?>
</select>
</fieldset>
</form>
<br/>
<?php
}

//******************************************************************************************************************************/

function afficheFormulaireAJAXIndex(){
    // Formulaire dynamique ajax listant les manga présents dans la BDD 
	$madb = new PDO('sqlite:bdd/lebonmanga.sqlite');	
	$requete = 'SELECT DISTINCT p.NP, p.NOMP, p.TOME, p.PRIX, p.IMAGEP FROM PRODUITS p';
	$resultat = $madb->query($requete);
	$tableau_assoc = $resultat->fetchAll(PDO::FETCH_ASSOC);	

?>
<form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="get" class="formCenter">
<fieldset> 
<label for="id_prod">Rechercher manga par nom</label> 
<select id="id_prod" name="prod" size="1" onchange="listeFiltreProduitsIndex(this.value)">
			<option value="0">Choisir un produit</option>
            <option value="100">Tous les produits</option>
			<?php
			foreach ($tableau_assoc as $ligne)	{	
				echo '<option value="'.$ligne["NP"].'">'.$ligne["NOMP"]."</option>"."\n";			
			}
            ?>
</select>
</fieldset>
</form>
<br/>
<?php
}
?>