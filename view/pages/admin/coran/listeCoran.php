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
            <h4 class="mb-0" style="color:#fff;">Coran — Suivi des Sourates</h4>
            <small class="text-muted">Les 114 sourates — données issues de l'API Al-Quran Cloud</small>
          </div>
          <div class="d-flex gap-2">
            <a href="https://api.alquran.cloud/v1/surah" target="_blank" class="btn btn-outline-info btn-sm">
              <i class="mdi mdi-api me-1"></i>API Status
            </a>
          </div>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#0090e722;color:#0090e7;"><i class="mdi mdi-book-open-page-variant"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;">114</div>
                  <div class="text-muted" style="font-size:.78rem;">Sourates</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#00d25b22;color:#00d25b;"><i class="mdi mdi-format-list-numbered"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;">6 236</div>
                  <div class="text-muted" style="font-size:.78rem;">Versets (Ayahs)</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#ffab0022;color:#ffab00;"><i class="mdi mdi-star"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;">86</div>
                  <div class="text-muted" style="font-size:.78rem;">Mecquoises</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#8f5fe822;color:#8f5fe8;"><i class="mdi mdi-city"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;">28</div>
                  <div class="text-muted" style="font-size:.78rem;">Médinoises</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Progressions utilisateurs -->
        <div class="row mb-4">
          <div class="col-lg-8 mb-3">
            <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="card-body">
                <h6 class="mb-3" style="color:#fff;">
                  <i class="mdi mdi-chart-bar text-primary me-2"></i>Sourates les plus lues
                </h6>
                <canvas id="coranChart" height="100"></canvas>
              </div>
            </div>
          </div>
          <div class="col-lg-4 mb-3">
            <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="card-body">
                <h6 class="mb-3" style="color:#fff;">
                  <i class="mdi mdi-account-multiple text-success me-2"></i>Progressions actives
                </h6>
                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted" style="font-size:.82rem;">Al-Fatiha (1)</span>
                  <span style="color:#00d25b;font-size:.82rem;">87%</span>
                </div>
                <div class="progress mb-3" style="height:6px;background:#2a3038;">
                  <div class="progress-bar bg-success" style="width:87%"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted" style="font-size:.82rem;">Al-Baqara (2)</span>
                  <span style="color:#0090e7;font-size:.82rem;">62%</span>
                </div>
                <div class="progress mb-3" style="height:6px;background:#2a3038;">
                  <div class="progress-bar bg-primary" style="width:62%"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted" style="font-size:.82rem;">Ya-Sin (36)</span>
                  <span style="color:#ffab00;font-size:.82rem;">74%</span>
                </div>
                <div class="progress mb-3" style="height:6px;background:#2a3038;">
                  <div class="progress-bar bg-warning" style="width:74%"></div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="text-muted" style="font-size:.82rem;">Al-Mulk (67)</span>
                  <span style="color:#8f5fe8;font-size:.82rem;">55%</span>
                </div>
                <div class="progress" style="height:6px;background:#2a3038;">
                  <div class="progress-bar" style="width:55%;background:#8f5fe8;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau sourates -->
        <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
              <h6 class="mb-0" style="color:#fff;">Liste des sourates</h6>
              <div class="d-flex gap-2">
                <div class="search-bar">
                  <input type="text" class="form-control form-control-sm" id="searchSourate" placeholder="🔍  Rechercher…" style="width:200px;">
                </div>
                <select class="form-select form-select-sm" id="filterType" style="width:auto;background:#2a3038;border-color:#2c2e33;color:#fff;">
                  <option value="">Toutes</option>
                  <option value="Meccan">Mecquoises</option>
                  <option value="Medinan">Médinoises</option>
                </select>
              </div>
            </div>
            <div class="table-responsive" style="max-height:420px;overflow-y:auto;">
              <table class="table table-hover" id="tableSourate">
                <thead style="position:sticky;top:0;background:#191c24;z-index:1;">
                  <tr>
                    <th style="width:50px;">N°</th>
                    <th>Nom (Arabe)</th>
                    <th>Nom (Latin)</th>
                    <th>Signification</th>
                    <th>Versets</th>
                    <th>Type</th>
                    <th style="width:80px;">Vitrine</th>
                  </tr>
                </thead>
                <tbody id="tbodySourate">
                  <?php
                  $sourates = [
                    [1,'الفاتحة','Al-Fatiha','L\'Ouverture',7,'Meccan'],
                    [2,'البقرة','Al-Baqara','La Vache',286,'Medinan'],
                    [3,'آل عمران','Ali Imran','La Famille d\'Imran',200,'Medinan'],
                    [4,'النساء','An-Nisa','Les Femmes',176,'Medinan'],
                    [5,'المائدة','Al-Maida','La Table Servie',120,'Medinan'],
                    [6,'الأنعام','Al-Anam','Les Bestiaux',165,'Meccan'],
                    [7,'الأعراف','Al-Araf','Les Murailles',206,'Meccan'],
                    [36,'يس','Ya-Sin','Ya-Sin',83,'Meccan'],
                    [55,'الرحمن','Ar-Rahman','Le Tout Miséricordieux',78,'Medinan'],
                    [67,'الملك','Al-Mulk','La Royauté',30,'Meccan'],
                    [112,'الإخلاص','Al-Ikhlas','Le Monothéisme pur',4,'Meccan'],
                    [113,'الفلق','Al-Falaq','L\'Aube',5,'Meccan'],
                    [114,'الناس','An-Nas','Les Hommes',6,'Meccan'],
                  ];
                  foreach ($sourates as $s): ?>
                  <tr data-type="<?= $s[5] ?>">
                    <td><span style="color:#6c7293;font-size:.8rem;"><?= $s[0] ?></span></td>
                    <td style="font-family:'Arial',sans-serif;font-size:1.1rem;direction:rtl;"><?= $s[1] ?></td>
                    <td style="color:#fff;font-weight:500;"><?= $s[2] ?></td>
                    <td class="text-muted" style="font-size:.82rem;"><?= $s[3] ?></td>
                    <td><span style="color:#0090e7;font-weight:600;"><?= $s[4] ?></span></td>
                    <td>
                      <?php if ($s[5] === 'Meccan'): ?>
                        <span class="badge-status" style="background:#ffab0022;color:#ffab00;">Mecquoise</span>
                      <?php else: ?>
                        <span class="badge-status" style="background:#8f5fe822;color:#8f5fe8;">Médinoise</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?= $root ?>index.php?action=coran&sourate=<?= $s[0] ?>" target="_blank"
                         class="action-btn btn btn-outline-success" title="Voir sur la vitrine">
                        <i class="mdi mdi-eye"></i>
                      </a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <small class="text-muted mt-2 d-block">Affichage de quelques sourates. Les 114 sont disponibles via l'API Al-Quran Cloud.</small>
          </div>
        </div>

      </div>
      <footer class="footer">
        <span class="text-muted d-block text-center">© 2026 Yoonwi — Panneau Admin</span>
      </footer>
    </div>
  </div>
</div>

<?php require_once($root . 'view/sections/admin/script.php'); ?>
<script>
// Filtrage sourates
document.getElementById('searchSourate').addEventListener('input', filterSourates);
document.getElementById('filterType').addEventListener('change', filterSourates);
function filterSourates() {
  const q = document.getElementById('searchSourate').value.toLowerCase();
  const t = document.getElementById('filterType').value;
  document.querySelectorAll('#tbodySourate tr').forEach(tr => {
    const text = tr.textContent.toLowerCase();
    const type = tr.dataset.type || '';
    tr.style.display = (text.includes(q) && (t === '' || type === t)) ? '' : 'none';
  });
}

// Graphique sourates les plus lues
const ctx = document.getElementById('coranChart').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Al-Fatiha', 'Ya-Sin', 'Al-Mulk', 'Ar-Rahman', 'Al-Baqara', 'Al-Ikhlas'],
    datasets: [{
      label: 'Lectures',
      data: [1240, 980, 870, 760, 650, 590],
      backgroundColor: ['#00d25b44','#0090e744','#ffab0044','#8f5fe844','#fc424a44','#57c7d444'],
      borderColor:     ['#00d25b',  '#0090e7',  '#ffab00',  '#8f5fe8',  '#fc424a',  '#57c7d4'],
      borderWidth: 2,
      borderRadius: 6,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      y: { beginAtZero: true, grid: { color:'rgba(255,255,255,.05)' }, ticks: { color:'#6c7293' } },
      x: { grid: { display: false }, ticks: { color:'#6c7293' } }
    }
  }
});
</script>
</body>
</html>