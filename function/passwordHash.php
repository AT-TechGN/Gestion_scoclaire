<?php
// Fonction pour hacher le mot de passe
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}
