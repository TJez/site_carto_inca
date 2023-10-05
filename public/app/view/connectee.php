<!-- Div pour les informations de connexion -->
<div id="sucess">


    <!-- Pas connecté -->
    <?php
        // Initialiser la session
        session_start();
        // Vérifiez si l'utilisateur est connecté, sinon proposer la connexion
        if(!isset($_SESSION["role"])){
            $username = 'visiteur';
            $role = 'visiteur';
            echo "<br /><a id=\"boutonConnexion\" href='login.php' class=\"boutonHeader\">Connectez-vous</a>";
        }
        //Connecté
        // Div pour ajouter un objet en étant saisisseur
        if(isset($_SESSION["username"]) && ($_SESSION["username"] == 'Saisie' || $_SESSION["username"] == 'Admin')){
            $username = $_SESSION["username"];
            $role = $_SESSION['role'];
            echo "<br /><a id=\"boutonFormulaire\" href='formulaire.php' class=\"boutonHeader\"><p>Ajouter un objet</p><p>à la BDD INCA</p></a>";
            echo "<a class='boutonHeader' id='deconnexion' href=\"logout.php\">Déconnexion</a>";
            // Div pour créer un autre compte en étant admin
            if($_SESSION["username"] == 'Admin'){
                echo "<br /><a id='boutonCreationCompte' href='register.php' class='boutonHeader'><p>Créer un compte</p></a>";
            }
        }

        // cas rajouté du Tech
        if(isset($_SESSION["username"]) && ($_SESSION["role"] == 'Technicien')) {
            $username = $_SESSION["username"];
            $role = $_SESSION["role"];
            echo "<a class='boutonHeader' id='deconnexion' href=\"logout.php\">Déconnexion</a>";
        }

    ?>

    <!-- Message de bienvenue à l'utilisateur -->
    <p>Bienvenue <?php echo $username; ?> ! <br />Vous êtes connecté avec le rôle de <div id="role"><?php echo $role; ?></div></p>

</div>