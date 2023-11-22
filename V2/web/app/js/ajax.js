/*****************************************************************/
function listeFiltreProduits(prod) {
  /* Fonction permettant de tirer les produits suivant leur identifiant et d'Ã©xecuter le code
	de la page "listeProduit.php" et implÃ©menter son contenu dans la div d'id "tableau"*/
  if (prod == 0) return;
  if (window.fetch) {
    choix = new FormData();
    choix.append("choix", prod);
    let header = {
      method: "post",
      body: choix,
    };
    window
      .fetch("listeProduits.php", header)
      .then((res) => res.text())
      .then((res) => {
        const el = document.getElementById("tableau");
        el.innerHTML = res;
      })
      .catch((res) => {
        console.error(res);
      });
  }
}

function listeFiltreProduitsIndex(prod) {
  /* Fonction permettant de tirer les produits suivant leur identifiant et d'Ã©xecuter le code
	de la page "listeProduitIndex.php" et implÃ©menter son contenu dans la div d'id "tableau"*/
  if (prod == 0) return;
  if (window.fetch) {
    choix = new FormData();
    choix.append("choix", prod);
    let header = {
      method: "post",
      body: choix,
    };
    window
      .fetch("listeProduitIndex.php", header)
      .then((res) => res.text())
      .then((res) => {
        const el = document.getElementById("tableau");
        el.innerHTML = res;
      })
      .catch((res) => {
        console.error(res);
      });
  }
}
