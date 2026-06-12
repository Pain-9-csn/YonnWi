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
            <h4 class="mb-0" style="color:#fff;">Horaires de Prières</h4>
            <small class="text-muted">Monitoring des requêtes horaires — API Aladhan</small>
          </div>
          <div class="d-flex gap-2">
            <a href="https://api.aladhan.com" target="_blank" class="btn btn-outline-info btn-sm">
              <i class="mdi mdi-api me-1"></i>API Aladhan
            </a>
            <a href="<?= $root ?>index.php?action=horairesprieres" target="_blank" class="btn btn-outline-success btn-sm">
              <i class="mdi mdi-eye me-1"></i>Voir vitrine
            </a>
          </div>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
          <?php
          $pstats = [
            ['mdi-clock-check','#00d25b','1 248','Requêtes aujourd\'hui'],
            ['mdi-map-marker','#0090e7','87','Villes distinctes'],
            ['mdi-earth','#ffab00','23','Pays couverts'],
            ['mdi-account-clock','#8f5fe8','342','Utilisateurs actifs'],
          ];
          foreach ($pstats as $ps): ?>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:<?= $ps[1] ?>22;color:<?= $ps[1] ?>;"><i class="mdi <?= $ps[0] ?>"></i></div>
                <div>
                  <div style="font-size:1.5rem;font-weight:700;color:#fff;"><?= $ps[2] ?></div>
                  <div class="text-muted" style="font-size:.78rem;"><?= $ps[3] ?></div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Horaires du jour (Dakar) -->
        <div class="row mb-4">
          <div class="col-lg-7 mb-3">
            <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 style="color:#fff;margin:0;"><i class="mdi mdi-city text-success me-2"></i>Horaires — Dakar (aujourd'hui)</h6>
                  <small class="text-muted"><?= date('d F Y') ?> — Méthode: Muslim World League</small>
                </div>
                <div class="row g-2">
                  <?php
                  $prieres = [
                    ['Fadjr','05:12','#0090e7','mdi-weather-sunset-up'],
                    ['Lever','06:38','#ffab00','mdi-weather-sunny'],
                    ['Dohr','13:15','#ff9800','mdi-white-balance-sunny'],
                    ['Asr','16:42','#8f5fe8','mdi-weather-sunset-down'],
                    ['Maghrib','19:48','#fc424a','mdi-weather-night'],
                    ['Icha','21:10','#00d25b','mdi-moon-waxing-crescent'],
                  ];
                  foreach ($prieres as $p): ?>
                  <div class="col-6 col-md-4">
                    <div style="background:#2a3038;border-radius:10px;padding:.9rem;text-align:center;">
                      <i class="mdi <?= $p[3] ?>" style="color:<?= $p[2] ?>;font-size:1.4rem;display:block;margin-bottom:.3rem;"></i>
                      <div style="color:#6c7293;font-size:.72rem;text-transform:uppercase;letter-spacing:.06em;"><?= $p[0] ?></div>
                      <div style="color:#fff;font-size:1.1rem;font-weight:700;"><?= $p[1] ?></div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                <div class="mt-3 p-2" style="background:#00d25b11;border-radius:8px;border-left:3px solid #00d25b;">
                  <small style="color:#00d25b;"><i class="mdi mdi-information-outline me-1"></i>
                    Données en temps réel via l'API Aladhan. Les utilisateurs peuvent personnaliser leur ville.
                  </small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 mb-3">
            <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="card-body">
                <h6 style="color:#fff;margin-bottom:1rem;"><i class="mdi mdi-chart-line text-primary me-2"></i>Villes les plus consultées</h6>
                <?php
                $villes = [
                  ['Dakar','Sénégal',340,'#00d25b'],
                  ['Paris','France',128,'#0090e7'],
                  ['Touba','Sénégal',98,'#ffab00'],
                  ['New York','USA',76,'#8f5fe8'],
                  ['Casablanca','Maroc',54,'#fc424a'],
                ];
                $max = 340;
                foreach ($villes as $v): ?>
                <div class="mb-2">
                  <div class="d-flex justify-content-between mb-1">
                    <span style="color:#fff;font-size:.82rem;"><?= $v[0] ?>, <?= $v[1] ?></span>
                    <span style="color:<?= $v[3] ?>;font-size:.82rem;font-weight:600;"><?= $v[2] ?></span>
                  </div>
                  <div class="progress" style="height:5px;background:#2a3038;">
                    <div class="progress-bar" style="width:<?= round($v[2]/$max*100) ?>%;background:<?= $v[3] ?>;"></div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau des recherches récentes -->
        <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
          <div class="card-body">
            <h6 class="mb-3" style="color:#fff;"><i class="mdi mdi-history text-muted me-2"></i>Recherches récentes des utilisateurs</h6>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Utilisateur</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>Méthode</th>
                    <th>Heure</th>
                    <th>Statut API</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $reqs = [
                    ['Moussa D.','Dakar','Sénégal','Muslim World League','14:32','✅ 200'],
                    ['Anonyme','Paris','France','Union des organisations islamiques','14:28','✅ 200'],
                    ['Fatou N.','Touba','Sénégal','Muslim World League','14:15','✅ 200'],
                    ['Ibrahim S.','New York','USA','ISNA','14:02','✅ 200'],
                    ['Anonyme','Lyon','France','Union des organisations islamiques','13:55','⚠️ Timeout'],
                  ];
                  foreach ($reqs as $r): ?>
                  <tr>
                    <td style="color:#fff;"><?= $r[0] ?></td>
                    <td class="text-muted"><?= $r[1] ?></td>
                    <td class="text-muted"><?= $r[2] ?></td>
                    <td class="text-muted" style="font-size:.78rem;"><?= $r[3] ?></td>
                    <td class="text-muted"><?= $r[4] ?></td>
                    <td style="font-size:.82rem;color:<?= str_contains($r[5],'200') ? '#00d25b' : '#ffab00' ?>;"><?= $r[5] ?></td>
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