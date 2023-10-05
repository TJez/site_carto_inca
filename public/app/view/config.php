<?php

    // Données de connexion
    /*$host = "pg-inca";
    $database = "bd_france_inca";
    $user = "inca_visu_nico";
    $password = "visu";*/

    $host = "pg-inca";
    $database = "bd_france_inca";
    $user = "inca";
    $password = "106rginca";

    // connexion à la db
    $connexion = pg_connect("host=$host dbname=$database user=$user password=$password");
    try 
  {
    $conn = pg_connect("host=$host dbname=$database user=$user password=$password");
    if(!$conn)
    {
      throw new Exception("Database Connection Error");
    }
    return $conn;
  }
  catch (Exception $e) 
  {
    echo $e->getMessage();
  }



    // Vérifier la connexion
    if($connexion === false){
        echo 'fail';
        die("ERREUR : Impossible de se connecter. " . pg_last_error());
    }
?>