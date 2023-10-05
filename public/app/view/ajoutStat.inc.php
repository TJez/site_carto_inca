<div id='stat'>
  <?php

    // Récupère le formulaire
    $definition = isset($_POST['definition']) ? $_POST['definition'] : '';
    $geometrie = isset($_POST['geometrie']) ? $_POST['geometrie'] : '';
    $symbologie = isset($_POST['symbologie']) ? $_POST['symbologie'] : '';
    $jeu = isset($_POST['jeu']) ? $_POST['jeu'] : '';
    $classe = isset($_POST['classe']) ? $_POST['classe'] : '';

    // renvoie les réponses
    echo "<p>Définition prise en compte : ".$definition."</p>";
    echo "<p>géométrie prise en compte : ".$geometrie."</p>";
    echo "<p>Code symbologique pris en compte : ".$symbologie."</p>";
    echo "<p>Jeu de classe d'entité : ".$jeu."</p>";
    echo "<p>Classe d'entité : ".$classe."</p>";

    // Construction du radical
    $radical = substr($classe, 0, -2);
    
    // requête pour connaitre les tables existantes
    $tableExiste = pg_query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'socle_carto_fxx_nico' AND table_name LIKE '".$radical."%';");

    $table_n = "";

    // construction des tables de classes d'entités :
    while ($table = pg_fetch_array($tableExiste))
    {
      // on stock les tables
      $table_n = $table['table_name'];
    }

    echo "Ici on a remplit les tables : ".$table_n;

    // requete
    $query = pg_query("SELECT symbo, COUNT (*) FROM socle_carto_fxx_nico.".$table_n." GROUP BY symbo ORDER BY symbo;");

    // sortie des stats :
    while ($table = pg_fetch_array($query))
    {
      echo "<p id='".$table['symbo']."'>".$table['symbo']." : <b class ='data' id='".$table['symbo']."'>".$table['count']."</b> éléments</p>";
    }

  ?>

  <div id="divGraph"><canvas id="graph" width="200" height="100"></canvas></div>

</div>