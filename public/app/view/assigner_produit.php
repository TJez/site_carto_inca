
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

        ?>
        
        <div id='resultat'>

            <form method='post' id='menuproduits'>
    <?php    

        // requete pour les jeu de classes d'entités
        //$queryJeuProduits ='SELECT DISTINCT * FROM "documentation"."classe" ORDER BY jeu;';
        $queryJeuProduits ='SELECT s.*, c.jeu from "documentation"."classe" as c inner join "documentation"."symbole" as s on c.classe =s.classe order by c.jeu;';


        // résultat
        $resultProduits = pg_query($queryJeuProduits) or die('Échec de la requête : ' . pg_last_error());


        while ($line = pg_fetch_array($resultProduits, null, PGSQL_ASSOC))
        {
            $tabJeuProduits[] = $line; 
        }
        // Création du menu déroulant
        // On commence par le jeu "ADRESSE"
        $jeuProduits = "ADRESSE";
        $classeProduits = "a_adresse_XX";
        $comptProduits = 0;
        // echo première div "ADRESSE"
        echo "<li class='liProduits'><b  id='produitsDeploi".$jeuProduits."' class='produitsDeploi'>></b><label class='produitsDeploi' id='produitsDeploi".$jeuProduits."'>".$jeuProduits."</label><ul class='produits".$jeuProduits."' id='produits_ul'>";
        echo "<li class='liProduits'><b  id='produitsDeploi".$classeProduits."' class='produitsDeploi'>></b><label class='produitsDeploi' id='produitsDeploi".$classeProduits."'>".$classeProduits."</label><ul class='produits".$classeProduits."' id='produits_ul'>";
        // Boucle pour pacourir les jeux et les codes symbo et les renvoyer
        for ($compteur = 0; $compteur < count($tabJeuProduits); $compteur++)
        {
            //remplace jeuProduit par le suivant dans la liste et le rajoute dans la liste html
            if ($jeuProduits != $tabJeuProduits[$compteur]['jeu'])
            {
                $jeuProduits = $tabJeuProduits[$compteur]["jeu"];
                $classeProduits = $tabJeuProduits[$compteur]["classe"];
                echo "</ul></ul></li><li class='liProduits'><b  id='produitsDeploi".$jeuProduits."' class='produitsDeploi'>></b><label class='produitsDeploi' id='produitsDeploi".$jeuProduits."'>".$jeuProduits."</label><ul class='produits".$jeuProduits."' id='produits_ul'>";
                echo "<li class='liProduits'><b  id='produitsDeploi".$classeProduits."' class='produitsDeploi'>></b><label class='produitsDeploi' id='produitsDeploi".$classeProduits."'>".$classeProduits."</label><ul class='produits".$classeProduits."' id='produits_ul'>";
                echo "<li class='liProduits'><b  id='produitsDeploi".$tabJeuProduits[$compteur]["symbole"]."' class='produitsDeploi'>></b><input type=\"submit\" class='produitsDeploi' id='produitsDeploi".$tabJeuProduits[$compteur]["symbole"]."' value='".$tabJeuProduits[$compteur]["symbole"]."' name='jeu'></li>";
            }
            elseif ($classeProduits != $tabJeuProduits[$compteur]['classe'])
            {
                $classeProduits = $tabJeuProduits[$compteur]["classe"];
                echo "</li></ul><li class='liProduits'><b  id='produitsDeploi".$classeProduits."' class='produitsDeploi'>></b><label class='produitsDeploi' id='produitsDeploi".$classeProduits."'>".$classeProduits."</label><ul class='produits".$classeProduits."' id='produits_ul'>";
                echo "<li class='liProduits'><b  id='produitsDeploi".$tabJeuProduits[$compteur]["symbole"]."' class='produitsDeploi'>></b><input type=\"submit\" class='produitsDeploi' id='produitsDeploi".$tabJeuProduits[$compteur]["symbole"]."' value='".$tabJeuProduits[$compteur]["symbole"]."' name='jeu'></li>";
                }
            
            else
            { 
                echo "<li class='liProduits'><b  id='produitsDeploi".$tabJeuProduits[$compteur]["symbole"]."' class='produitsDeploi'>></b><input type=\"submit\" class='produitsDeploi' id='produitsDeploi".$tabJeuProduits[$compteur]["symbole"]."' value='".$tabJeuProduits[$compteur]["symbole"]."' name='jeu'></li>";
                }
                

        }
        echo "</ul></li></ul></li>";

    ?>
</form>

<form action=onverraplustard.php method=POST>

<select name="selectProduit" id="selectProduit" class='box-input'>
    <option value="default">--Choississez un niveau de produit--</option>
    <option value="fonds25k">Fonds 25K</option>
</select>

<table id='tableAjout' class='tableAjout'>
<?php 

if(!empty($_POST))
{
if(isset($_SESSION['tableau']) == false)
{        
    $tabJeuForm[] = $_POST['jeu'];
    $_SESSION['tableau'] = $tabJeuForm;
}
else
{
    $tabJeuForm = $_SESSION['tableau'];
    $tabJeuForm[] = $_POST['jeu'];
    $_SESSION['tableau'] = $tabJeuForm;
}

for ($compteur = 0; $compteur < count($tabJeuForm); $compteur++)
    {
        echo "<tr>
        <td>".$tabJeuForm[$compteur]."</td>
        <input type='hidden' name='tabAjout[]' value='".$tabJeuForm[$compteur]."'>
        </tr>";
    }
}

?>
 </table>

    <input type='submit' name='ajout' value='Ajouter'>
    
</form>
            

        </div>

        <!--Appel des programmes JS-->
        <script src="../../../js/search.js"></script>
        <script src="../../../js/menu.js"></script>
        <script src="../../../js/menuProduits.js"></script>

    </body>

</html>