<?php
// Configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'gestion_scolaire');
define('DB_USER', 'root');
define('DB_PASS', '');

// Connexion à la base de données
function getDbConnection() {
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>
