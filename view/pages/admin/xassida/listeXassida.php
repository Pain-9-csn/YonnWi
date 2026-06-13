<?php
// ── Connexion BD ────────────────────────────────────────────
require_once __DIR__ . '/../../../../model/DB.php';
$db  = new DB();
$pdo = $db->getConnexion();

$msg_ok  = '';
$msg_err = '';

// ── Actions POST ────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // AJOUTER
    if (isset($_POST['action']) && $_POST['action'] === 'ajouter') {
        $titre       = trim($_POST['titre']       ?? '');
        $auteur      = trim($_POST['auteur']      ?? '');
        $description = trim($_POST['description'] ?? '');
        $audio_url   = trim($_POST['audio_url']   ?? '');
        $image_url   = trim($_POST['image_url']   ?? '');

        if ($titre === '') {
            $msg_err = 'Le titre est obligatoire.';
        } else {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO xassaide (titre, auteur, description, audio_url, image_url)
                    VALUES (:titre, :auteur, :description, :audio_url, :image_url)
                ");
                $stmt->execute([
                    ':titre'       => $titre,
                    ':auteur'      => $auteur,
                    ':description' => $description,
                    ':audio_url'   => $audio_url,
                    ':image_url'   => $image_url,
                ]);
                $msg_ok = 'Xassida ajouté avec succès.';
            } catch (PDOException $e) {
                $msg_err = 'Erreur lors de l\'ajout : ' . $e->getMessage();
            }
        }
    }

    // SUPPRIMER
    if (isset($_POST['action']) && $_POST['action'] === 'supprimer') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            try {
                $pdo->prepare("DELETE FROM xassaide WHERE id = :id")->execute([':id' => $id]);
                $msg_ok = 'Xassida supprimé.';
            } catch (PDOException $e) {
                $msg_err = 'Erreur suppression : ' . $e->getMessage();
            }
        }
    }
}

// ── Liste ────────────────────────────────────────────────────
try {
    $xassidas = $pdo->query("SELECT * FROM xassaide ORDER BY id DESC")->fetchAll();
} catch (Exception $e) {
    $xassidas = [];
    $msg_err  = 'Impossible de charger les xassidas : ' . $e->getMessage();
}
?>

<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h3>🎵 Xassidas</h3>
        <p>Gérez la bibliothèque de xassidas / khassidas</p>
    </div>
    <button class="btn btn-accent" data-bs-toggle="modal" data-bs-target="#modalAjout">
        <i class="mdi mdi-plus me-1"></i> Nouveau xassida
    </button>
</div>

<?php if ($msg_ok): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($msg_ok) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>
<?php if ($msg_err): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($msg_err) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Tableau -->
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">
                <?= count($xassidas) ?> xassida<?= count($xassidas) > 1 ? 's' : '' ?>
            </h5>
            <input type="text" id="searchXassida" class="form-control" placeholder="Rechercher..." style="max-width:260px;">
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="tableXassida">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Audio</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($xassidas)): ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Aucun xassida enregistré.</td></tr>
                <?php else: foreach ($xassidas as $x): ?>
                    <tr>
                        <td><?= $x['id'] ?></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <?php if (!empty($x['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($x['image_url']) ?>" alt="" style="width:36px;height:36px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center bg-light" style="width:36px;height:36px;border-radius:6px;font-size:18px;">🎵</div>
                                <?php endif; ?>
                                <div>
                                    <div class="fw-semibold"><?= htmlspecialchars($x['titre']) ?></div>
                                    <?php if (!empty($x['description'])): ?>
                                        <small class="text-muted"><?= htmlspecialchars(mb_substr($x['description'], 0, 60)) ?>…</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($x['auteur'] ?? '—') ?></td>
                        <td>
                            <?php if (!empty($x['audio_url'])): ?>
                                <audio controls style="height:32px;max-width:180px;">
                                    <source src="<?= htmlspecialchars($x['audio_url']) ?>">
                                </audio>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Supprimer ce xassida ?')">
                                <input type="hidden" name="action" value="supprimer">
                                <input type="hidden" name="id" value="<?= $x['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger action-btn">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajout -->
<div class="modal fade" id="modalAjout" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">➕ Ajouter un xassida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="ajouter">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                            <input type="text" name="titre" class="form-control" placeholder="Ex: Khassida Burdah" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Auteur</label>
                            <input type="text" name="auteur" class="form-control" placeholder="Ex: Cheikh Ahmadou Bamba">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Description du xassida..."></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">URL Audio</label>
                            <input type="url" name="audio_url" class="form-control" placeholder="https://...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">URL Image</label>
                            <input type="url" name="image_url" class="form-control" placeholder="https://...">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-accent">
                        <i class="mdi mdi-content-save me-1"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('searchXassida').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tableXassida tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>