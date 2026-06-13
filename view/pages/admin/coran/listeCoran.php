<?php
require_once __DIR__ . '/../../../../model/DB.php';

$pdo          = null;
$progressions = [];
$msg          = '';
$error        = '';
require_once("../../../sections/admin/head.php");
   require_once("../../../sections/admin/navbar.php");
    require_once("../../../sections/admin/sidebar.php");
try {
    $db  = new DB();
    $pdo = $db->getConnexion();

    // Supprimer une progression
    if (isset($_POST['supprimer'])) {
        $id = (int) ($_POST['id'] ?? 0);
        $pdo->prepare("DELETE FROM historique_coran WHERE id = ?")->execute([$id]);
        $msg = "Progression supprimée.";
    }

    // Réinitialiser toutes
    if (isset($_POST['reinitialiser_tout'])) {
        $pdo->exec("DELETE FROM historique_coran");
        $msg = "Toutes les progressions ont été réinitialisées.";
    }

    // ── Récupération avec jointure user ─────────────
    $progressions = $pdo->query("
        SELECT h.id, h.sourate_num, h.verset_num, h.updated_at,
               u.nom, u.email
        FROM historique_coran h
        LEFT JOIN utilisateur u ON u.id = h.user_id
        ORDER BY h.updated_at DESC
    ")->fetchAll();

} catch (Exception $e) {
    $error = $e->getMessage();
}

// Noms des sourates (quelques-unes pour l'affichage)
$nomsSourates = [
    1=>'Al-Fatiha', 2=>'Al-Baqara', 3=>'Ali Imran', 4=>'An-Nisa', 5=>'Al-Maida',
    6=>'Al-Anam', 7=>'Al-Araf', 8=>'Al-Anfal', 9=>'At-Tawba', 10=>'Yunus',
    36=>'Ya-Sin', 67=>'Al-Mulk', 112=>'Al-Ikhlas', 113=>'Al-Falaq', 114=>'An-Nas',
];
?>

<div class="main-panel">
  <div class="content-wrapper">

    <div class="page-header mb-3">
      <h3 class="page-title"><span class="page-title-icon bg-gradient-warning text-white me-2"><i class="mdi mdi-book-open-variant"></i></span>Progressions Coran</h3>
      <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li><li class="breadcrumb-item active">Coran</li></ol></nav>
    </div>

    <?php if ($msg): ?><div class="alert alert-success alert-dismissible fade show"><?= htmlspecialchars($msg) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>

    <div class="mb-3">
      <form method="POST" onsubmit="return confirm('Réinitialiser TOUTES les progressions ?')">
        <button type="submit" name="reinitialiser_tout" class="btn btn-outline-danger btn-sm">
          <i class="mdi mdi-refresh"></i> Réinitialiser tout
        </button>
      </form>
    </div>

    <div class="row grid-margin">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Historique de lecture <span class="badge bg-warning ms-2"><?= count($progressions) ?></span></h4>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr><th>#</th><th>Utilisateur</th><th>Email</th><th>Sourate</th><th class="text-center">Verset</th><th>Dernière lecture</th><th class="text-center">Action</th></tr>
                </thead>
                <tbody>
                  <?php if (empty($progressions)): ?>
                  <tr><td colspan="7" class="text-center text-muted">Aucune progression enregistrée.</td></tr>
                  <?php else: ?>
                  <?php foreach ($progressions as $p): ?>
                  <tr>
                    <td><?= (int)$p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nom'] ?? 'Anonyme') ?></td>
                    <td><small class="text-muted"><?= htmlspecialchars($p['email'] ?? '—') ?></small></td>
                    <td>
                      <strong><?= (int)$p['sourate_num'] ?></strong>
                      <small class="text-muted ms-1"><?= htmlspecialchars($nomsSourates[(int)$p['sourate_num']] ?? 'Sourate '.$p['sourate_num']) ?></small>
                    </td>
                    <td class="text-center"><span class="badge bg-primary">v.<?= (int)$p['verset_num'] ?></span></td>
                    <td><?= date('d/m/Y H:i', strtotime($p['updated_at'])) ?></td>
                    <td class="text-center">
                      <form method="POST" style="display:inline" onsubmit="return confirm('Supprimer cette progression ?')">
                        <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                        <button type="submit" name="supprimer" class="btn btn-xs btn-outline-danger"><i class="mdi mdi-trash-can"></i></button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php require_once __DIR__ . '/../../../sections/admin/footer.php'; ?>
</div>