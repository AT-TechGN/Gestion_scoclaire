<?php
// Mot de passe que tu veux hacher
$mot_de_passe_clair = 'admin1234';

// Hachage du mot de passe
$mot_de_passe_hache = password_hash($mot_de_passe_clair, PASSWORD_DEFAULT);

// Afficher le mot de passe haché (facultatif, juste pour vérifier)
echo $mot_de_passe_hache;
?>
