<?php

$dsn = 'mysql:dbname=movies;host=localhost';
$user = 'root';
$pass = '';


try {
    $bdd = new PDO($dsn, $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec('SET NAMES utf8');
    // Ici la connexion est effectuée
}
catch (PDOException $e) {
    // La connexion a échoué et elle nous retourne une exception, qui nous indique alors notre erreur
    echo 'Échec lors de la connexion : ' . $e->getMessage();
}

?>
