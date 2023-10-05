<!--Début test php-->
<!DOCTYPE html>
<html lang="fr">

  <head>

    <title>Projet INCA</title>
    
    <!--Métadonnées site-->
    <meta charset="UTF-8">
    <meta name="auteur" content="Eckmul">
    <meta name="language" content="french">

    <!-- Fichier JQuery -->
    <script src="../../../js/JQuery/jquery-3.6.0.min.js"></script>

    <!--lien vers les CSS-->
    <link rel="stylesheet" href="../../../css/design.css">
    <link rel="stylesheet" href="../../../api/GpSDK-2D-3.1.9/GpSDK2D.css" />
  
  </head>

  <!--Début body, ici les commandes php-->
  <body>

    <?php
      

      // lien pour vérifier la connexion
      require('connectee.php');
      // footer
      include('footer.inc.php');
      // lien vers les php
      //  Lien de la connexion php 
      require('config.php');
      //  Lien du header qui permet de lancer les recherches 
      include('header.inc.php');
      //  Lien de l'affichage des recherches 
      include('recherche.inc.php');
      //  Lien vers l'affichage des jeux de données 
      include('jeu.inc.php');
      //lien vers le choix du type de produits
      include('type_produits.inc.php');
      //lien vers la visualisation du contenu des produits
      include('visu.inc.php');


    ?>

    <div id="jeu"></div>

    <!--Appel des programmes JS-->
    <script src="../../../js/affiche.js"></script>
    <script src="../../../js/menu.js"></script>
    <!-- SDK Géoportail -->
    <script src="../../../api/GpSDK-2D-3.1.9/GpSDK2D.js"></script>

  </body>

</html>