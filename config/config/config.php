<?php
define("LOCALHOST", $_SERVER['SERVER_NAME']);
define("URL", dirname($_SERVER['PHP_SELF']) . '/');
define("LINK", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME'] . '/gstock/');



#CONSTANTES LIEES A LA BASE DE DONNEE
define("HOST", "localhost");
define("TYPE", "mysql");
define("DBNAME", "gstock");
define("DBUSER", "root");
define("DBPASS", "");

//  Connexion à la base de données
$conn = new mysqli(HOST, DBUSER, DBPASS, DBNAME);
if ($conn->connect_error) {
    die("Erreur de connexion MySQL : " . $conn->connect_error);
}
?>
