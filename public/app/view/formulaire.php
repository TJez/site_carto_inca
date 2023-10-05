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

            $comptRech = 1;
            $geometrie = "inconnu";

            // lien vers les php
            // lien pour vérifier la connexion
            require('connectee.php');
            // Lien de la connexion php 
            require('config.php');
            //  Lien du header qui permet de lancer les recherches 
            include('header.inc.php');
            //  Lien vers l'affichage des jeux de données 
            include('jeu.inc.php');
            // footer
            include('footer.inc.php');

        ?>

        <div id='resultat'>
            <p>Ici vous pouvez ajouter un objet dans la base de données INCA :</p>

            <fieldset id="formulaireAjoutObjet" class="formulaire">
                <form method="post" id="ajoutObjet" action="ajoutObjet.php">
                    <p>                    
                        <label for="definition">Définition : </label>
                        <input type="text" name="definition" id="areaDefinition" placeholder="Définition" class="box-input">
                    </p>
                    <p>
                        <label for="geometrie">Géométrie : </label>
                        <input type="radio" name="geometrie" id="areaGeometriePonctuel"     value="P" class="box-input" checked="checked">Ponctuel
                        <input type="radio" name="geometrie" id="areaGeometrieLineaire" value="L" class="box-input">Linéaire
                        <input type="radio" name="geometrie" id="areaGeometrieSurfacique" value="S" class="box-input">Surfacique
                    </p>
                    <p>                    
                        <label for="symbologie">Code symbologique : </label>
                        <input type="text" name="symbologie" id="areaSymbologie" placeholder="Code Symbologique" class="box-input">
                    </p>
                    <p>
                        <label for="jeu">Jeu de classe d'entité : </label>
                        <select class='box-input' name="jeu" id="selectJeu">
                            <option value="default">--Séléctionner un jeu de classe d'entité--</option>
                        </select>
                    </p>
                    <p>
                        <label for="classe">Classe d'entité : </label>
                        <select  class='box-input' name="classe" id="selectClasse">
                            <option value="default">--Séléctionner une classe d'entité--</option>
                        </select>
                    </p>
                    <p>
                        <label for="Consignes">Consignes d'entrée pour l'objet : </label>
                        <textarea name="consigne" id="consigneTextArea" class="box-input" rows="10" cols="50" placeholder="Écrivez les consignes d'entrée pour l'objet en question..."></textarea>
                    </p>
                <input type="submit" class='boutonHeader'name="envoyer" id="submitEnvoyer">
                </form>
            </fieldset>

        </div>

        <!--Appel des programmes JS-->
        <script src="../../../js/search.js"></script>
        <script src="../../../js/affiche.js"></script>
        <script src="../../../js/menu.js"></script>
        <script src="../../../js/fillSelectClasse.js"></script>

    </body>

</html>