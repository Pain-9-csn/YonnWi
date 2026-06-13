<?php
$current_page = $_GET['page'] ?? basename($_SERVER['PHP_SELF'], '.php');
function isActive(string $pages): string {
    $page = $_GET['page'] ?? '';
    foreach (explode(',', $pages) as $p) {
        if (trim($p) === trim($page)) return 'active';
    }
    return '';
}
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="admin.php">
            <span style="font-size:28px; font-weight:800; color:#71c55d; letter-spacing:-1px;">☪ YoonWi</span>
        </a>
        <a class="sidebar-brand brand-logo-mini" href="admin.php">
            <span style="font-size:22px; color:#71c55d;">☪</span>
        </a>
    </div>

    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white" style="width:36px;height:36px;font-weight:700;">
                            <?= strtoupper(mb_substr($_SESSION['user_nom'] ?? 'A', 0, 1)) ?>
                        </div>
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal"><?= htmlspecialchars($_SESSION['user_nom'] ?? 'Admin') ?></h5>
                        <span>Administrateur</span>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item nav-category"><span class="nav-link">Navigation</span></li>

        <!-- Dashboard -->
        <li class="nav-item menu-items <?= isActive('dashboard,') ?>">
            <a class="nav-link" href="admin.php">
                <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                <span class="menu-title">Tableau de bord</span>
            </a>
        </li>

        <li class="nav-item nav-category"><span class="nav-link">Contenu</span></li>

        <!-- Xassida -->
        <li class="nav-item menu-items <?= isActive('listeXassida') ?>">
            <a class="nav-link" href="admin.php?page=listeXassida">
                <span class="menu-icon"><i class="mdi mdi-music-note"></i></span>
                <span class="menu-title">Xassidas</span>
            </a>
        </li>

        <!-- Coran -->
        <li class="nav-item menu-items <?= isActive('listeCoran') ?>">
            <a class="nav-link" href="admin.php?page=listeCoran">
                <span class="menu-icon"><i class="mdi mdi-book-open-page-variant"></i></span>
                <span class="menu-title">Coran</span>
            </a>
        </li>

        <!-- Audio / Lecteur -->
        <li class="nav-item menu-items <?= isActive('listeAudio') ?>">
            <a class="nav-link" href="admin.php?page=listeAudio">
                <span class="menu-icon"><i class="mdi mdi-headphones"></i></span>
                <span class="menu-title">Lecteur Audio</span>
            </a>
        </li>

        <!-- Douas -->
        <li class="nav-item menu-items <?= isActive('listeDouas') ?>">
            <a class="nav-link" href="admin.php?page=listeDouas">
                <span class="menu-icon"><i class="mdi mdi-hands-pray"></i></span>
                <span class="menu-title">Douas</span>
            </a>
        </li>

        <li class="nav-item nav-category"><span class="nav-link">Outils</span></li>

        <!-- Dictaphone -->
        <li class="nav-item menu-items <?= isActive('listeCapture') ?>">
            <a class="nav-link" href="admin.php?page=listeCapture">
                <span class="menu-icon"><i class="mdi mdi-microphone"></i></span>
                <span class="menu-title">Dictaphone</span>
            </a>
        </li>

        <!-- Horaires -->
        <li class="nav-item menu-items <?= isActive('listeHeures') ?>">
            <a class="nav-link" href="admin.php?page=listeHeures">
                <span class="menu-icon"><i class="mdi mdi-clock-outline"></i></span>
                <span class="menu-title">Horaires Prières</span>
            </a>
        </li>

        <!-- Qibla -->
        <li class="nav-item menu-items <?= isActive('listeQibla') ?>">
            <a class="nav-link" href="admin.php?page=listeQibla">
                <span class="menu-icon"><i class="mdi mdi-compass"></i></span>
                <span class="menu-title">Qibla</span>
            </a>
        </li>

        <li class="nav-item nav-category"><span class="nav-link">Communauté</span></li>

        <!-- Utilisateurs -->
        <li class="nav-item menu-items <?= isActive('listeUser') ?>">
            <a class="nav-link" href="admin.php?page=listeUser">
                <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                <span class="menu-title">Utilisateurs</span>
            </a>
        </li>

        <!-- FAQ -->
        <li class="nav-item menu-items <?= isActive('listeFaq') ?>">
            <a class="nav-link" href="admin.php?page=listeFaq">
                <span class="menu-icon"><i class="mdi mdi-help-circle-outline"></i></span>
                <span class="menu-title">FAQ</span>
            </a>
        </li>

        <!-- Newsletters -->
        <li class="nav-item menu-items <?= isActive('listeNews') ?>">
            <a class="nav-link" href="admin.php?page=listeNews">
                <span class="menu-icon"><i class="mdi mdi-email-newsletter"></i></span>
                <span class="menu-title">Newsletters</span>
            </a>
        </li>

        <!-- Historique -->
        <li class="nav-item menu-items <?= isActive('listeHist') ?>">
            <a class="nav-link" href="admin.php?page=listeHist">
                <span class="menu-icon"><i class="mdi mdi-history"></i></span>
                <span class="menu-title">Historique</span>
            </a>
        </li>

        <li class="nav-item nav-category"><span class="nav-link">Système</span></li>

        <!-- Paramètres -->
        <li class="nav-item menu-items <?= isActive('listePara') ?>">
            <a class="nav-link" href="admin.php?page=listePara">
                <span class="menu-icon"><i class="mdi mdi-cog"></i></span>
                <span class="menu-title">Paramètres</span>
            </a>
        </li>

        <!-- Retour site -->
        <li class="nav-item menu-items">
            <a class="nav-link" href="index.php">
                <span class="menu-icon"><i class="mdi mdi-arrow-left-circle"></i></span>
                <span class="menu-title">Retour au site</span>
            </a>
        </li>
    </ul>
</nav>