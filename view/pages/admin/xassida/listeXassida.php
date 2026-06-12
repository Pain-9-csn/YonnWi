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

        <!-- En-tête -->
        <div class="page-action-bar">
          <div>
            <h4 class="mb-0" style="color:#fff;">Xassidas PDF</h4>
            <small class="text-muted">Gestion des khassidas disponibles sur la vitrine</small>
          </div>
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">
            <i class="mdi mdi-plus me-1"></i> Ajouter un Xassida
          </button>
        </div>

        <!-- Stats rapides -->
        <div class="row mb-4">
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#00d25b22;color:#00d25b;"><i class="mdi mdi-book-music"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;" id="stat-total">—</div>
                  <div class="text-muted" style="font-size:.78rem;">Total Xassidas</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#0090e722;color:#0090e7;"><i class="mdi mdi-check-circle"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;" id="stat-actif">—</div>
                  <div class="text-muted" style="font-size:.78rem;">Disponibles</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#ffab0022;color:#ffab00;"><i class="mdi mdi-file-pdf-box"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;" id="stat-volumineux">—</div>
                  <div class="text-muted" style="font-size:.78rem;">Volumineux</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:#fc424a22;color:#fc424a;"><i class="mdi mdi-cancel"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;" id="stat-indispo">—</div>
                  <div class="text-muted" style="font-size:.78rem;">Indisponibles</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau -->
        <div class="card" style="background:#191c24;border:1px solid #2c2e33;">
          <div class="card-body">

            <!-- Barre de recherche + filtre -->
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
              <div class="search-bar" style="flex:1;min-width:200px;max-width:320px;">
                <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="🔍  Rechercher un xassida...">
              </div>
              <div class="d-flex gap-2">
                <select class="form-select form-select-sm" id="filterStatut" style="width:auto;background:#2a3038;border-color:#2c2e33;color:#fff;">
                  <option value="">Tous les statuts</option>
                  <option value="optimal">Optimal</option>
                  <option value="volumineux">Volumineux</option>
                  <option value="indisponible">Indisponible</option>
                </select>
                <a href="corbeilleXassida.php" class="btn btn-outline-secondary btn-sm">
                  <i class="mdi mdi-delete-restore me-1"></i>Corbeille
                </a>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover" id="tableXassida">
                <thead>
                  <tr>
                    <th style="width:50px;">#</th>
                    <th>Titre</th>
                    <th>Auteur / Source</th>
                    <th>Date d'ajout</th>
                    <th>Statut</th>
                    <th style="width:120px;">Actions</th>
                  </tr>
                </thead>
                <tbody id="tbody">
                  <tr>
                    <td>1</td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:8px;background:#00d25b22;display:flex;align-items:center;justify-content:center;color:#00d25b;flex-shrink:0;">
                          <i class="mdi mdi-file-pdf-box"></i>
                        </div>
                        <span>Mawahibou Nafih</span>
                      </div>
                    </td>
                    <td class="text-muted">Cheikh Ahmadou Bamba</td>
                    <td class="text-muted">15 Mai 2026</td>
                    <td><span class="badge-status" style="background:#00d25b22;color:#00d25b;">Optimal</span></td>
                    <td>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer"><i class="mdi mdi-delete"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:8px;background:#00d25b22;display:flex;align-items:center;justify-content:center;color:#00d25b;flex-shrink:0;">
                          <i class="mdi mdi-file-pdf-box"></i>
                        </div>
                        <span>Shakawtou Rabbiyya</span>
                      </div>
                    </td>
                    <td class="text-muted">Cheikh Ahmadou Bamba</td>
                    <td class="text-muted">14 Mai 2026</td>
                    <td><span class="badge-status" style="background:#00d25b22;color:#00d25b;">Optimal</span></td>
                    <td>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer"><i class="mdi mdi-delete"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:8px;background:#ffab0022;display:flex;align-items:center;justify-content:center;color:#ffab00;flex-shrink:0;">
                          <i class="mdi mdi-file-pdf-box"></i>
                        </div>
                        <span>Doll 1</span>
                      </div>
                    </td>
                    <td class="text-muted">—</td>
                    <td class="text-muted">29 Mars 2026</td>
                    <td><span class="badge-status" style="background:#ffab0022;color:#ffab00;">Volumineux</span></td>
                    <td>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer"><i class="mdi mdi-delete"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:36px;height:36px;border-radius:8px;background:#fc424a22;display:flex;align-items:center;justify-content:center;color:#fc424a;flex-shrink:0;">
                          <i class="mdi mdi-file-pdf-box"></i>
                        </div>
                        <span>Chakartou Rabbiyya</span>
                      </div>
                    </td>
                    <td class="text-muted">—</td>
                    <td class="text-muted">20 Mai 2018</td>
                    <td><span class="badge-status" style="background:#fc424a22;color:#fc424a;">Indisponible</span></td>
                    <td>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer"><i class="mdi mdi-delete"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
              <small class="text-muted" id="tableInfo">4 entrée(s) affichée(s)</small>
            </div>
          </div>
        </div>

      </div><!-- content-wrapper -->

      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center d-block d-sm-inline-block">© 2026 Yoonwi — Panneau Admin</span>
        </div>
      </footer>
    </div><!-- main-panel -->
  </div><!-- page-body-wrapper -->
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="modalAdd" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="mdi mdi-plus-circle text-success me-2"></i>Ajouter un Xassida</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formAdd">
          <div class="mb-3">
            <label class="form-label">Titre *</label>
            <input type="text" class="form-control" name="titre" required placeholder="Ex: Mawahibou Nafih">
          </div>
          <div class="mb-3">
            <label class="form-label">Auteur / Source</label>
            <input type="text" class="form-control" name="auteur" placeholder="Ex: Cheikh Ahmadou Bamba">
          </div>
          <div class="mb-3">
            <label class="form-label">Fichier PDF *</label>
            <input type="file" class="form-control" name="fichier" accept="application/pdf" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="2" placeholder="Courte description…"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Statut *</label>
            <select class="form-select" name="statut" required>
              <option value="">— Sélectionner —</option>
              <option value="optimal">✅ Optimal (lisible, taille raisonnable)</option>
              <option value="volumineux">⚠️ Volumineux (peut être lent)</option>
              <option value="indisponible">❌ Indisponible</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" form="formAdd" class="btn btn-success">
          <i class="mdi mdi-content-save me-1"></i>Enregistrer
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Modifier -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="mdi mdi-pencil text-primary me-2"></i>Modifier le Xassida</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEdit">
          <div class="mb-3">
            <label class="form-label">Titre *</label>
            <input type="text" class="form-control" name="titre" value="Mawahibou Nafih" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Auteur / Source</label>
            <input type="text" class="form-control" name="auteur" value="Cheikh Ahmadou Bamba">
          </div>
          <div class="mb-3">
            <label class="form-label">Remplacer le PDF</label>
            <input type="file" class="form-control" name="fichier" accept="application/pdf">
            <small class="text-muted">Laisser vide pour conserver l'actuel</small>
          </div>
          <div class="mb-3">
            <label class="form-label">Statut *</label>
            <select class="form-select" name="statut" required>
              <option value="optimal" selected>✅ Optimal</option>
              <option value="volumineux">⚠️ Volumineux</option>
              <option value="indisponible">❌ Indisponible</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="submit" form="formEdit" class="btn btn-primary">
          <i class="mdi mdi-content-save me-1"></i>Mettre à jour
        </button>
      </div>
    </div>
  </div>
</div>

<?php require_once($root . 'view/sections/admin/script.php'); ?>
<script>
// Recherche en temps réel
document.getElementById('searchInput').addEventListener('input', filterTable);
document.getElementById('filterStatut').addEventListener('change', filterTable);

function filterTable() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  const s = document.getElementById('filterStatut').value.toLowerCase();
  const rows = document.querySelectorAll('#tbody tr');
  let visible = 0;
  rows.forEach(tr => {
    const text = tr.textContent.toLowerCase();
    const statut = tr.querySelector('.badge-status')?.textContent.toLowerCase() || '';
    const show = text.includes(q) && (s === '' || statut.includes(s));
    tr.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  document.getElementById('tableInfo').textContent = visible + ' entrée(s) affichée(s)';
}

// Stats
const rows = document.querySelectorAll('#tbody tr');
document.getElementById('stat-total').textContent = rows.length;
let actif = 0, vol = 0, indispo = 0;
rows.forEach(tr => {
  const s = tr.querySelector('.badge-status')?.textContent.toLowerCase() || '';
  if (s.includes('optimal')) actif++;
  else if (s.includes('volumineux')) vol++;
  else if (s.includes('indisponible')) indispo++;
});
document.getElementById('stat-actif').textContent = actif;
document.getElementById('stat-volumineux').textContent = vol;
document.getElementById('stat-indispo').textContent = indispo;
</script>
</body>
</html>