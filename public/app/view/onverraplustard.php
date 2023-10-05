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

      include('jeu.inc.php');
      // footer
      include('footer.inc.php');

        echo "<div id='resultat'>";

        // Là, on fait notre programme
        // on vérifie si le formulaire est soumis
        if(isset($_POST['ajout']))
        {
          // on récupère les données du form
          $tabAjout = $_POST['tabAjout'];
          $produit = $_POST['selectProduit'];
          
          foreach ($tabAjout as $tabAjout){

            echo $tabAjout;
            echo $produit;
            $requete = 'INSERT INTO "documentation"."produits" ('.$produit.') VALUES (\''.$tabAjout.'\');';
            $ajoutObjet = pg_query($requete);
           }           

        }

        echo "</div>";

        unset($_SESSION["tableau"]);

        ?>
    
        <!--Appel des programmes JS-->
        <script src="../../../js/search.js"></script>
        <script src="../../../js/affiche.js"></script>
        <script src="../../../js/menu.js"></script>
    
      </body>
    
    </html>





