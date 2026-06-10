<?php
$nomAdmin  = $_SESSION['user_nom']  ?? 'Administrateur';
$roleAdmin = $_SESSION['user_role'] ?? 'admin';

// Page active pour highlight
$pageActive = $_GET['action'] ?? basename($_SERVER['PHP_SELF'], '.php');
?>


<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <!-- Logo -->
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="admin.php">
      <span style="font-size:28px; font-weight:900; color:#fff; letter-spacing:1px;">
        Yoon<span style="color:#71c55d;">Wi</span>
      </span>
    </a>
    <a class="sidebar-brand brand-logo-mini" href="admin.php">
      <span style="font-size:20px; font-weight:900; color:#71c55d;">YW</span>
    </a>
  </div>

  <ul class="nav">

    <!-- Profil -->
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <div class="img-xs rounded-circle d-inline-flex align-items-center justify-content-center"
                 style="width:40px;height:40px;background:#71c55d;color:#fff;font-weight:bold;font-size:18px;">
              <?= strtoupper(mb_substr($nomAdmin, 0, 1)) ?>
            </div>
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal"><?= htmlspecialchars($nomAdmin) ?></h5>
            <span>Administrateur</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown">
          <i class="mdi mdi-dots-vertical"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <div class="dropdown-divider"></div>
          <a href="listPara" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-cog text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Paramètres</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="index.php?action=logout" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-logout text-danger"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Déconnexion</p>
            </div>
          </a>
        </div>
      </div>
    </li>

    <!-- ---- NAVIGATION ---- -->
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>

    <!-- Dashboard -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="admin.php">
        <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- ---- CONTENU ISLAMIQUE ---- -->
    <li class="nav-item nav-category">
      <span class="nav-link">Contenu islamique</span>
    </li>

    <!-- Coran -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#menuCoran" aria-expanded="false" aria-controls="menuCoran">
        <span class="menu-icon"><i class="mdi mdi-book-open-page-variant-outline"></i></span>
        <span class="menu-title">Coran</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuCoran">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="listeCoran"><i class="mdi mdi-view-list me-1"></i>Liste Coran</a></li>
          <li class="nav-item"><a class="nav-link" href="corbeilleCoran"><i class="mdi mdi-delete-outline me-1"></i>Corbeille</a></li>
        </ul>
      </div>
    </li>

    <!-- Xassidas -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#menuXassida" aria-expanded="false" aria-controls="menuXassida">
        <span class="menu-icon"><i class="mdi mdi-file-pdf-box"></i></span>
        <span class="menu-title">Xassidas</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuXassida">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="listeXassida"><i class="mdi mdi-view-list me-1"></i>Liste Xassidas</a></li>
          <li class="nav-item"><a class="nav-link" href="corbeilleXassida"><i class="mdi mdi-delete-outline me-1"></i>Corbeille</a></li>
        </ul>
      </div>
    </li>

    <!-- Douas -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listeDouas">
        <span class="menu-icon"><i class="mdi mdi-hand-heart-outline"></i></span>
        <span class="menu-title">Douas & Invocations</span>
      </a>
    </li>

    <!-- ---- AUDIO ---- -->
    <li class="nav-item nav-category">
      <span class="nav-link">Audio & Médias</span>
    </li>

    <!-- Lecteur Mp3 -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#menuAudio" aria-expanded="false" aria-controls="menuAudio">
        <span class="menu-icon"><i class="mdi mdi-music-note"></i></span>
        <span class="menu-title">Lecteur Mp3</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuAudio">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="listeAudio"><i class="mdi mdi-view-list me-1"></i>Liste Audio</a></li>
          <li class="nav-item"><a class="nav-link" href="corbeilleAudio"><i class="mdi mdi-delete-outline me-1"></i>Corbeille</a></li>
        </ul>
      </div>
    </li>

    <!-- Dictaphone -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#menuDictaphone" aria-expanded="false" aria-controls="menuDictaphone">
        <span class="menu-icon"><i class="mdi mdi-microphone-outline"></i></span>
        <span class="menu-title">Dictaphone</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuDictaphone">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="listeCapture"><i class="mdi mdi-view-list me-1"></i>Captures</a></li>
          <li class="nav-item"><a class="nav-link" href="corbeilleCapture"><i class="mdi mdi-delete-outline me-1"></i>Corbeille</a></li>
        </ul>
      </div>
    </li>

    <!-- ---- OUTILS SPIRITUELS ---- -->
    <li class="nav-item nav-category">
      <span class="nav-link">Outils spirituels</span>
    </li>

    <!-- Horaires de prières -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listeHeures">
        <span class="menu-icon"><i class="mdi mdi-mosque-outline"></i></span>
        <span class="menu-title">Horaires de prières</span>
      </a>
    </li>

    <!-- Qibla -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listeQibla">
        <span class="menu-icon"><i class="mdi mdi-compass-outline"></i></span>
        <span class="menu-title">Qibla</span>
      </a>
    </li>

    <!-- Localisation -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listeLoc">
        <span class="menu-icon"><i class="mdi mdi-map-marker-outline"></i></span>
        <span class="menu-title">Localisation</span>
      </a>
    </li>

    <!-- ---- GESTION ---- -->
    <li class="nav-item nav-category">
      <span class="nav-link">Gestion</span>
    </li>

    <!-- Utilisateurs -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listeUser">
        <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
        <span class="menu-title">Utilisateurs</span>
      </a>
    </li>

    <!-- Historique -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#menuHist" aria-expanded="false" aria-controls="menuHist">
        <span class="menu-icon"><i class="mdi mdi-history"></i></span>
        <span class="menu-title">Historique</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuHist">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="listeHist"><i class="mdi mdi-view-list me-1"></i>Tous les logs</a></li>
          <li class="nav-item"><a class="nav-link" href="corbeilleHist"><i class="mdi mdi-delete-outline me-1"></i>Corbeille</a></li>
        </ul>
      </div>
    </li>

    <!-- Newsletters -->
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#menuNews" aria-expanded="false" aria-controls="menuNews">
        <span class="menu-icon"><i class="mdi mdi-email-newsletter"></i></span>
        <span class="menu-title">Newsletters</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="menuNews">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="listeNews"><i class="mdi mdi-view-list me-1"></i>Abonnés</a></li>
          <li class="nav-item"><a class="nav-link" href="corbeilleNews"><i class="mdi mdi-delete-outline me-1"></i>Corbeille</a></li>
        </ul>
      </div>
    </li>

    <!-- FAQ -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listeFaq">
        <span class="menu-icon"><i class="mdi mdi-frequently-asked-questions"></i></span>
        <span class="menu-title">FAQ</span>
      </a>
    </li>

    <!-- Paramètres -->
    <li class="nav-item menu-items">
      <a class="nav-link" href="listePara">
        <span class="menu-icon"><i class="mdi mdi-cog"></i></span>
        <span class="menu-title">Paramètres</span>
      </a>
    </li>

    <!-- Lien retour vitrine -->
    <li class="nav-item nav-category">
      <span class="nav-link">Accès rapide</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="Home" target="_blank">
        <span class="menu-icon"><i class="mdi mdi-web"></i></span>
        <span class="menu-title">Voir la vitrine</span>
      </a>
    </li>

  </ul>
</nav>