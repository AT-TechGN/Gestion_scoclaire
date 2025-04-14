<?php
include_once '../../includes/header.php';
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/utilisateurModel.php';
require_once __DIR__ . '/../../controller/utilisateurController.php';



$utilisateurModel = new UtilisateurModel();
$utilisateurs = $utilisateurModel->getAllUtilisateurs();

// Gestion du formulaire (copie de form_utilisateur.php)
$utilisateur = null;
$modifier = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $modifier = true;
    foreach ($utilisateurs as $u) {
        if ($u['id_utilisateur'] == $id) {
            $utilisateur = $u;
            break;
        }
    }
}
?>

<div class="home-content">
    <div class="overview-boxes">
        <!-- Box 2 : Formulaire d'ajout/modification -->
        <div class="box">
            
            <form action="../../controller/utilisateurController.php" method="POST">
                <?php if ($modifier): ?>
                    <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id_utilisateur'] ?>">
                <?php endif; ?>
                <input type="hidden" name="action" value="<?= $modifier ? "modifier" : "ajouter" ?>">

                <label>Nom :</label>
                <input type="text" name="nom" value="<?= $utilisateur['nom'] ?? '' ?>" required>

                <label>Prénom :</label>
                <input type="text" name="prenom" value="<?= $utilisateur['prenom'] ?? '' ?>" required>

                <label>Email :</label>
                <input type="email" name="email" value="<?= $utilisateur['email'] ?? '' ?>" required>

                <label>Mot de passe :</label>
                <input type="password" name="mot_de_passe" <?= $modifier ? '' : 'required' ?>>

                <?php if ($modifier): ?>
                <small>Laisser vide pour ne pas modifier le mot de passe</small>
                <?php endif; ?>

                <label>Rôle :</label>
                <select name="role" required>
                    <option value="Administrateur" <?= ($utilisateur['role'] ?? '') == 'Administrateur' ? 'selected' : '' ?>>Administrateur</option>
                    <option value="Professeur" <?= ($utilisateur['role'] ?? '') == 'Professeur' ? 'selected' : '' ?>>Professeur</option>
                    <option value="Élève" <?= ($utilisateur['role'] ?? '') == 'Élève' ? 'selected' : '' ?>>Élève</option>
                    <option value="Comptable" <?= ($utilisateur['role'] ?? '') == 'Comptable' ? 'selected' : '' ?>>Comptable</option>
                </select>

                <?php if ($modifier): ?>
                    <label>Statut :</label>
                    <select name="statut" required>
                        <option value="actif" <?= ($utilisateur['statut'] ?? '') == 'actif' ? 'selected' : '' ?>>Actif</option>
                        <option value="inactif" <?= ($utilisateur['statut'] ?? '') == 'inactif' ? 'selected' : '' ?>>Inactif</option>
                    </select>
                <?php endif; ?>

                <button type="submit">Ajouter</button>

                <?php if ($modifier): ?>
                    <a href="../../controller/utilisateurController.php?action=supprimer&id=<?= $utilisateur['id_utilisateur'] ?>"
                       class="btn btn-danger"
                       onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')">
                        Supprimer
                    </a>
                <?php endif; ?>
            </form>
        </div>
        
        <!-- Box 1 : Liste des utilisateurs -->
        <div class="box">

            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?? 'info' ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message']; unset($_SESSION['message'], $_SESSION['message_type']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            <?php endif; ?>

            <table class="mtable">
                <tr>
                    <th>ID</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= $utilisateur['id_utilisateur'] ?></td>
                        <td><?= $utilisateur['nom'] . ' ' . $utilisateur['prenom'] ?></td>
                        <td><?= $utilisateur['email'] ?></td>
                        <td><?= $utilisateur['role'] ?></td>
                        <td><?= ucfirst($utilisateur['statut']) ?></td>
                        <td>
                            <a href="utilisateurs.php?id=<?= $utilisateur['id_utilisateur'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                            <a href="../../controller/utilisateurController.php?action=supprimer&id=<?= $utilisateur['id_utilisateur'] ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Confirmer la suppression de cet utilisateur ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
</section>


<?php include_once '../../includes/footer.php'; ?>
