

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

        // message confirmation envoi consigne
        echo "consigne envoyé";
        if(isset($_POST['envoyer']))
        {
          $symbo = $_POST['symbologie'];
          $consigne = $_POST['textAreaConsigne'];
          $oldConsigne = $_POST['oldConsigne'];
          echo "<p>symbo : ".$symbo."</p>";
          echo "consigne : ".$consigne."</p>";
          
          //requête pour la consigne
          if ($oldConsigne == '')
          {
            $ajoutConsigne = pg_query("UPDATE x_inca_xx SET consigne = '".$consigne."' WHERE symbologie = '".$symbo."';");  
          }
          else
          {
            $ajoutConsigne = pg_query("UPDATE x_inca_xx SET consigne = '".$oldConsigne." / ".$consigne."' WHERE symbologie = '".$symbo."';");
          }
        }
        echo "</div>";


        ?>
    
        <!--Appel des programmes JS-->
        <script src="../../../js/menu.js"></script>
    
      </body>
    
    </html>