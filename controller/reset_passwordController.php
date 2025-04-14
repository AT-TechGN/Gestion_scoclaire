<?php
session_start();

require_once __DIR__ . '/../models/utilisateurModel.php';

$utilisateurModel = new UtilisateurModel();

// Vérifie que le token est bien passé dans l'URL
if (!isset($_GET['token'])) {
    $_SESSION['error'] = "Lien de réinitialisation invalide.";
    header('Location: ../views/login.php');
    exit;
}

$token = $_GET['token'];
$utilisateur = $utilisateurModel->getUtilisateurByToken($token);

if (!$utilisateur) {
    $_SESSION['error'] = "Ce lien de réinitialisation est invalide ou a expiré.";
    header('Location: ../views/login.php');
    exit;
}

// Si le formulaire de réinitialisation est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveauMotDePasse = $_POST['nouveau_mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    if (empty($nouveauMotDePasse) || empty($confirmation)) {
        $erreur = "Tous les champs sont requis.";
    } elseif ($nouveauMotDePasse !== $confirmation) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        // Mise à jour du mot de passe
        if ($utilisateurModel->updateMotDePasse($utilisateur['id_utilisateur'], $nouveauMotDePasse)) {
            $_SESSION['success'] = "Votre mot de passe a été réinitialisé avec succès. Veuillez vous connecter.";
            header('Location: ../views/login.php');
            exit;
        } else {
            $erreur = "Une erreur est survenue lors de la mise à jour du mot de passe.";
        }
    }
}
?>