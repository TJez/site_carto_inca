var selectClasse = document.getElementById("selectClasse");
var selectJeu = document.getElementById("selectJeu");
var tabJeu = [...new Set(tabJeu)];
console.log(tabJeu);

// remplir les jeux dans le sélecteur du formulaire d'ajout d'objet
for(let compteur = 0; compteur < tabJeu.length; compteur++) {
    var jeu = tabJeu[compteur];
    if (jeu[0] == jeu[0].toUpperCase())
    {
        var option = document.createElement("option");
        option.textContent = jeu;
        option.value = jeu;
        selectJeu.appendChild(option);
    }
}

// variable de jeu séléctionner avant
var valueJeu = document.getElementById("selectJeu").value;

// remplir les classes dans le sélecteur du formulaire d'ajout d'objet
selectJeu.addEventListener("change", roulant);

// on va le mettre dans une fonction pour actualiser à chaque changement
function roulant ()
{
    // on reprend la valeur du premier selecteur
    valueJeu = document.getElementById("selectJeu").value;
    console.log("La value pour le Jeu séléctionné est : " + valueJeu);
    selectClasse.options.length = 1;
    for(let compteur = 0; compteur < tabJeu.length; compteur++) {
        var jeu = tabJeu[compteur];
        if (valueJeu[0].toLowerCase() == jeu[0]) {
            var option = document.createElement("option");
            option.textContent = jeu;
            option.value = jeu;
            selectClasse.appendChild(option);
        }
    }
};