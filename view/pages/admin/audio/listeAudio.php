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
            <h4 class="mb-0" style="color:#fff;">Bibliothèque Audio</h4>
            <small class="text-muted">Gérer les fichiers audio des xassidas et récitations</small>
          </div>
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddAudio">
            <i class="mdi mdi-plus me-1"></i> Ajouter un audio
          </button>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
          <?php
          $stats = [
            ['icon'=>'mdi-music','bg'=>'#00d25b','val'=>'148','label'=>'Audios total'],
            ['icon'=>'mdi-play-circle','bg'=>'#0090e7','val'=>'12 540','label'=>'Écoutes totales'],
            ['icon'=>'mdi-harddisk','bg'=>'#ffab00','val'=>'2.4 GB','label'=>'Espace utilisé'],
            ['icon'=>'mdi-microphone','bg'=>'#8f5fe8','val'=>'23','label'=>'Empreintes enregistrées'],
          ];
          foreach ($stats as $st): ?>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:<?= $st['bg'] ?>22;color:<?= $st['bg'] ?>;">
                  <i class="mdi <?= $st['icon'] ?>"></i>
                </div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;"><?= $st['val'] ?></div>
                  <div class="text-muted" style="font-size:.78rem;"><?= $st['label'] ?></div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Tableau audio -->
        <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
              <h6 class="mb-0" style="color:#fff;">Fichiers audio</h6>
              <div class="d-flex gap-2">
                <div class="search-bar">
                  <input type="text" class="form-control form-control-sm" id="searchAudio" placeholder="🔍  Rechercher…" style="width:220px;">
                </div>
                <select class="form-select form-select-sm" id="filterCateg" style="width:auto;background:#2a3038;border-color:#2c2e33;color:#fff;">
                  <option value="">Toutes catégories</option>
                  <option value="xassida">Xassida</option>
                  <option value="coran">Récitation Coran</option>
                  <option value="dua">Doua</option>
                </select>
                <a href="corbeilleAudio.php" class="btn btn-outline-secondary btn-sm">
                  <i class="mdi mdi-delete-restore"></i>
                </a>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Durée</th>
                    <th>Taille</th>
                    <th>Écoutes</th>
                    <th>Empreinte</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="tbodyAudio">
                  <?php
                  $audios = [
                    [1,'Mawahibou Nafih — Récitation complète','xassida','48:32','45 MB',1240,true],
                    [2,'Shakawtou Rabbiyya — Extrait','xassida','12:10','11 MB',980,true],
                    [3,'Al-Fatiha — Sheikh Alafasy','coran','0:52','1.2 MB',760,false],
                    [4,'Al-Mulk — Sheikh Sudais','coran','4:15','4.8 MB',650,false],
                    [5,'Doua après la prière','dua','3:40','3.2 MB',430,false],
                    [6,'Chakartou Rabbiyya','xassida','35:00','33 MB',320,true],
                  ];
                  foreach ($audios as $a):
                    $catColors = ['xassida'=>['#00d25b','#00d25b22'],'coran'=>['#0090e7','#0090e722'],'dua'=>['#8f5fe8','#8f5fe822']];
                    [$cc,$cbg] = $catColors[$a[2]] ?? ['#6c7293','#2a3038'];
                  ?>
                  <tr data-categ="<?= $a[2] ?>">
                    <td><span class="text-muted"><?= $a[0] ?></span></td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:8px;background:<?= $cbg ?>;display:flex;align-items:center;justify-content:center;color:<?= $cc ?>;flex-shrink:0;">
                          <i class="mdi mdi-music-note"></i>
                        </div>
                        <span style="color:#fff;"><?= $a[1] ?></span>
                      </div>
                    </td>
                    <td><span class="badge-status" style="background:<?= $cbg ?>;color:<?= $cc ?>;"><?= ucfirst($a[2]) ?></span></td>
                    <td class="text-muted"><?= $a[3] ?></td>
                    <td class="text-muted"><?= $a[4] ?></td>
                    <td><span style="color:#0090e7;font-weight:600;"><?= number_format($a[5]) ?></span></td>
                    <td>
                      <?php if ($a[6]): ?>
                        <span class="badge-status" style="background:#00d25b22;color:#00d25b;"><i class="mdi mdi-fingerprint me-1"></i>Oui</span>
                      <?php else: ?>
                        <span class="badge-status" style="background:#2a3038;color:#6c7293;">Non</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <button class="action-btn btn btn-outline-success me-1" title="Écouter"><i class="mdi mdi-play"></i></button>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer"><i class="mdi mdi-delete"></i></button>
                    </td>
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

<!-- Modal Ajouter Audio -->
<div class="modal fade" id="modalAddAudio" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="mdi mdi-music-box-multiple text-success me-2"></i>Ajouter un audio</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formAddAudio">
          <div class="mb-3">
            <label class="form-label">Titre *</label>
            <input type="text" class="form-control" required placeholder="Ex: Mawahibou Nafih — Récitation complète">
          </div>
          <div class="mb-3">
            <label class="form-label">Catégorie *</label>
            <select class="form-select" required>
              <option value="">— Sélectionner —</option>
              <option value="xassida">Xassida</option>
              <option value="coran">Récitation Coran</option>
              <option value="dua">Doua</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Fichier audio *</label>
            <input type="file" class="form-control" accept="audio/*" required>
            <small class="text-muted">Formats acceptés : MP3, WAV, OGG — Max 100 MB</small>
          </div>
          <div class="mb-3">
            <label class="form-label">Xassida associé</label>
            <select class="form-select">
              <option value="">— Aucun —</option>
              <option>Mawahibou Nafih</option>
              <option>Shakawtou Rabbiyya</option>
              <option>Chakartou Rabbiyya</option>
            </select>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="genFp">
            <label class="form-check-label" for="genFp" style="color:#a0a0b0;">
              Générer une empreinte pour la reconnaissance vocale
            </label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-success"><i class="mdi mdi-content-save me-1"></i>Enregistrer</button>
      </div>
    </div>
  </div>
</div>

<?php require_once($root . 'view/sections/admin/script.php'); ?>
<script>
document.getElementById('searchAudio').addEventListener('input', function() {
  const q = this.value.toLowerCase();
  const cat = document.getElementById('filterCateg').value;
  document.querySelectorAll('#tbodyAudio tr').forEach(tr => {
    tr.style.display = (tr.textContent.toLowerCase().includes(q) && (!cat || tr.dataset.categ === cat)) ? '' : 'none';
  });
});
document.getElementById('filterCateg').addEventListener('change', function() {
  document.getElementById('searchAudio').dispatchEvent(new Event('input'));
});
</script>
</body>
</html>