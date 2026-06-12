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
            <h4 class="mb-0" style="color:#fff;">Utilisateurs</h4>
            <small class="text-muted">Membres inscrits sur la plateforme Yoonwi</small>
          </div>
          <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAddUser">
            <i class="mdi mdi-account-plus me-1"></i>Ajouter un admin
          </button>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
          <?php
          $ustats = [
            ['mdi-account-group','#0090e7','347','Inscrits total'],
            ['mdi-account-check','#00d25b','298','Actifs'],
            ['mdi-account-clock','#ffab00','49','Inactifs'],
            ['mdi-shield-account','#fc424a','3','Admins'],
          ];
          foreach ($ustats as $u): ?>
          <div class="col-md-3 col-6 mb-3">
            <div class="card stat-card" style="background:#191c24;border:1px solid #2c2e33;">
              <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:<?= $u[1] ?>22;color:<?= $u[1] ?>;"><i class="mdi <?= $u[0] ?>"></i></div>
                <div>
                  <div style="font-size:1.6rem;font-weight:700;color:#fff;"><?= $u[2] ?></div>
                  <div class="text-muted" style="font-size:.78rem;"><?= $u[3] ?></div>
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
              <h6 class="mb-0" style="color:#fff;">Liste des membres</h6>
              <div class="d-flex gap-2">
                <div class="search-bar">
                  <input type="text" class="form-control form-control-sm" id="searchUser" placeholder="🔍  Nom, email…" style="width:220px;">
                </div>
                <select class="form-select form-select-sm" id="filterRole" style="width:auto;background:#2a3038;border-color:#2c2e33;color:#fff;">
                  <option value="">Tous les rôles</option>
                  <option value="admin">Admin</option>
                  <option value="user">Utilisateur</option>
                </select>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Utilisateur</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Langue</th>
                    <th>Inscrit le</th>
                    <th>Dernière activité</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="tbodyUser">
                  <?php
                  $users = [
                    [1,'Moussa Diallo','moussa@example.com','user','FR','12 Jan 2026','Aujourd\'hui'],
                    [2,'Fatou Ndiaye','fatou@example.com','user','WO','05 Fév 2026','Hier'],
                    [3,'Ibrahim Sall','ibrahim@example.com','admin','AR','01 Jan 2026','Aujourd\'hui'],
                    [4,'Aissatou Ba','aissatou@example.com','user','FR','20 Mars 2026','Il y a 3j'],
                    [5,'Cheikh Toure','cheikh@example.com','user','FR','18 Avril 2026','Il y a 7j'],
                    [6,'Admin Yoonwi','admin@yoonwi.sn','admin','FR','01 Jan 2026','Aujourd\'hui'],
                  ];
                  $langFlags = ['FR'=>'🇫🇷','WO'=>'🇸🇳','AR'=>'🇸🇦','EN'=>'🇬🇧'];
                  foreach ($users as $u): ?>
                  <tr data-role="<?= $u[3] ?>">
                    <td class="text-muted"><?= $u[0] ?></td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div style="width:34px;height:34px;border-radius:50%;background:<?= $u[3]==='admin' ? '#fc424a22' : '#0090e722' ?>;display:flex;align-items:center;justify-content:center;color:<?= $u[3]==='admin' ? '#fc424a' : '#0090e7' ?>;flex-shrink:0;font-weight:700;font-size:.85rem;">
                          <?= strtoupper(substr($u[1],0,1)) ?>
                        </div>
                        <span style="color:#fff;"><?= $u[1] ?></span>
                      </div>
                    </td>
                    <td class="text-muted" style="font-size:.82rem;"><?= $u[2] ?></td>
                    <td>
                      <?php if ($u[3]==='admin'): ?>
                        <span class="badge-status" style="background:#fc424a22;color:#fc424a;"><i class="mdi mdi-shield me-1"></i>Admin</span>
                      <?php else: ?>
                        <span class="badge-status" style="background:#0090e722;color:#0090e7;">Utilisateur</span>
                      <?php endif; ?>
                    </td>
                    <td><?= ($langFlags[$u[4]] ?? '🌐') . ' ' . $u[4] ?></td>
                    <td class="text-muted" style="font-size:.82rem;"><?= $u[5] ?></td>
                    <td>
                      <span style="font-size:.8rem;color:<?= $u[6]==='Aujourd\'hui' ? '#00d25b' : '#6c7293' ?>">
                        <?= $u[6] ?>
                      </span>
                    </td>
                    <td>
                      <button class="action-btn btn btn-outline-info me-1" title="Voir le profil"><i class="mdi mdi-account-eye"></i></button>
                      <button class="action-btn btn btn-outline-primary me-1" title="Modifier"><i class="mdi mdi-pencil"></i></button>
                      <button class="action-btn btn btn-outline-danger" title="Supprimer" <?= $u[3]==='admin' ? 'disabled' : '' ?>><i class="mdi mdi-delete"></i></button>
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

<!-- Modal Ajouter Admin -->
<div class="modal fade" id="modalAddUser" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="mdi mdi-account-plus text-success me-2"></i>Ajouter un administrateur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formAddUser">
          <div class="mb-3">
            <label class="form-label">Nom complet *</label>
            <input type="text" class="form-control" required placeholder="Prénom Nom">
          </div>
          <div class="mb-3">
            <label class="form-label">Adresse email *</label>
            <input type="email" class="form-control" required placeholder="email@domaine.com">
          </div>
          <div class="mb-3">
            <label class="form-label">Mot de passe temporaire *</label>
            <input type="password" class="form-control" required>
            <small class="text-muted">L'utilisateur devra le changer à la première connexion</small>
          </div>
          <div class="mb-3">
            <label class="form-label">Rôle</label>
            <select class="form-select">
              <option value="admin">🛡️ Administrateur</option>
              <option value="user">👤 Utilisateur</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button class="btn btn-success"><i class="mdi mdi-content-save me-1"></i>Créer le compte</button>
      </div>
    </div>
  </div>
</div>

<?php require_once($root . 'view/sections/admin/script.php'); ?>
<script>
document.getElementById('searchUser').addEventListener('input', filterUsers);
document.getElementById('filterRole').addEventListener('change', filterUsers);
function filterUsers() {
  const q = document.getElementById('searchUser').value.toLowerCase();
  const r = document.getElementById('filterRole').value;
  document.querySelectorAll('#tbodyUser tr').forEach(tr => {
    tr.style.display = (tr.textContent.toLowerCase().includes(q) && (!r || tr.dataset.role === r)) ? '' : 'none';
  });
}
</script>
</body>
</html>