<?php
$page = $_GET['page'] ?? 'dashboard';

$pages_map = [
    'dashboard'   => null, // inline
    'listeXassida'=> __DIR__ . '/../../pages/admin/xassida/listeXassida.php',
    'corbeilleXassida' => __DIR__ . '/../../pages/admin/xassida/corbeilleXassida.php',
    'listeCoran'  => __DIR__ . '/../../pages/admin/coran/listeCoran.php',
    'listeAudio'  => __DIR__ . '/../../pages/admin/audio/listeAudio.php',
    'listeDouas'  => __DIR__ . '/../../pages/admin/douas/listeDouas.php',
    'listeCapture'=> __DIR__ . '/../../pages/admin/dictaphone/captureAudio.php',
    'listeHeures' => __DIR__ . '/../../pages/admin/horairesprieres/listeHeuresprieres.php',
    'listeQibla'  => __DIR__ . '/../../pages/admin/qibla/listeQibla.php',
    'listeUser'   => __DIR__ . '/../../pages/admin/user/listeUser.php',
    'listeFaq'    => __DIR__ . '/../../pages/admin/faq/listeFaq.php',
    'listeNews'   => __DIR__ . '/../../pages/admin/newsletters/listeNews.php',
    'listeHist'   => __DIR__ . '/../../pages/admin/historique/listeHist.php',
    'listePara'   => __DIR__ . '/../../pages/admin/parametres/settings.php',
];
?>

<div class="main-panel">
    <div class="content-wrapper">

<?php if ($page === 'dashboard' || !isset($pages_map[$page])): ?>
    <!-- ===== DASHBOARD ===== -->
    <?php
    // Stats rapides depuis la BD
    try {
        require_once __DIR__ . '/../../../../model/DB.php';
        $db  = new DB();
        $pdo = $db->getConnexion();

        $nb_users     = $pdo->query("SELECT COUNT(*) FROM utilisateur")->fetchColumn();
        $nb_xassidas  = $pdo->query("SELECT COUNT(*) FROM xassaide")->fetchColumn();
        $nb_captures  = $pdo->query("SELECT COUNT(*) FROM capture_audio")->fetchColumn();
        $nb_reconnues = $pdo->query("SELECT COUNT(*) FROM capture_audio WHERE reconnu=1")->fetchColumn();
    } catch (Exception $e) {
        $nb_users = $nb_xassidas = $nb_captures = $nb_reconnues = '—';
    }
    ?>

    <div class="page-header">
        <h3>Tableau de bord</h3>
        <p>Vue d'ensemble de la plateforme YoonWi</p>
    </div>

    <!-- Stats cards -->
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="mb-0"><?= $nb_users ?></h3>
                            <h6 class="text-muted font-weight-normal mt-1">Utilisateurs inscrits</h6>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-account-group icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="mb-0"><?= $nb_xassidas ?></h3>
                            <h6 class="text-muted font-weight-normal mt-1">Xassidas enregistrés</h6>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-music-note icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="mb-0"><?= $nb_captures ?></h3>
                            <h6 class="text-muted font-weight-normal mt-1">Captures audio totales</h6>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-microphone icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-stat">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h3 class="mb-0"><?= $nb_reconnues ?></h3>
                            <h6 class="text-muted font-weight-normal mt-1">Identifications réussies</h6>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success">
                                <span class="mdi mdi-check-circle icon-item"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick links -->
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Accès rapide</h4>
                    <div class="row g-3 mt-1">
                        <?php
                        $links = [
                            ['page'=>'listeXassida', 'icon'=>'mdi-music-note', 'label'=>'Xassidas', 'color'=>'success'],
                            ['page'=>'listeUser',    'icon'=>'mdi-account-group', 'label'=>'Utilisateurs', 'color'=>'primary'],
                            ['page'=>'listeCoran',   'icon'=>'mdi-book-open-page-variant', 'label'=>'Coran', 'color'=>'warning'],
                            ['page'=>'listeAudio',   'icon'=>'mdi-headphones', 'label'=>'Lecteur', 'color'=>'info'],
                            ['page'=>'listeFaq',     'icon'=>'mdi-help-circle-outline', 'label'=>'FAQ', 'color'=>'danger'],
                            ['page'=>'listeNews',    'icon'=>'mdi-email-newsletter', 'label'=>'Newsletter', 'color'=>'secondary'],
                        ];
                        foreach ($links as $l): ?>
                        <div class="col-6 col-md-4">
                            <a href="admin.php?page=<?= $l['page'] ?>" class="card text-decoration-none border" style="display:block;padding:16px;border-radius:12px;transition:.2s;" onmouseover="this.style.borderColor='#71c55d'" onmouseout="this.style.borderColor=''">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="mdi <?= $l['icon'] ?> text-<?= $l['color'] ?>" style="font-size:24px;"></i>
                                    <span class="fw-semibold text-dark"><?= $l['label'] ?></span>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card" style="background:linear-gradient(135deg,#71c55d,#5fb04d);color:#fff;">
                <div class="card-body d-flex flex-column justify-content-center">
                    <div style="font-size:48px;text-align:center;margin-bottom:12px;">☪</div>
                    <h4 class="text-center mb-2" style="color:#fff;">YoonWi Admin</h4>
                    <p class="text-center mb-3" style="opacity:.9;font-size:14px;">
                        Plateforme islamique et mouride — Gérez votre contenu spirituel
                    </p>
                    <a href="index.php" class="btn btn-light btn-sm text-center" style="border-radius:20px;">
                        Voir le site public
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php elseif (file_exists($pages_map[$page])): ?>
    <?php require_once $pages_map[$page]; ?>
<?php else: ?>
    <div class="alert alert-warning">Page introuvable : <strong><?= htmlspecialchars($page) ?></strong></div>
<?php endif; ?>

    </div><!-- .content-wrapper -->

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center d-block d-sm-inline-block">
                © <?= date('Y') ?> <strong style="color:#71c55d;">YoonWi</strong> — Plateforme islamique & mouride
            </span>
            <span class="text-muted d-block mt-1 mt-sm-0 text-center">
                Fait avec <i class="mdi mdi-heart text-danger"></i>
            </span>
        </div>
    </footer>
</div><!-- .main-panel -->