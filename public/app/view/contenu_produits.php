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

      include('visu.inc.php');
      // footer
      include('footer.inc.php');

        echo "<div id='resultat'>";

        // Là, on fait notre programme
        // on vérifie si le formulaire est soumis
        if(isset($_POST['visu']))
        {
          // on récupère les données du form
          $produit = $_POST['selectProduit'];

          $queryJeuProduits ="SELECT p.".$produit." from documentation.produits as p;";
          
          $result = pg_query($queryJeuProduits) or die('Échec de la requête : ' . pg_last_error());

          echo "<p>".ucfirst($produit)."</p>
            <table>
              <tr>
              <th>Objet</td>
              <th>Niveau de généralisation</td>
              </tr>";
  ;

          while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
        {
            foreach ($line as $objet)
            {
              if (substr($objet, -3, 1) == '_')
              {
                echo "<tr>
                <td>".substr($objet, 0, -3)."</td>
                <td>".substr($objet, -2, 2)."</td>
                </tr>";
  
              }
              else
              {
                echo "<tr>
                <td>".$objet."</td>
                </tr>";
              }
            }
        }          

        }
        echo "</table>";

        echo "</div>";

        ?>
    
        <!--Appel des programmes JS-->
        <script src="../../../js/search.js"></script>
        <script src="../../../js/affiche.js"></script>
        <script src="../../../js/menu.js"></script>
    
      </body>
    
    </html>





