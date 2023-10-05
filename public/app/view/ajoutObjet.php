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
        if(isset($_POST['envoyer']))
        {
          // on récupère les données du form
          $definition = $_POST['definition'];
          echo "<p>La requête a été envoyé avec les paramètres suivant : </p>";
          echo "<p>Définition : ".$definition."</p>";
          $geometrie = $_POST['geometrie'];
          echo "<p>Géométrie : ".$geometrie."</p>";
          $symbologie = $_POST['symbologie'];
          echo "<p>Code symbologique : ".$symbologie."</p>";
          $jeu = $_POST['jeu'];
          echo "<p>Jeu de Classe d'entité : ".$jeu."</p>";
          $classe = $_POST['classe'];
          echo "<p>classe d'entité : ".$classe."</p>";
          $classe = $_POST['classe'];
          echo "<p>classe d'entité : ".$classe."</p>";
          $consigne = $_POST['consigne'];
          echo "<p>consigne : ".$consigne."</p>";
          $requete = 'INSERT INTO "x_inca_xx" VALUES (\''.$definition.'\',\''.$geometrie.'\',\''.$symbologie.'\',\''.$jeu.'\',\''.$classe.'\',\''.$consigne.'\');';
          echo "<p>requête : ".$requete."</p>";
        }
        $ajoutObjet = pg_query($requete);

        

        echo "</div>";

        ?>
    
        <!--Appel des programmes JS-->
        <script src="../../../js/search.js"></script>
        <script src="../../../js/affiche.js"></script>
        <script src="../../../js/menu.js"></script>
    
      </body>
    
    </html>