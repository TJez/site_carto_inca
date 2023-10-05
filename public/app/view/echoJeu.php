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


      $comptRech = 0;
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
      //lien vers le choix du type de produits
      include('type_produits.inc.php');
      // footer
      include('footer.inc.php');

      if(!empty($_SESSION))
      {
        //requete envoyer dans PG ADMIN
        $resultSearch = pg_query("SELECT * from documentation.symbole s join documentation.produits p on s.symbole=p.".$_SESSION['produit']." join documentation.classe  as c on s.classe=c.classe where s.classe='".$_POST['jeu']."' or c.jeu='".$_POST['jeu']."' order by c.jeu");
      }else{
        $resultSearch = pg_query("SELECT * from documentation.symbole s join documentation.classe  as c on s.classe=c.classe where s.classe='".$_POST['jeu']."' or c.jeu='".$_POST['jeu']."' order by c.jeu");
      }
      
      
      // compteur pour l'affichage des résultats
      $longueur = 0;

      // compte le nombre de résultat
      while( $reponse = pg_fetch_array($resultSearch))
      {
          $longueur += 1;
      }

      echo "<div id='resultat'><br>Il existe ".$longueur." objets suivants dans le jeu ou la classe ".$_POST['jeu']." :</br>";

      if(!empty($_SESSION))
      {
        //requete envoyer dans PG ADMIN
        $resultSearch = pg_query("SELECT * from documentation.symbole s join documentation.produits p on s.symbole=p.".$_SESSION['produit']." join documentation.classe  as c on s.classe=c.classe where s.classe='".$_POST['jeu']."' or c.jeu='".$_POST['jeu']."' order by c.jeu");
      }else{
        $resultSearch = pg_query("SELECT * from documentation.symbole s join documentation.classe  as c on s.classe=c.classe where s.classe='".$_POST['jeu']."' or c.jeu='".$_POST['jeu']."' order by c.jeu");
      }

      
      while( $reponse = pg_fetch_array($resultSearch))
      {
        $comptRech++;
        // radical
        // radical de la classe
        $radical = substr($reponse['classe'], 0, -2);
        
        // gestion des géométries SPL
        if ( $reponse['geom'] == 'S')
        {
          $geometrie = 'surfacique';
        }
        elseif ( $reponse['geom'] == 'P')
        {
          $geometrie = 'ponctuelle';
        }
        elseif ( $reponse['geom'] == 'L')
        {
          $geometrie = 'linéaire';
        }
        echo "<fieldset><div class=\"divResult\" id=\"divResult".$comptRech."\" data-value=\"".$comptRech."\" data-definition=\"".$reponse['symbole']."\" data-geometrie=\"".$geometrie."\" data-symbologie=\"".$reponse['symbole']."\" data-image=\"../../img/".$reponse['symbole'].".PNG\" data-classe=\"".$reponse['classe']."\" data-jeu=\"".$reponse['jeu']."\" data-chapeau=\"".$reponse['chapeau']."\" data-fiche=\"".$reponse['fiche unitaire']."\"><div class=\"podResult\" id=\"podResult".$comptRech."\" data-value=\"".$comptRech."\">".$comptRech." : ".$reponse['symbole']."</div><p> (".$geometrie.")</p>";
        // affichage des tables dispo dans la table socle_carto_xx
        // verification existance des tables :
        echo "<div id='tableN".$comptRech."'>";

        $tableExiste = pg_query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'socle_carto_fxx_nico' AND table_name LIKE '".$radical."%';");

        while ($table = pg_fetch_array($tableExiste))
        {
          // trouvez les coordonnées :
          echo  "<div class='coordonneesObjet' id='coordoneesObjet".$comptRech."'>";
          // on sort les tables
          echo $table['table_name']."; ";

          // requête sur les tables existantes
          $resultTable = pg_query("SELECT st_astext(geometrie) FROM socle_carto_fxx_nico.".$table['table_name']." ORDER BY RANDOM() LIMIT 1;");
          // erreur de renvoi
          if (!$resultTable)
          {
            echo "<p> Une erreur s'est produite dans la recherche des coordonnées</p>";
            exit;
          }
          // renvoi correct
          else
          {
            // Stockage pour la requête sur la BD Uni pour plus tard
            $classe_entite = $reponse['classe_entite'];
            while($requete = pg_fetch_array($resultTable))
            {
              echo $resultTable["st_astext"]." ".$requete['st_astext'];
              // requete  pour correspondance BD Uni
              $bdUni = pg_query("SELECT * FROM \"bd_uni_socle_carto\" WHERE table_destination = '".$table['table_name']."';");
              while ($req = pg_fetch_array($bdUni))
              {
                echo "<div class='infoCorres'>";
                echo "<p id='idTransfert".$comptRech."'>".$req['id']."</p>";
                echo "<p id='tableOrigine".$comptRech."'>".$req['table_origine']."</p>";
                echo "<p id='tableDestination".$comptRech."'>".$req['table_destination']."</p>";
                echo "<p id='filtre".$comptRech."'>".$req['filtre']."</p>";
                echo "</div>";
              }
            }
          }
        }
        echo "</div></div></fieldset>";
      }
    ?>

    <!--Appel des programmes JS-->
    <script src="../../../js/affiche.js"></script>
    <script src="../../../js/menu.js"></script>
    <!-- SDK Géoportail -->
    <script src="../../../api/GpSDK-2D-3.1.9/GpSDK2D.js"></script>

  </body>

</html>