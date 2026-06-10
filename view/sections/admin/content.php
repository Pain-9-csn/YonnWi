<div class="main-panel">
  <div class="content-wrapper">

    <!-- En-tête -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
          <div>
            <h3 class="mb-1" style="font-weight:800;color:#1f2937;">Tableau de bord</h3>
            <p class="text-muted mb-0">
              Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_nom'] ?? 'Administrateur') ?></strong>
              &nbsp;—&nbsp; <?= (new DateTime())->format('d F Y') ?>
            </p>
          </div>
          <span style="font-size:13px;color:#71c55d;font-style:italic;">
            ☪ &nbsp;«&nbsp;Bismillah ir-Rahman ir-Rahim&nbsp;»
          </span>
        </div>
      </div>
    </div>

    <!-- ── Cartes stats ── -->
    <div class="row">
      <?php
      $stats = [
        ['id'=>'stat-users',    'icon'=>'mdi-account-group',                 'label'=>'Membres inscrits',    'val'=>'—'],
        ['id'=>'stat-xassidas', 'icon'=>'mdi-file-pdf-box',                  'label'=>'Xassidas',            'val'=>'—'],
        ['id'=>'stat-audios',   'icon'=>'mdi-music-note',                    'label'=>'Fichiers audio',       'val'=>'—'],
        ['id'=>'stat-coran',    'icon'=>'mdi-book-open-page-variant-outline','label'=>'Sourates du Coran',   'val'=>'114'],
      ];
      foreach ($stats as $s): ?>
      <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <h3 class="mb-0" id="<?= $s['id'] ?>"><?= $s['val'] ?></h3>
              </div>
              <div class="col-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle"
                     style="width:46px;height:46px;background:rgba(113,197,93,.15);">
                  <i class="mdi <?= $s['icon'] ?>" style="font-size:22px;color:#71c55d;"></i>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal mt-2 mb-0"><?= $s['label'] ?></h6>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- ── Accès rapides ── -->
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Accès rapides</h4>
            <div class="row g-3">
              <?php
              $links = [
                ['href'=>'listeXassida',  'icon'=>'mdi-file-pdf-box',                  'label'=>'Xassidas'],
                ['href'=>'listeCoran',    'icon'=>'mdi-book-open-page-variant-outline', 'label'=>'Coran'],
                ['href'=>'listeDouas',    'icon'=>'mdi-hands-pray',                     'label'=>'Douas'],
                ['href'=>'listeAudio',    'icon'=>'mdi-music-note',                     'label'=>'Lecteur Mp3'],
                ['href'=>'listeCapture',  'icon'=>'mdi-microphone-outline',             'label'=>'Dictaphone'],
                ['href'=>'listeHeures',   'icon'=>'mdi-mosque',                         'label'=>'Prières'],
                ['href'=>'listeQibla',    'icon'=>'mdi-compass-outline',               'label'=>'Qibla'],
                ['href'=>'listeFaq',      'icon'=>'mdi-frequently-asked-questions',    'label'=>'FAQ'],
                ['href'=>'listeUser',     'icon'=>'mdi-account-group',                 'label'=>'Utilisateurs'],
                ['href'=>'listNews',      'icon'=>'mdi-email-newsletter',              'label'=>'Newsletters'],
                ['href'=>'listHist',      'icon'=>'mdi-history',                       'label'=>'Historique'],
                ['href'=>'listPara',      'icon'=>'mdi-cog-outline',                   'label'=>'Paramètres'],
              ];
              foreach ($links as $l): ?>
              <div class="col-6 col-md-2">
                <a href="<?= $l['href'] ?>" class="text-decoration-none">
                  <div class="p-3 rounded text-center yw-quicklink">
                    <i class="mdi <?= $l['icon'] ?> mb-1 d-block" style="font-size:28px;color:#71c55d;"></i>
                    <span style="font-weight:700;color:#1f2937;font-size:12px;"><?= $l['label'] ?></span>
                  </div>
                </a>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── Activité récente + Fonctionnalités ── -->
    <div class="row">

      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Activité récente</h4>
            <div class="preview-list">
              <?php
              $activities = [
                ['icon'=>'mdi-account-plus',       'bg'=>'#71c55d', 'title'=>'Nouvel utilisateur',    'desc'=>'Un membre a rejoint la communauté'],
                ['icon'=>'mdi-file-pdf-box',        'bg'=>'#71c55d', 'title'=>'Nouveau Xassida',       'desc'=>'Fichier ajouté à la bibliothèque'],
                ['icon'=>'mdi-music-note',          'bg'=>'#71c55d', 'title'=>'Audio ajouté',          'desc'=>'Nouveau fichier dans le lecteur Mp3'],
                ['icon'=>'mdi-hands-pray',          'bg'=>'#71c55d', 'title'=>'Doua publiée',          'desc'=>'Nouvelle invocation disponible'],
              ];
              foreach ($activities as $i => $a): ?>
              <div class="preview-item <?= $i < count($activities)-1 ? 'border-bottom' : '' ?> py-3">
                <div class="preview-thumbnail">
                  <div class="preview-icon rounded-circle"
                       style="background:rgba(113,197,93,.15);">
                    <i class="mdi <?= $a['icon'] ?>" style="color:#71c55d;"></i>
                  </div>
                </div>
                <div class="preview-item-content d-sm-flex flex-grow">
                  <div class="flex-grow">
                    <h6 class="preview-subject"><?= $a['title'] ?></h6>
                    <p class="text-muted mb-0"><?= $a['desc'] ?></p>
                  </div>
                  <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                    <p class="text-muted" style="font-size:11px;">Récemment</p>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Fonctionnalités de la plateforme</h4>
            <?php
            $features = [
              ['icon'=>'mdi-file-pdf-box',                  'label'=>'Xassidas',         'desc'=>'Textes sacrés mourides en PDF'],
              ['icon'=>'mdi-book-open-page-variant-outline', 'label'=>'Coran',            'desc'=>'114 sourates accessibles'],
              ['icon'=>'mdi-hands-pray',                    'label'=>'Douas',             'desc'=>'Invocations islamiques'],
              ['icon'=>'mdi-music-note',                    'label'=>'Lecteur Mp3',       'desc'=>'Récitations & nasyides'],
              ['icon'=>'mdi-microphone-outline',            'label'=>'Dictaphone',        'desc'=>'Enregistrement vocal intégré'],
              ['icon'=>'mdi-mosque',                        'label'=>'Horaires prières',  'desc'=>'Calcul selon localisation'],
              ['icon'=>'mdi-compass-outline',               'label'=>'Qibla',             'desc'=>'Direction de La Mecque'],
              ['icon'=>'mdi-frequently-asked-questions',    'label'=>'FAQ',               'desc'=>'Questions & réponses spirituelles'],
            ];
            foreach ($features as $f): ?>
            <div class="d-flex align-items-center mb-3">
              <div class="me-3 d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                   style="width:38px;height:38px;background:rgba(113,197,93,.13);">
                <i class="mdi <?= $f['icon'] ?>" style="font-size:18px;color:#71c55d;"></i>
              </div>
              <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <h6 class="mb-0" style="font-weight:700;font-size:13px;"><?= $f['label'] ?></h6>
                  <span class="text-muted" style="font-size:11px;"><?= $f['desc'] ?></span>
                </div>
                <div class="progress" style="height:3px;border-radius:4px;">
                  <div class="progress-bar" style="width:100%;background:#71c55d;"></div>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>

  </div><!-- content-wrapper -->

  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted">© <?= date('Y') ?> <strong style="color:#71c55d;">YoonWi</strong> — Plateforme islamique & mouride</span>
      <span class="text-muted">Fait avec <i class="mdi mdi-heart text-danger"></i> &amp; foi</span>
    </div>
  </footer>

</div><!-- main-panel -->

<style>
.yw-quicklink {
  background: rgba(113,197,93,.10);
  border: 1px solid rgba(113,197,93,.25);
  transition: .2s;
}
.yw-quicklink:hover {
  background: rgba(113,197,93,.22);
  transform: translateY(-2px);
}
</style>