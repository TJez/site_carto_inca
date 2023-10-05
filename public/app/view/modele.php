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

    <!--lien vers le CSS-->
    <link rel="stylesheet" href="../../../css/design.css">
    <link rel="stylesheet" href="../../../api/GpSDK-2D-3.1.9/GpSDK2D.css" />
    <link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

  </head>

  <body>

    <?php

      // lien vers les php
      // lien pour vérifier la connexion
      require('connectee.php');
      //  Lien de la connexion php 
      require('config.php');
      //  Lien du header qui permet de lancer les recherches 
      include('header.inc.php');
      //  Lien vers l'affichage des jeux de données 
      include('jeu.inc.php');
      // footer
      include('footer.inc.php');

        echo "<div id='resultat'>";

        // Là, on fait notre programme
        

        echo "</div>";


        ?>
    
        <!--Appel des programmes JS-->
        <script src="../../../js/menu.js"></script>
        <!-- SDK Géoportail -->
        <script src="../../../api/GpSDK-2D-3.1.9/GpSDK2D.js"></script>
    
      </body>
    
    </html>