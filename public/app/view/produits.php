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

      ?>

        <div id='resultat'>

            <select name="produit" class='box-input' id="selectProduit">
                <option value="default">-- Séléctionnez un produit cartographique --</option>
            </select>
            
            <a id="lienTelechargement" href="#" target="_blank">
            <img src="../../img/logos/download.png" alt="Télécharger le fichier" class='boutonHeader'>
            </a>
    
        </div>

        <?php

          // --------------------------PHP--------------------------

        ?>


        <?php
        session_unset();
        session_destroy();
        ?>
    
        <!--Appel des programmes JS-->
        <script src="../../../js/menu.js"></script>
        <script src="../../../js/produit.js"></script>

        <!-- SDK Géoportail -->
        <script src="../../../api/GpSDK-2D-3.1.9/GpSDK2D.js"></script>
    
      </body>
    
    </html>