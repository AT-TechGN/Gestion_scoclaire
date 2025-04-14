<?php
session_start();
require_once __DIR__ . '/../models/utilisateurModel.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Administrateur') {
    header('Location: ../views/login.php');
    exit;
}

$utilisateurModel = new UtilisateurModel();

// TRAITEMENT AJOUT OU MODIFICATION
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id_utilisateur'] ?? null;
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $role = $_POST['role'] ?? '';
    $statut = $_POST['statut'] ?? 'actif';

    if ($action === 'ajouter') {
        // Vérifier si l'email existe déjà
        $existant = $utilisateurModel->getUtilisateurByEmail($email);
        if ($existant) {
            $_SESSION['message'] = "Cet email est déjà utilisé.";
            $_SESSION['message_type'] = "danger";
        } else {
            $utilisateurModel->ajouterUtilisateur($nom, $prenom, $email, $mot_de_passe, $role);
            $_SESSION['message'] = "Utilisateur ajouté avec succès.";
            $_SESSION['message_type'] = "success";
        }
    } elseif ($action === 'modifier' && $id) {
        if (!empty($mot_de_passe)) {
            $utilisateurModel->modifierUtilisateur($id, $nom, $prenom, $email, $mot_de_passe, $role, $statut);
        } else {
            // Mot de passe vide, ne pas le modifier
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, role = :role, statut = :statut WHERE id_utilisateur = :id");
            $stmt->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'role' => $role,
                'statut' => $statut
            ]);
        }
        $_SESSION['message'] = "Utilisateur modifié avec succès.";
        $_SESSION['message_type'] = "success";
    }

    header('Location: ../views/dashboard/utilisateurs.php');
    exit;
}

// TRAITEMENT SUPPRESSION
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $utilisateurModel->supprimerUtilisateur($id);
    $_SESSION['message'] = "Utilisateur supprimé avec succès.";
    $_SESSION['message_type'] = "success";
    header('Location: ../views/dashboard/utilisateurs.php');
    exit;
}
