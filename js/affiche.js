// le bouton du résultat
// JS qui affiche le résultat sous forme de fiche d'objet

// --------------fonction affiche le résultat--------------

function affiche25k()
{
    
    const divSearch = this.closest(".divResult");

    if (divSearch.dataset.chapeau != "") {

        resultat.innerHTML = '<iframe src="../../docx/'+ divSearch.dataset.chapeau +'.htm " style="min-height :30vh; width : 100%"></iframe>';

        resultat.innerHTML += '<iframe src="../../docx/'+ divSearch.dataset.fiche +'.htm" style="min-height :60vh; width : 100%"></iframe>';
        
    } else if (divSearch.dataset.fiche != "") {

        resultat.innerHTML = '<iframe src="../../docx/'+ divSearch.dataset.fiche +'.htm" style="min-height :70vh; width : 100%"></iframe>';
        
    } else {
     
        resultat.innerHTML = '<iframe src="../../docx/CHATEAU.htm" style="min-height :70vh; width : 100%"></iframe>';

    }    
}


function affiche()
{
    // déclaration variables :
    const divSearch = this.closest(".divResult");
    var id = divSearch.dataset.value;
    var tableN = document.getElementById("tableN" + id).innerHTML;
    infoCorres = document.getElementById('infoCorres1');

    // N'ayant pas accès à tous les schémas SQL je teste l'existance des div avant
    if (document.getElementById("coordoneesObjet" + id) != null)
    {
        var coordoneesObjet = document.getElementById("coordoneesObjet" + id).innerHTML;
        var fin = coordoneesObjet.length;
    }
    var tableN = document.getElementById("tableN" + id).innerHTML;

    var lambert = "";
    var debut = 0;

    // ici on va gérer la transformations des coordonnées pour les envoyer dans le iframe du plan IGN :
    if (document.getElementById("coordoneesObjet" + id) != null)
    {
        for (compteur in coordoneesObjet + 1)
        {
            if(coordoneesObjet[compteur] != "(" && coordoneesObjet[compteur - 1] == "(")
            {
                debut = compteur;
            }
            if(coordoneesObjet[compteur - 1] == ")")
            {
                fin = compteur - 1;
                break;
            }
        }
        console.log("debut : " + debut + " fin : " + fin);

        // là on fait le découpage en suivant les indices récupérés :
        lambert = coordoneesObjet.slice(debut,fin);
        console.log("lambert : " + lambert);
    }

    // ponctuelle
    if (divSearch.dataset.geometrie == "ponctuelle")
    {
        console.log("nature de l'objet : " + divSearch.dataset.geometrie);
        // on sépare au niveau de l'espace pour les loger dans un tableau
        lambert = lambert.split(' ');
    }
    // linéaire et surfacique
    if (divSearch.dataset.geometrie == "linéaire" || divSearch.dataset.geometrie == "surfacique")
    {
        console.log("nature de l'objet : " + divSearch.dataset.geometrie);
        // On stocke les coordonnées dans un tableau
        lambert = lambert.split(',');
        console.log('lambert : ' + lambert);
        var lambert = lambert[0];
        lambert = lambert.split(" ");
    }

    console.log(divSearch.dataset);
    // 1 : fieldset image
    resultat.innerHTML = "<fieldset class=\"imageFieldset\"><p>Image de l'objet :</p><img src=\"" + divSearch.dataset.image + "\" alt=\"Image pas chargée\"></fieldset>";
    // 2 : fieldset defintion
    resultat.innerHTML += "<fieldset class=\"descriptionFieldset\"><p>Description de l'objet : " + divSearch.dataset.definition + "</p></fieldset>";
    // 3 : fieldset geometrie
    resultat.innerHTML += "<fieldset class=\"geometrieFieldset\"><p>Géométrie : " + divSearch.dataset.geometrie + "</p></fieldset>";
    // 4 : fieldset symbologie
    resultat.innerHTML += "<fieldset class=\"symbologieFieldset\"><p>Code symbologique : " + divSearch.dataset.symbologie + "</p></fieldset>";
    // 5 : fieldset classe d'entité
    resultat.innerHTML += "<fieldset class=\"classeFieldset\"><p>Classe d'entité : " + divSearch.dataset.classe + "</p></fieldset>";
    // 6 : fieldset jeu d'entité
    resultat.innerHTML += "<fieldset class=\"jeuFieldset\"><p>Jeu de classe d'entité : " + divSearch.dataset.jeu + "</p></fieldset>";
    // 7 : coordonnées d'un objet au hasard de cet objet
    resultat.innerHTML += "<fieldset class=\"geometrieRandom\"><p>Coordonnées aux hasard de cet objet (lambert 93) N,E,Z : " + lambert + "</p></fieldset>";
    // 8 : vision de cet objet sur geoportail
    resultat.innerHTML += "<fieldset class=\"map\"><p>Carte zoomer sur l'objet en question :</p><div id='miniMap'></div></fieldset>";
    // Appel de la minicarte :
    var miniMap = Gp.Map.load( "miniMap",   // identifiant du conteneur HTML
    // options d'affichage de la carte (Gp.MapOptions)
    {           
        // clef d'accès à la plateforme
        apiKey: "an7nvfzojv5wa96dsga5nk8w",
        // centrage de la carte
        center : {
            x : parseInt(lambert[0]),
            y : parseInt(lambert[1]),
            projection : "EPSG:2154"
        },
        // niveau de zoom de la carte (de 1 à 21)
        zoom : 15,
        // Couches à afficher
        layersOptions : {
            "GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD" : {}
        },
        // Outils additionnels à proposer sur la carte
        controlsOptions : {
            // ajout d'une barre de recherche
            "search" : {
                maximised : true
            }
        },
        layerswitcher : {
            // HTML cible pour les couches, par défaut, même div que la map
            div : {},
            // si le controle est ouvert ou non
            maximised : true
        },
        // Repères visuels
        markersOptions : [{
            content : "<h1>Pôle Géosciences</h1><br/><p>73 avenue de Paris, Saint-Mandé</p><br/><p><a href='http://www.pôle-géosciences.fr/index.htm' target='_blank'>Site Web</a></p>"
        }]            
    });
    // 9. petit formulaire pour envoyer la consigne de saisie :
    var role = document.getElementById("role");
    console.log(role);
    if (role.innerHTML == 'admin' || role.innerHTML == 'tech' || role.innerHTML == 'saisie')
    {
        resultat.innerHTML += "<fieldset id='fieldsetSaisieConsignes'><form method='post' id='formEnvoiConsigne' action='ajoutConsigne.php'><legend id='legendForTextAreaNouvelleConsigne' class='consigne'>Consignes nouvelles à rentrer : </legend><input type='text' name='textAreaConsigne' id='textAreaConsigne' row='5' cols='200' class='box-input' placeholder='Rentrez une consigne...'></textarea><legend id='codeSymbo' class='consigne'>Code symbologique : </legend><input id = 'input_" + divSearch.dataset.symbologie + "' value='" + divSearch.dataset.symbologie + "' name='symbologie' class='box-input'></textarea><legend id='legendForTextAreaNouvelleConsigne' class='consigne'>Consignes existantes (modifier) : </legend><input id = 'oldConsigne_" + divSearch.dataset.symbologie + "' value='" + divSearch.dataset.consigne + "' name='oldConsigne' class='box-input' placeholder='Aucune question existante'><input type='submit' name='envoyer' id='submitEnvoyer' class='boutonHeader'/></form></fieldset>";
    }
    // 10 : Consignes de saisies
    resultat.innerHTML += "<fieldset id='consigneFieldset'>Consignes existantes pour cet objet : " + divSearch.dataset.consigne + "</fieldset>"
    // 10 : Couplage avec la BD Uni
    resultat.innerHTML += "<fieldset id='couplageBDUni'> Couplages avec la BD Uni : " + infoCorres.innerHTML + "</fieldset>";
    // 11. Niveau de généralisation disponible
    tableN = tableN.split(";");
    resultat.innerHTML += "<fieldset class='niveauGeneralisation' id='niveauGeneralisation" + id + "'>Tables disponibles dans les niveaux de généralisation : " + tableN;
    // 12. Stats de la classe en question
    // crée un nouvel élément div
    var miniGraph = document.createElement("canvas");
    miniGraph.id = "miniGraph";
    // et lui donne un peu de contenu
    var newContent = document.createTextNode('Hi there and greetings!');
    // ajoute le nœud texte au nouveau div créé
    miniGraph.appendChild(newContent);

    // ajoute le nouvel élément créé et son contenu dans le DOM
    var currentDiv = document.getElementById('div1');
    document.body.insertBefore(miniGraph, currentDiv);
}


function pause(){
    return null
}

function clicAffiche(el) {
    
    produits = document.getElementById("selectProduit");
    
    //console.log(getCookie('produits'));
    console.log(produits.value);
    console.log("test");

    if (produits.value === "fonds25k") {
        affiche25k();
    } else {
        affiche();
    };
}



function produitsDefault(nom, value){

    var dtExpire = new Date();
    dtExpire.setTime(dtExpire.getTime() + 3600 * 1000 * 24 * 3600);

    setCookie(nom, value, dtExpire)
    console.log(getCookie(nom));
}

function setCookie(nom, valeur, expire, chemin, domaine, securite = true, SameSite = 'none'){
    document.cookie = nom + ' = ' + valeur + '  ' +
              ((expire == undefined) ? '' : ('; expires = ' + expire.toGMTString())) +
              ((chemin == undefined) ? '' : ('; path = ' + chemin)) +
              ((domaine == undefined) ? '' : ('; domain = ' + domaine)) +
              ((securite == true) ? '; secure' : '') +
              ((SameSite == undefined) ? '' : (';SameSite = ' + SameSite));
  }

  function getCookie(name){
    if(document.cookie.length == 0)
      return "default";

    var regSepCookie = new RegExp('(; )', 'g');
    var cookies = document.cookie.split(regSepCookie);

    for(var i = 0; i < cookies.length; i++){
      var regInfo = new RegExp('=', 'g');
      var infos = cookies[i].split(regInfo);
      if(infos[0] == name){
        return infos[1];
      }
    }
    return "default";
  }
    

var produits = document.getElementById("selectProduit");

/*
produits.setAttribute("value", getCookie("produits"))
//produits.addEventListener("change",produitsDefault("produits", produits.value));
produits.addEventListener("change",function() {console.log(produits.value)});
*/

// affectation de l'action
const elements = document.querySelectorAll(".podResult");
elements.forEach((el) => {
        el.addEventListener("click", affiche25k);
}); 

// ----------------------fonction tanh----------------------
Math.tanh = Math.tanh || function(x)
{
    if(x === Infinity) {
        return 1;
    } else if(x === -Infinity) {
        return -1;
    } else {
        return (Math.exp(x) - Math.exp(-x)) / (Math.exp(x) + Math.exp(-x));
    }
};

Math.atanh = Math.atanh || function(x) {
    return Math.log((1+x)/(1-x)) / 2;
};


// -------fonction de conversion lambert93 vers WGPS-------
function lambert93toWGPS(lambertE, lambertN)
{

    var constantes = {
        GRS80E: 0.081819191042816,
        LONG_0: 3,
        XS: 700000,
        YS: 12655612.0499,
        n: 0.7256077650532670,
        C: 11754255.4261
    }

    var delX = lambertE - constantes.XS;
    var delY = lambertN - constantes.YS;
    var gamma = Math.atan(-delX / delY);
    var R = Math.sqrt(delX * delX + delY * delY);
    var latiso = Math.log(constantes.C / R) / constantes.n;
    var sinPhiit0 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * Math.sin(1)));
    var sinPhiit1 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * sinPhiit0));
    var sinPhiit2 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * sinPhiit1));
    var sinPhiit3 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * sinPhiit2));
    var sinPhiit4 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * sinPhiit3));
    var sinPhiit5 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * sinPhiit4));
    var sinPhiit6 = Math.tanh(latiso + constantes.GRS80E * Math.atanh(constantes.GRS80E * sinPhiit5));

    var longRad = Math.asin(sinPhiit6);
    var latRad = gamma / constantes.n + constantes.LONG_0 / 180 * Math.PI;

    var longitude = latRad / Math.PI * 180;
    var latitude = longRad / Math.PI * 180;

    return {longitude: longitude, latitude: latitude};
}

// -------------------fonction de moyenne-------------------
function numAverage(liste)
{
    var longueur = liste.length;
    var somme = 0;
    for (let compteur = 0; compteur < longueur; compteur++){
      somme += Number(liste[compteur]);
    }
    return somme/longueur;
  }