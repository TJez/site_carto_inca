<div id="resultat">

    <?php

        // Récupère la recherche
        $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';
        // on enlève les apostrophes à la recherche pour qu'elle ne renvoie pas d'erreur
        $recherche = str_replace("'", ' ', $recherche);

        // 1ère requête de recherche pour compter les résultats
        $resultSearch = pg_query("SELECT * FROM x_inca_xx WHERE lower(unaccent(definition)) LIKE lower('%".$recherche."%') OR symbologie LIKE '%".strtoupper($recherche)."%' OR jeu_classe_entite LIKE '%".strtoupper($recherche)."%' OR classe_entite LIKE '%".$recherche."%';");

        // compteur pour l'affichage des résultats
        $longueur = 0;
        
        // compte le nombre de résultat
        while( $reponse = pg_fetch_array($resultSearch))
        {
            $longueur += 1;
        }

        // géométrie par défaut
        $geometrie = 'inconnue';

        if ($longueur == 578)
        {
            // Si l'on est à la page d'accueil ou que rien n'a été rentrée dans la barre de recherche
            echo "<p>Bienvenue sur le site de la BDD INCA !</p>";
        }
        // Si le nombre de résultat est vide
        elseif ($longueur == 0)
        {
            echo "<p>Bienvenue sur le site de la BDD INCA, <br />Résultat de la recherche :</p><p>Aucun résultat</p>";
        }
        else

        {
            $comptRech = 0;
            // requête relancé dans la boucle car multi-requête dans les objets trouvés
            $resultSearch = pg_query("SELECT * FROM x_inca_xx WHERE LOWER(unaccent(definition)) LIKE LOWER(unaccent('%$recherche%')) OR symbologie LIKE LOWER(unaccent('%$recherche%')) OR jeu_classe_entite LIKE UPPER(unaccent('%$recherche%')) OR classe_entite LIKE LOWER(unaccent('%$recherche%')) LIMIT 10;");
            if ($longueur == 1)
            {
                echo "<p>".$longueur." résultat trouvé</p><p>Résultat de la recherche :</p>";
            }
            else
            {
                echo "<p>".$longueur." résultats trouvés</p><p>Résultat de la recherche :</p>";
            }
            
            while( $reponse = pg_fetch_array($resultSearch))
            {
                // radical de la classe
                $radical = substr($reponse['classe_entite'], 0, -2);

                // gestion des géométries SPL
                if ( $reponse['geometrie'] == 'S')
                {
                    $geometrie = 'surfacique';
                }
                elseif ( $reponse['geometrie'] == 'P')
                {
                    $geometrie = 'ponctuelle';
                }
                elseif ( $reponse['geometrie'] == 'L')
                {
                    $geometrie = 'linéaire';
                }
                $comptRech += 1;

                echo "<fieldset><div class=\"divResult\" id=\"divResult".$comptRech."\" data-value=\"".$comptRech."\" data-definition=\"".$reponse['definition']."\" data-geometrie=\"".$geometrie."\" data-symbologie=\"".$reponse['symbologie']."\" data-image=\"../../img/".$reponse['symbologie'].".PNG\" data-classe=\"".$reponse['classe_entite']."\" data-jeu=\"".$reponse['jeu_classe_entite']."\" data-consigne=\"".$reponse['consigne']."\"><div class=\"podResult\" id=\"podResult".$comptRech."\" data-value=\"".$comptRech."\">".$comptRech." : ".$reponse['definition']."</div><p> (".$geometrie.")</p>";

                // affichage des tables dispo dans la table socle_carto_xx
                $tables = [];
                // verification existance des tables :
                $tableExiste = pg_query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'socle_carto_fxx_nico' AND table_name LIKE '".$radical."%';");

                while ($table = pg_fetch_array($tableExiste))
                {
                    // on sort les tables
                    array_push($tables, $table['table_name']);

                    // requête sur les tables existantes
                    $resultTable = pg_query("SELECT st_astext(geometrie) FROM socle_carto_fxx_nico.".$table['table_name']." LIMIT 1;");
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
                            // sortie des coordonnées en Lambert 93 trouver dans le table_name
                            
                            echo  "<div class='coordonneesObjet' id='coordoneesObjet".$comptRech."'>";
                            echo $resultTable["st_astext"]." ".$requete['st_astext'];
                            echo "</div>";
                            // requete  pour correspondance BD Uni
                            echo "<div class='infoCorres' id=infoCorres".$comptRech.">";
                            $bdUni = pg_query("SELECT * FROM \"bd_uni_socle_carto\" WHERE table_destination = '".$table['table_name']."';
                            ");
                            while ($req = pg_fetch_array($bdUni))
                            {
                                echo nl2br($req['id']."\n".$req['table_origine']."\n".$req['table_destination']."\n".$req['filtre']."\n");
                            }
                            echo "</div>";
                        }
                    }
                }
                // echo des tables n
                echo "<div id='tableN".$comptRech."' class='tables'>";
                for ($count = 0; $count <= count($tables) -1; $count++)
                {
                    echo $tables[$count].", ";
                }
                
                
                echo "</div></fieldset>";
            }
        }
    ?>
    
</div>