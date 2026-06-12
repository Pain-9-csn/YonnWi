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
            <h4 class="mb-0" style="color:#fff;">Douas & Invocations</h4>
            <small class="text-muted">Gérer les douas affichées sur la vitrine (filtres : matin, soir, prière…)</small>
          </div>
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddDoua">
            <i class="mdi mdi-plus me-1"></i>Ajouter une doua
          </button>
        </div>

        <!-- Stats catégories -->
        <div class="row mb-4">
          <?php
          $cats = [
            ['🌅','matin','Matin','#ffab00',12],
            ['🌙','soir','Soir','#8f5fe8',8],
            ['🕌','priere','Après prière','#0090e7',15],
            ['📅','quotidien','Quotidien','#00d25b',10],
            ['🛡️','protection','Protection','#fc424a',6],
          ];
          foreach ($cats as $c): ?>
          <div class="col mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:<?= $c[3] ?>22;color:<?= $c[3] ?>;font-size:1.3rem;"><?= $c[0] ?></div>
                <div>
                  <div style="font-size:1.4rem;font-weight:700;color:#fff;"><?= $c[4] ?></div>
                  <div class="text-muted" style="font-size:.78rem;"><?= $c[2] ?></div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- Tableau -->
        <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
              <h6 class="mb-0" style="color:#fff;">Liste des douas</h6>
              <div class="d-flex gap-2 flex-wrap">
                <div class="search-bar">
                  <input type="text" class="form-control form-control-sm" id="searchDoua" placeholder="🔍  Rechercher…" style="width:200px;">
                </div>
                <select class="form-select form-select-sm" id="filterDoua" style="width:auto;background:#2a3038;border-color:#2c2e33;color:#fff;">
                  <option value="">Toutes</option>
                  <?php foreach ($cats as $c): ?>
                  <option value="<?= $c[1] ?>"><?= $c[0] ?> <?= $c[2] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Doua (Arabe)</th>
                    <th>Traduction française</th>
                    <th>Catégorie</th>
                    <th>Source</th>
                    <th>Ordre</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="tbodyDoua">
                  <?php
                  $douas = [
                    [1,'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ','Au nom d\'Allah, le Tout Miséricordieux','quotidien','Coran 1:1',1],
                    [2,'اللَّهُمَّ أَصْبَحْنَا نُشْهِدُكَ','Ô Allah, nous prenons Ton témoignage ce matin','matin','Hadith Abou Dawoud',2],
                    [3,'اللَّهُمَّ بِكَ أَمْسَيْنَا','Ô Allah, c\'est par Toi que nous entrons dans le soir','soir','Hadith Tirmidhi',1],
                    [4,'اللَّهُمَّ أَعِنِّي عَلَى ذِكْرِكَ','Ô Allah, aide-moi à Te mentionner','priere','Hadith Abou Dawoud',1],
                    [5,'أَعُوذُ بِاللَّهِ مِنَ الشَّيْطَانِ الرَّجِيمِ','Je cherche refuge auprès d\'Allah contre Satan','protection','Coran 16:98',1],
                    [6,'رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً','Notre Seigneur, accorde-nous le bien ici-bas','quotidien','Coran 2:201',3],
                  ];
                  $catLabels = ['matin'=>['🌅','#ffab00'],'soir'=>['🌙','#8f5fe8'],'priere'=>['🕌','#0090e7'],'quotidien'=>['📅','#00d25b'],'protection'=>['🛡️','#fc424a']];
                  foreach ($douas as $d):
                    [$emoji,$color] = $catLabels[$d[3]] ?? ['📿','#6c7293'];
                  ?>
                  <tr data-cat="<?= $d[3] ?>">
                    <td class="text-muted"><?= $d[0] ?></td>
                    <td style="font-family:Arial,sans-serif;direction:rtl;font-size:1rem;color:#fff;max-width:200px;"><?= $d[1] ?></td>
                    <td class="text-muted" style="max-width:260px;font-size:.82rem;"><?= $d[2] ?></td>
                    <td><span class="badge-status" style="background:<?= $color ?>22;color:<?= $color ?>;"><?= $emoji ?> <?= ucfirst($d[3]) ?></span></td>
                    <td class="text-muted" style="font-size:.78rem;"><?= $d[4] ?></td>
                    <td>
                      <input type="number" value="<?= $d[5] ?>" min="1" class="form-control form-control-sm"
                             style="width:60px;background:#2a3038;border-color:#2c2e33;color:#fff;">
                    </td>
                    <td>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier" data-bs-toggle="modal" data-bs-target="#modalEditDoua"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer"><i class="mdi mdi-delete"></i></button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <small class="text-muted mt-2 d-block">
              <i class="mdi mdi-information-outline me-1"></i>
              Les douas sont affichées sur la vitrine avec traduction multilingue (FR, AR, EN, WO)
            </small>
          </div>
        </div>

      </div>
      <footer class="footer"><span class="text-muted d-block text-center">© 2026 Yoonwi — Panneau Admin</span></footer>
    </div>
  </div>
</div>

<!-- Modal Ajouter Doua -->
<div class="modal fade" id="modalAddDoua" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="mdi mdi-hands-pray text-success me-2"></i>Ajouter une Doua</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formAddDoua">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Texte arabe *</label>
              <textarea class="form-control" rows="3" dir="rtl" style="font-size:1.1rem;" required placeholder="النص بالعربية"></textarea>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Translittération</label>
              <textarea class="form-control" rows="3" placeholder="Bismillahi r-rahmani r-rahim..."></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Traduction française *</label>
              <textarea class="form-control" rows="2" required placeholder="Traduction en français"></textarea>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Traduction anglaise</label>
              <textarea class="form-control" rows="2" placeholder="English translation"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Traduction Wolof</label>
              <textarea class="form-control" rows="2" placeholder="Traduction en wolof"></textarea>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label">Catégorie *</label>
              <select class="form-select" required>
                <option value="">— Choisir —</option>
                <option value="matin">🌅 Matin</option>
                <option value="soir">🌙 Soir</option>
                <option value="priere">🕌 Après prière</option>
                <option value="quotidien">📅 Quotidien</option>
                <option value="protection">🛡️ Protection</option>
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label">Source</label>
              <input type="text" class="form-control" placeholder="Ex: Coran 2:201">
            </div>
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
document.getElementById('searchDoua').addEventListener('input', filterDouas);
document.getElementById('filterDoua').addEventListener('change', filterDouas);
function filterDouas() {
  const q = document.getElementById('searchDoua').value.toLowerCase();
  const f = document.getElementById('filterDoua').value;
  document.querySelectorAll('#tbodyDoua tr').forEach(tr => {
    tr.style.display = (tr.textContent.toLowerCase().includes(q) && (!f || tr.dataset.cat === f)) ? '' : 'none';
  });
}
</script>
</body>
</html>