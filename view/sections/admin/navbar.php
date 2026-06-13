<?php
$user_nom = $_SESSION['user_nom'] ?? 'Admin';
?>
<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="admin.php">
            <span style="font-size:22px; font-weight:800; color:#71c55d;">☪</span>
        </a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100">
            <li class="nav-item w-100 d-flex align-items-center">
                <span class="fw-bold text-muted" style="font-size:15px;">
                    ☪ <strong style="color:#71c55d;">YoonWi</strong> — Tableau de bord
                </span>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                    <div class="navbar-profile">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white" style="width:32px;height:32px;font-weight:700;font-size:14px;">
                            <?= strtoupper(mb_substr($user_nom, 0, 1)) ?>
                        </div>
                        <p class="mb-0 d-none d-sm-block navbar-profile-name ms-2"><?= htmlspecialchars($user_nom) ?></p>
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">Mon compte</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php">
                        <i class="mdi mdi-home text-success me-2"></i> Voir le site
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?action=logout">
                        <i class="mdi mdi-logout text-danger me-2"></i> Déconnexion
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>