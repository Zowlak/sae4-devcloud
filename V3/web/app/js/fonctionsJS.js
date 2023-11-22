function validateLog() {
  // Fonction permettant de vérifier qu'un mail contient une majuscule et un @
  var msg;
  var retour;
  var str = document.getElementById("id_mail").value;
  if (str.match(/[A-Z]/g) && str.match(/[@]/g)) {
    retour = true;
  } else {
    msg =
      "<p style='color:red'>Identifiant incorrect, au moins une majuscule et un caractère spécial nécessaires</p>";
    document.getElementById("alert").innerHTML = msg;
    retour = false;
  }
  return retour;
}

function validateMdP() {
  // Fonction permettant de vérifier que le mot de passe contient un chiffre, une maj, une min, un caractère spécial
  // que sa longueur est supérieure ou égale à 10
  var msg;
  var str = document.getElementById("floatingPassword").value;
  if (
    str.match(/[0-9]/g) &&
    str.match(/[A-Z]/g) &&
    str.match(/[a-z]/g) &&
    str.match(/[^a-zA-Z\d]/g) &&
    str.length >= 10
  )
    msg = "<p style='color:green'>Mot de passe fort.</p>";
  else msg = "<p style='color:red'>Mot de passe faible.</p>";
  document.getElementById("alert").innerHTML = msg;
}
