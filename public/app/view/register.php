<?php
  require('config.php');
  if (isset($_REQUEST['username'], $_REQUEST['role'], $_REQUEST['password'])){
    // récupérer le nom d'utilisateur
    $username = $_REQUEST['username'];
    // récupérer le role
    $role = $_REQUEST['role'];
    // récupérer le mot de passe
    $password = $_REQUEST['password'];
    //requéte SQL + mot de passe crypté
      $query = "INSERT into \"authentification_INCA\" (username, role, password) VALUES ('$username', '$role', '".hash('sha256', $password)."');";
    // Exécuter la requête sur la base de données
      $res = pg_query($query);
      if($res){
        echo "<div class='sucess'>
              <h3>Vous êtes inscrit avec succès.</h3>
              <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
        </div>";
      }
  }
?>

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

  </head>

  <body>

    <form class="connexion" action="" method="post">

        <h1 id="titre">S'inscrire</h1>

      <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />

        <input type="text" class="box-input" name="role" placeholder="role" required />

        <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />

        <input type="submit" name="submit" value="S'inscrire" class="boutonHeader" />

        <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>

    </form>
  </body>

</html>