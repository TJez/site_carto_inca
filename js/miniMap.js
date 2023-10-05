// Algo js pour rappel mini map dans fiche objet

// votre utilisation du SDK
var miniMap = Gp.Map.load(
    "miniMap",   // identifiant du conteneur HTML
    // options d'affichage de la carte (Gp.MapOptions)
    {           
         // clef d'accès à la plateforme
         apiKey: "an7nvfzojv5wa96dsga5nk8w",
         // centrage de la carte
         center : {
            x : -4.620391,
            y : 48.268698,
            projection : "CRS:84"
         },
         // niveau de zoom de la carte (de 1 à 21)
         zoom : 15,
         // Couches à afficher
         layersOptions : {
            "GEOGRAPHICALGRIDSYSTEMS.MAPS.SCAN-EXPRESS.STANDARD" : {
            }
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
         
    }    
) ;
