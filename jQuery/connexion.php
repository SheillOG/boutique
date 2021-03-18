<?php
/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=jquery;host=10.0.10.130:3307';
$user = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo 'Connexion réussis';
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}

?>
