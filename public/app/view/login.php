<!DOCTYPE html>
<html>

  <head>

    <title>Projet INCA</title>
      
    <!--Métadonnées site-->
    <meta charset="UTF-8">
    <meta name="auteur" content="Eckmul">
    <meta name="language" content="french">

    <!--lien vers le CSS-->
    <link rel="stylesheet" href="../../../css/design.css">
    <link href="https://fonts.googleapis.com/css2?family=Train+One&display=swap" rel="stylesheet">

  </head>

  <body>

    <?php
      // Ligne d'appel de l'algorithme de connexion
      require('config.php');
      session_start();
      // le username a été rentré par l'utilisateur
      if (isset($_POST['username']))
      {
        // Données du formulaire
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        // vérifie username et mdp
        $query = "SELECT * FROM documentation.\"authentification\" WHERE username='$username' and password='$password'";
        $result = pg_query($query) or die(pg_last_error());
        $rows = pg_num_rows($result);
        // 1 ligne = connexion réussie
        if($rows==1)
        {
          $_SESSION['username'] = $username;

                  // récupère le rôle
        while ($reponse = pg_fetch_array($result))
        {
          $_SESSION['role'] = $reponse['role'];
          $_SESSION['produit'] = $reponse['produit'];
        }
          header("Location: index.php");
        }

        else{
          $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }

      }
    ?>

    <form id="connexion" action="" method="post" name="login">
      
      <h1 id="titre">Connexion</h1>
      
      <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
      
      <input type="password" class="box-input" name="password" placeholder="Mot de passe">
      
      <input type="submit" value="Connexion " name="submit" class="boutonHeader">
      
      <?php if (! empty($message)) { ?>
        <p id="errorMessage"><?php echo $message; ?></p>
      <?php } ?>

    </form>

    <form id="visiteur" action="index.php" method="post" name="visiteur">

      <input type="submit" value="visiteur" name="visiteur" class="boutonHeader">    

    </form>

  </body>

</html>