<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../../../../controller/userController.php';
(new UserController())->requireAdmin();
$root = '../../../../';
?>
<!DOCTYPE html>
<html lang="fr">
<?php require_once($root . 'view/sections/admin/head.php'); ?>
<body>
<div class="container-scroller">
  <?php require_once($root . 'view/sections/admin/navbar.php'); ?>
  <?php require_once($root . 'view/sections/admin/sidebar.php'); ?>

  <div class="container-fluid page-body-wrapper">
    <div class="main-panel">
      <div class="content-wrapper">

        <div class="page-action-bar">
          <div>
            <h4 class="mb-0" style="color:#fff;">Direction Qibla</h4>
            <small class="text-muted">Historique des calculs de direction — La Mecque (21.4225°N, 39.8262°E)</small>
          </div>
          <a href="<?= $root ?>index.php?action=qibla" target="_blank" class="btn btn-outline-success btn-sm">
            <i class="mdi mdi-eye me-1"></i>Voir vitrine
          </a>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
          <?php
          $qstats = [
            ['mdi-compass','#00d25b','2 341','Calculs effectués'],
            ['mdi-account-location','#0090e7','198','Utilisateurs localisés'],
            ['mdi-map-marker-radius','#ffab00','34','Pays distincts'],
            ['mdi-rotate-right','#8f5fe8','4 219 km','Distance moy. de La Mecque'],
          ];
          foreach ($qstats as $qs): ?>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:<?= $qs[1] ?>22;color:<?= $qs[1] ?>;"><i class="mdi <?= $qs[0] ?>"></i></div>
                <div>
                  <div style="font-size:1.4rem;font-weight:700;color:#fff;"><?= $qs[2] ?></div>
                  <div class="text-muted" style="font-size:.78rem;"><?= $qs[3] ?></div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Tableau historique -->
        <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
          <div class="card-body">
            <h6 class="mb-3" style="color:#fff;"><i class="mdi mdi-history text-muted me-2"></i>Historique des localisations</h6>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Utilisateur</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Direction Qibla</th>
                    <th>Distance La Mecque</th>
                    <th>Date</th>
                    <th>Ville estimée</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $locs = [
                    ['Moussa D.','14.7167','-17.4677','64.32°','4 219 km','Aujourd\'hui 14:30','Dakar'],
                    ['Fatou N.','14.8594','-15.6126','63.14°','4 180 km','Hier 08:15','Touba'],
                    ['Ibrahim S.','48.8566','2.3522','119.48°','5 246 km','Hier 12:44','Paris'],
                    ['Anonyme','40.7128','-74.0060','58.31°','9 142 km','Il y a 2j','New York'],
                    ['Aissatou B.','33.5731','-7.5898','90.15°','4 012 km','Il y a 3j','Casablanca'],
                  ];
                  foreach ($locs as $l): ?>
                  <tr>
                    <td style="color:#fff;"><?= $l[0] ?></td>
                    <td class="text-muted" style="font-size:.82rem;font-family:monospace;"><?= $l[1] ?></td>
                    <td class="text-muted" style="font-size:.82rem;font-family:monospace;"><?= $l[2] ?></td>
                    <td>
                      <span style="color:#00d25b;font-weight:600;">
                        <i class="mdi mdi-compass me-1"></i><?= $l[3] ?>
                      </span>
                    </td>
                    <td style="color:#0090e7;font-weight:500;"><?= $l[4] ?></td>
                    <td class="text-muted" style="font-size:.82rem;"><?= $l[5] ?></td>
                    <td class="text-muted"><?= $l[6] ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <footer class="footer"><span class="text-muted d-block text-center">© 2026 Yoonwi — Panneau Admin</span></footer>
    </div>
  </div>
</div>
<?php require_once($root . 'view/sections/admin/script.php'); ?>
</body>
</html>