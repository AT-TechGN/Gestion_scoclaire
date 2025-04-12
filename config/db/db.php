<?php
require_once __DIR__ . "/config.php"; 

$dbinfo = TYPE . ':host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8'; // Ajout de charset=utf8 pour éviter les problèmes d'encodage

try {
    $connect = new PDO($dbinfo, DBUSER, DBPASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les exceptions en cas d'erreur SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Format de récupération par défaut
        PDO::ATTR_EMULATE_PREPARES => false, // Désactive l'émulation pour éviter les injections SQL
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
