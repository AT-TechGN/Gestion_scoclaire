<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Système de Gestion Scolaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(225, 228, 231), #6c757d);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-container {
            background-color: #fff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
            max-width: 420px;
            width: 100%;
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #343a40;
            font-weight: bold;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-text a {
            text-decoration: none;
            color: #007bff;
        }
        .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="text-center">Connexion</h2>
    <!-- Affichage des erreurs s'il y en a -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    <!-- Formulaire de connexion -->
    <form action="../controller/loginController.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" name="email" id="email" required autofocus>
        </div>
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" required>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" name="login" class="btn btn-primary">Se connecter</button>
        </div>
        <p class="form-text mt-3 text-center">
            <a href="reset_password.php">Mot de passe oublié ?</a>
        </p>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
