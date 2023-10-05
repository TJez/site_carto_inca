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

    <body>

        <?php

            $comptRech = 1;
            $geometrie = "inconnu";

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
            <p>
                Ici, vous pouvez explorez geoportail avec la couche "Plan IGN", dans les recherches vous pouvez aussi cliquer sur des objets pour les afficher sur cette carte
            </p>

            <p>Ici c'est le SDK : </p>
            <select name="selectGeneralisation" id="selectGeneralisation" class='box-input'>
                <option value="default">--Choississez un niveau de généralisation--</option>
                <option value="N0">N0</option>
                <option value="N10">N10</option>
                <option value="N25">N25</option>
                <option value="N50">N50</option>
                <option value="N99">N99</option>
            </select>
            <div id="mapDiv"></div>

            <!-- Boutons pour changer les couches -->
            

        </div>

        <!--Appel des programmes JS-->
        <script src="../../../js/search.js"></script>
        <script src="../../../js/menu.js"></script>
        <!-- SDK Géoportail -->
        <script src="../../../api/GpSDK-2D-3.1.9/GpSDK2D.js"></script>
        <!-- fichier qui utilise Géoprotail -->
        <script src="../../../js/map.js"></script>
        <script src="../../../js/generalisation.js"></script>

    </body>

</html>