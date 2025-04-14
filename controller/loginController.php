<?php
session_start();

// Déconnexion si ?logout=true est présent dans l'URL
if (isset($_GET['logout'])) {
    logout();
    exit;
}

$chemin = __DIR__ . '/../config/config.php';
if (!file_exists($chemin)) {
    die("Erreur : Le fichier config.php est introuvable ici -> " . $chemin);
}
require_once $chemin; // Inclut la configuration

require_once __DIR__ . '/../models/utilisateurModel.php';  

// Vérifie si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';   
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';  

    // Appel de la fonction de login avec les paramètres email et mot_de_passe
    login($email, $mot_de_passe);
}

// Fonction pour se connecter
function login($email, $password) {
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Veuillez remplir tous les champs.";
        header('Location: ../views/login.php');
        exit;
    }

    $utilisateurModel = new UtilisateurModel();
    $utilisateur = $utilisateurModel->getUtilisateurByEmail($email);

    if ($utilisateur && password_verify($password, $utilisateur['mot_de_passe'])) {
        $_SESSION['user_id'] = $utilisateur['id_utilisateur'];
        $_SESSION['role'] = $utilisateur['role'];
        $_SESSION['email'] = $utilisateur['email'];
        
        switch ($_SESSION['role']) {
            case 'Administrateur':
                header('Location: ../views/dashboard/admin.php');
                break;
            case 'Comptable':
                header('Location: ../views/dashboard/comptable.php');
                break;
            case 'Professeur':
                header('Location: ../views/dashboard/professeur.php');
                break;
            case 'Eleve':
                header('Location: ../views/dashboard/eleve.php');
                break;
            case 'Parent':
                header('Location: ../views/dashboard/parent.php');
                break;
            default:
                header('Location: ../views/login.php');
        }
        exit;
    } else {
        $_SESSION['error'] = "Identifiants incorrects.";
        header('Location: ../views/login.php');
        exit;
    }
}

// Fonction de déconnexion
function logout() {
    session_unset();
    session_destroy();
    header('Location: ../views/login.php');
    exit;
}
