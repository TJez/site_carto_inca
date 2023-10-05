<form method='post' id='menu' action='echoJeu.php' method='post'>
    <?php    

        if(isset($_SESSION["role"]) && $_SESSION["role"] != 'visiteur'){
            $queryJeu = 'SELECT DISTINCT c.jeu, c.classe from "documentation"."symbole" as s join "documentation"."produits" as p on s.symbole=p.'.$_SESSION['produit'].' join "documentation"."classe"  as c on s.classe=c.classe order by c.jeu';
            
            $result = pg_query($queryJeu) or die('Échec de la requête : ' . pg_last_error());

            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
            {
                foreach ($line as $col_value)
                {
                    $tabJeu[] = $col_value;
                }
            }

            // Création du menu déroulant
        // On commence par le jeu "ADRESSE"
        $jeu = "ADRESSE";
        // echo première div "ADRESSE"
        echo "<li class='liJeu'><b  id='boutonDeploi".$jeu."' class='boutonDeploi'>></b><input type='submit' class='boutonJeu' id=".$jeu." value=".$jeu." name='jeu'>";
        // Boucle pour pacourir les jeux et les codes symbo et les renvoyer
        for ($compteur = 0; $compteur < count($tabJeu); $compteur++)
        {
            // On compare la première lettre sortie à une majuscule pour savoir si c'est un jeu ou un code symbo
            if (ctype_upper(substr($tabJeu[$compteur], 0, 1)) && $tabJeu[$compteur] != $jeu)
            {
                // c'est un jeu (stockage de valeur)
                $jeu = $tabJeu[$compteur];
                echo "</li><li class='liJeu'><b  id='boutonDeploi".$jeu."' class='boutonDeploi'>></b><input type='submit' class='boutonJeu' id=".$jeu." value=".$jeu." name='jeu'>";
            }
            elseif (ctype_lower(substr($tabJeu[$compteur], 0, 1)))
            {
                echo "<ul class=".$jeu." id='menu_ul'><input type=\"submit\" class='boutonJeu' id='".$tabJeu[$compteur]."' value='".$tabJeu[$compteur]."' name='jeu'></ul>";
            }
        }
        echo "</li>";

        }
        else{
            // requete pour les jeu de classes d'entités
            $queryJeu = 'SELECT DISTINCT jeu, classe FROM "documentation"."classe" ORDER BY jeu;';
            // résultat
            $result = pg_query($queryJeu) or die('Échec de la requête : ' . pg_last_error());

            while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
            {
                foreach ($line as $col_value)
                {
                    $tabJeu[] = $col_value;
                }
            }

            // Création du menu déroulant
            // On commence par le jeu "ADRESSE"
            $jeu = "ADRESSE";
            // echo première div "ADRESSE"
            echo "<li class='liJeu'><b  id='boutonDeploi".$jeu."' class='boutonDeploi'>></b><input type='submit' class='boutonJeu' id=".$jeu." value=".$jeu." name='jeu'>";
            // Boucle pour pacourir les jeux et les codes symbo et les renvoyer
            for ($compteur = 0; $compteur < count($tabJeu); $compteur++)
            {
                // On compare la première lettre sortie à une majuscule pour savoir si c'est un jeu ou un code symbo
                if (ctype_upper(substr($tabJeu[$compteur], 0, 1)) && $tabJeu[$compteur] != $jeu)
                {
                    // c'est un jeu (stockage de valeur)
                    $jeu = $tabJeu[$compteur];
                    echo "</li><li class='liJeu'><b  id='boutonDeploi".$jeu."' class='boutonDeploi'>></b><input type='submit' class='boutonJeu' id=".$jeu." value=".$jeu." name='jeu'>";
                }
                elseif (ctype_lower(substr($tabJeu[$compteur], 0, 1)))
                {
                    echo "<ul class=".$jeu." id='menu_ul'><input type=\"submit\" class='boutonJeu' id='".$tabJeu[$compteur]."' value='".$tabJeu[$compteur]."' name='jeu'></ul>";
                }
            }
            echo "</li>";   
        } 

        

    ?>

</form>