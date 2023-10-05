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
    }else{
?>