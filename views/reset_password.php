
<!-- ✅ Interface HTML -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto shadow" style="max-width: 500px;">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">🔐 Réinitialiser votre mot de passe</h4>

            <?php if (isset($erreur)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erreur) ?></div>
            <?php endif; ?>

            <form action="../controller/reset_passwordController.php" method="post">
                <div class="mb-3">
                    <label for="nouveau_mot_de_passe" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="nouveau_mot_de_passe" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="confirmation" class="form-label">Confirmez le mot de passe</label>
                    <input type="password" name="confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Réinitialiser</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>