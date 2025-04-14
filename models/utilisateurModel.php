<?php
require_once __DIR__ . '/../config/config.php'; 

class UtilisateurModel {
    // Fonction pour se connecter à la base de données
    private function getDBConnection() {
        try {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données: " . $e->getMessage());
        }
    }

    // Fonction pour récupérer un utilisateur par son email
    public function getUtilisateurByEmail($email) {
        try {
            $pdo = $this->getDBConnection();
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif de l'utilisateur
        } catch (PDOException $e) {
            die("Erreur de récupération de l'utilisateur: " . $e->getMessage());
        }
    }

    // Fonction pour ajouter un utilisateur
    public function ajouterUtilisateur($nom, $prenom, $email, $mot_de_passe, $role) {
        try {
            $pdo = $this->getDBConnection();
            $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, statut) 
                                   VALUES (:nom, :prenom, :email, :mot_de_passe, :role, 'actif')");
            $stmt->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => password_hash($mot_de_passe, PASSWORD_BCRYPT), // Hachage du mot de passe
                'role' => $role
            ]);
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage());
        }
    }

    // Fonction pour modifier un utilisateur
    public function modifierUtilisateur($id, $nom, $prenom, $email, $mot_de_passe, $role, $statut) {
        try {
            $pdo = $this->getDBConnection();
            $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, 
                                   mot_de_passe = :mot_de_passe, role = :role, statut = :statut 
                                   WHERE id_utilisateur = :id");
            $stmt->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mot_de_passe' => password_hash($mot_de_passe, PASSWORD_BCRYPT), // Hachage du mot de passe
                'role' => $role,
                'statut' => $statut
            ]);
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de la modification de l'utilisateur: " . $e->getMessage());
        }
    }

    // Fonction pour supprimer un utilisateur
    public function supprimerUtilisateur($id) {
        try {
            $pdo = $this->getDBConnection();
            $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = :id");
            $stmt->execute(['id' => $id]);
            return true;
        } catch (PDOException $e) {
            die("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
        }
    }

    // Fonction pour récupérer tous les utilisateurs
    public function getAllUtilisateurs() {
        try {
            $pdo = $this->getDBConnection();
            $stmt = $pdo->query("SELECT * FROM utilisateurs");
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les utilisateurs
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des utilisateurs: " . $e->getMessage());
        }
    }

    // Fonction pour enregistrer un token de réinitialisation
public function enregistrerResetToken($email, $token, $expiration) {
    try {
        $pdo = $this->getDBConnection();
        $stmt = $pdo->prepare("UPDATE utilisateurs SET reset_token = :token, token_expiration = :expiration WHERE email = :email");
        $stmt->execute([
            'token' => $token,
            'expiration' => $expiration,
            'email' => $email
        ]);
        return true;
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement du token : " . $e->getMessage());
    }
}

// Fonction pour récupérer un utilisateur avec un token valide
public function getUtilisateurByToken($token) {
    try {
        $pdo = $this->getDBConnection();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE reset_token = :token AND token_expiration > NOW()");
        $stmt->execute(['token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur lors de la récupération de l'utilisateur par token : " . $e->getMessage());
    }
}

// Fonction pour mettre à jour le mot de passe et supprimer le token
public function updateMotDePasse($user_id, $nouveauMotDePasse) {
    try {
        $pdo = $this->getDBConnection();
        $mot_de_passe_hache = password_hash($nouveauMotDePasse, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe = :mot_de_passe, reset_token = NULL, token_expiration = NULL WHERE id_utilisateur = :id");
        $stmt->execute([
            'mot_de_passe' => $mot_de_passe_hache,
            'id' => $user_id
        ]);
        return true;
    } catch (PDOException $e) {
        die("Erreur lors de la mise à jour du mot de passe : " . $e->getMessage());
    }
}


    
}
?>
