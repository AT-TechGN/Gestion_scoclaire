<?php
session_start();
if ($_SESSION['role'] != 'Administrateur') {
    header('Location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link href="http://localhost/gestion_scolaire/assets/css/style.css" rel="stylesheet">
    <link href="http://localhost/gestion_scolaire/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/gestion_scolaire/assets/js/bootstrap.bundle.min.js" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="sidebar hidden-print">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">AT-TECH</span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php" class="active">
            <i class="bx bx-home"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="article.php">
            <i class="bx bx-card"></i>
            <span class="links_name">Eleves</span>
          </a>
        </li>
        <li>
          <a href="client.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Professeurs</span>
          </a>
        </li>
        <li>
          <a href="vente.php">
            <i class="bx bx-shopping-bag"></i>
            <span class="links_name">Classe</span>
          </a>
        </li>
        <li>
          <a href="fournisseur.php">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Notes</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Emploi du temps</span>
          </a>
        </li>
        <li>
          <a href="../../views/dashboard/utilisateurs.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Utilisateur</span>
          </a>
        </li>
        <li >
          <a href="../../controller/loginController.php?logout=true">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav class="hidden-print">
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Recherche..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <!--<img src="images/profile.jpg" alt="">-->
          <span class="admin_name">Komche</span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>
