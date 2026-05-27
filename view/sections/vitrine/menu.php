<?php
// S'assurer que la session est démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$estConnecte = isset($_SESSION['utilisateur_id']);
$nomUtilisateur = $_SESSION['utilisateur_nom'] ?? '';
?>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <h1 class="sitename">Yoon<span>Wi</span></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>

          <!-- Accueil avec dropdown des sections -->
          <li class="dropdown"><a href="index.php"><i class="bi bi-house"></i>&nbsp; Accueil <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="index.php#about"><i class="bi bi-bell"></i>&nbsp; Rappels</a></li>
              <li><a href="index.php#services"><i class="bi bi-grid"></i>&nbsp; Fonctionnalités</a></li>
              <li><a href="index.php#features"><i class="bi bi-stars"></i>&nbsp; Actualités</a></li>
              <li><a href="index.php#pricing"><i class="bi bi-lightbulb"></i>&nbsp; Recommandations</a></li>
              <li><a href="index.php#faq"><i class="bi bi-question-circle"></i>&nbsp; FAQ</a></li>
              <li><a href="index.php#contact"><i class="bi bi-envelope"></i>&nbsp; Contact</a></li>
            </ul>
          </li>

          <!-- Liens principaux -->
          <ul>
            <li><a href="index.php?action=coran"><i class="bi bi-book"></i>&nbsp; Coran</a></li>
            <li><a href="index.php?action=xassida"><i class="bi bi-file-pdf"></i>&nbsp; Khassida PDF</a></li>
            <li><a href="index.php?action=lecteur"><i class="bi bi-headphones"></i>&nbsp; Lecteur</a></li>
            <li><a href="index.php?action=saisievo cale"><i class="bi bi-mic"></i>&nbsp; Saisie Vocale</a></li>
            <li><a href="index.php?action=horairesprieres"><i class="bi bi-clock"></i>&nbsp; Horaires de Prière</a></li>
            <li><a href="index.php?action=qibla"><i class="bi bi-compass"></i>&nbsp; Qibla</a></li>
          </ul>
          &nbsp; &nbsp;

          <!-- Langue en dropdown -->
          <li class="dropdown"><a href="#"><i class="bi bi-translate"></i>&nbsp; Langue <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="index.php?action=langue&lang=fr"><i class="bi bi-flag"></i>&nbsp; 🇫🇷 Français</a></li>
              <li><a href="index.php?action=langue&lang=wo"><i class="bi bi-flag"></i>&nbsp; 🇸🇳 Wolof</a></li>
              <li><a href="index.php?action=langue&lang=ar"><i class="bi bi-flag"></i>&nbsp; 🇸🇦 Arabe</a></li>
              <li><a href="index.php?action=langue&lang=en"><i class="bi bi-flag"></i>&nbsp; 🇬🇧 Anglais</a></li>
            </ul>
          </li>

          <!-- Bouton connecté / déconnecté -->
          <?php if ($estConnecte): ?>
            <li class="dropdown">&nbsp; &nbsp;
              <a href="#" class="btn-get-started">
                <i class="bi bi-person-check-fill"></i>&nbsp; <?= htmlspecialchars($nomUtilisateur) ?> <i class="bi bi-chevron-down toggle-dropdown"></i>
              </a>
              <ul>
                <li><a href="index.php?action=logout"><i class="bi bi-box-arrow-right"></i>&nbsp; Se Déconnecter</a></li>
                <li><a href="index.php?action=historique"><i class="bi bi-clock-history"></i>&nbsp; Historique</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li>&nbsp; &nbsp;<a href="login.php" class="btn-get-started"><i class="bi bi-person-circle"></i>&nbsp; &nbsp;Se Connecter</a></li>
          <?php endif; ?>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>