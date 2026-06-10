<?php
// Informations de l'utilisateur connecté
$nomAdmin   = $_SESSION['user_nom']  ?? 'Administrateur';
$roleAdmin  = $_SESSION['user_role'] ?? 'admin';
?>

<!-- ======================================================
     NAVBAR YOONWI ADMIN
     Remplace : view/sections/admin/navbar.php
====================================================== -->

<!-- Bandeau top (info rapide, remplace le proBanner) -->
<div class="row p-0 m-0 proBanner" id="proBanner">
  <div class="col-md-12 p-0 m-0">
    <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
      <div class="ps-lg-3">
        <div class="d-flex align-items-center justify-content-between">
          <p class="mb-0 font-weight-medium me-3 buy-now-text">
            ☪ YoonWi — Panneau d'administration
          </p>
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.php"><i class="mdi mdi-home me-3 text-white"></i></a>
        <button id="bannerClose" class="btn border-0 p-0">
          <i class="mdi mdi-close text-white"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Navbar principale -->
<nav class="navbar p-0 fixed-top d-flex flex-row">

  <!-- Logo mobile -->
  <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
    <a class="navbar-brand brand-logo-mini" href="admin.php">
      <span style="color:#fff; font-weight:900; font-size:18px;">Y<span style="color:#71c55d;">W</span></span>
    </a>
  </div>

  <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">

    <!-- Bouton toggle sidebar -->
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>

    <!-- Barre de recherche -->
    <ul class="navbar-nav w-100">
      <li class="nav-item w-100">
        <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
          <input type="text" class="form-control" placeholder="Rechercher dans YoonWi…">
        </form>
      </li>
    </ul>

    <!-- Actions droite -->
    <ul class="navbar-nav navbar-nav-right">

      <!-- Bouton accès rapide vitrine -->
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link btn btn-success create-new-button" href="index.php" target="_blank">
          ☪ Voir la vitrine
        </a>
      </li>

      <!-- Icône vue grille -->
      <li class="nav-item nav-settings d-none d-lg-block">
        <a class="nav-link" href="listPara">
          <i class="mdi mdi-view-grid"></i>
        </a>
      </li>

      <!-- Notifications -->
      <li class="nav-item dropdown border-left">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell"></i>
          <span class="count bg-danger"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <h6 class="p-3 mb-0">Notifications</h6>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="listeCoran">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-book-open-page-variant-outline text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Coran</p>
              <p class="text-muted ellipsis mb-0">Gérer les sourates</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="listeXassida">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-file-pdf-box text-warning"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Xassidas</p>
              <p class="text-muted ellipsis mb-0">Gérer les xassidas</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="listeUser">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-account-group text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Utilisateurs</p>
              <p class="text-muted ellipsis mb-0">Gérer les comptes</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <p class="p-3 mb-0 text-center">
            <a href="listeHist">Voir tout l'historique</a>
          </p>
        </div>
      </li>

      <!-- Profil admin -->
      <li class="nav-item dropdown">
        <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
          <div class="navbar-profile">
            <div class="img-xs rounded-circle d-inline-flex align-items-center justify-content-center"
              style="width:32px;height:32px;background:#71c55d;color:#fff;font-weight:bold;font-size:14px;">
              <?= strtoupper(mb_substr($nomAdmin, 0, 1)) ?>
            </div>
            <p class="mb-0 d-none d-sm-block navbar-profile-name ms-2"><?= htmlspecialchars($nomAdmin) ?></p>
            <i class="mdi mdi-menu-down d-none d-sm-block"></i>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="profileDropdown">
          <h6 class="p-3 mb-0">Mon compte</h6>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="listPara">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-cog text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Paramètres</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item preview-item" href="index.php?action=logout">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject mb-1">Déconnexion</p>
            </div>
          </a>
        </div>
      </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-format-line-spacing"></span>
    </button>

  </div>
</nav>