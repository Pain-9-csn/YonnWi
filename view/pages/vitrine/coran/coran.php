<!DOCTYPE html>
<html lang="fr" dir="<?= $t['dir'] ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['titre']) ?> — YonnWi</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

    <style>
        :root {
            --accent: #71c55d;
            --accent-dark: #5fb04d;
            --accent-light: color-mix(in srgb, var(--accent), white 88%);
            --accent-border: color-mix(in srgb, var(--accent), transparent 72%);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --bg-card: #ffffff;
            --bg-page: #f7faf7;
            --radius-lg: 16px;
            --radius-md: 10px;
            --shadow-sm: 0 2px 12px rgba(113, 197, 93, .10);
            --shadow-md: 0 6px 28px rgba(113, 197, 93, .14);
        }

        body {
            background: var(--bg-page);
            font-family: 'Poppins', sans-serif;
        }

        .coran-hero {
            background: linear-gradient(135deg,
                    color-mix(in srgb, var(--accent), white 82%) 0%,
                    color-mix(in srgb, var(--accent), white 92%) 100%);
            border-bottom: 1px solid var(--accent-border);
            padding: 56px 0 40px;
            text-align: center;
        }

        .coran-hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .coran-hero p {
            color: var(--text-muted);
            font-size: .95rem;
        }

        .hero-bismillah {
            font-family: 'Amiri', serif;
            font-size: 1.9rem;
            color: var(--accent-dark);
            letter-spacing: .04em;
            margin: 8px 0 0;
        }

        .coran-wrap {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 20px 60px;
        }

        @media (max-width: 900px) {
            .coran-wrap {
                grid-template-columns: 1fr;
            }

            .sidebar-sourates {
                display: none;
            }

            .sidebar-sourates.open {
                display: block;
            }
        }

        .sidebar-sourates {
            background: var(--bg-card);
            border: 1px solid var(--accent-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            position: sticky;
            top: 90px;
            max-height: calc(100vh - 110px);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 16px 18px 12px;
            border-bottom: 1px solid var(--accent-border);
            background: var(--accent-light);
        }

        .sidebar-header h6 {
            font-weight: 600;
            color: var(--text-main);
            margin: 0 0 10px;
            font-size: .85rem;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .search-sourate {
            width: 100%;
            border: 1px solid var(--accent-border);
            border-radius: 8px;
            padding: 8px 12px;
            font-size: .85rem;
            outline: none;
            background: #fff;
            color: var(--text-main);
            transition: border-color .25s;
        }

        .search-sourate:focus {
            border-color: var(--accent);
        }

        .liste-sourates {
            overflow-y: auto;
            flex: 1;
            padding: 8px 0;
        }

        .sourate-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 18px;
            cursor: pointer;
            transition: background .18s;
            border-left: 3px solid transparent;
        }

        .sourate-item:hover {
            background: var(--accent-light);
        }

        .sourate-item.active {
            background: var(--accent-light);
            border-left-color: var(--accent);
        }

        .sourate-num {
            min-width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent-light);
            border: 1px solid var(--accent-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 600;
            color: var(--accent-dark);
            flex-shrink: 0;
        }

        .sourate-item.active .sourate-num {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .sourate-info {
            flex: 1;
            min-width: 0;
        }

        .sourate-nom-fr {
            font-size: .82rem;
            font-weight: 500;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sourate-meta-small {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .sourate-nom-ar {
            font-family: 'Amiri', serif;
            font-size: 1rem;
            color: var(--accent-dark);
            flex-shrink: 0;
        }

        .zone-lecture {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sourate-header-card {
            background: var(--bg-card);
            border: 1px solid var(--accent-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            padding: 24px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .sourate-header-card .nom-arabe {
            font-family: 'Amiri', serif;
            font-size: 2.2rem;
            color: var(--accent-dark);
            line-height: 1;
        }

        .sourate-header-card .nom-latin {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .sourate-header-card .badge-type {
            font-size: .72rem;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid var(--accent-border);
            color: var(--accent-dark);
            background: var(--accent-light);
            font-weight: 500;
        }

        .sourate-stats {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .stat-item {
            text-align: center;
        }

        .stat-val {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--accent-dark);
        }

        .stat-lab {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .bismillah-card {
            background: var(--accent-light);
            border: 1px solid var(--accent-border);
            border-radius: var(--radius-md);
            padding: 18px;
            text-align: center;
            font-family: 'Amiri', serif;
            font-size: 1.6rem;
            color: var(--accent-dark);
            letter-spacing: .05em;
        }

        .verset-card {
            background: var(--bg-card);
            border: 1px solid var(--accent-border);
            border-radius: var(--radius-md);
            padding: 22px 24px;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .2s, border-color .2s;
            position: relative;
        }

        .verset-card:hover {
            box-shadow: var(--shadow-md);
            border-color: color-mix(in srgb, var(--accent), transparent 55%);
        }

        .verset-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .verset-badge {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .78rem;
            font-weight: 700;
            color: var(--accent-dark);
            flex-shrink: 0;
        }

        .verset-actions {
            display: flex;
            gap: 8px;
        }

        .btn-verset {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid var(--accent-border);
            background: transparent;
            color: var(--accent-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: .9rem;
            transition: background .18s, color .18s;
        }

        .btn-verset:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .texte-arabe {
            font-family: 'Amiri', serif;
            font-size: 1.7rem;
            line-height: 2.2;
            color: var(--text-main);
            text-align: right;
            direction: rtl;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--accent-border);
        }

        .texte-fr {
            font-size: .88rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .loading-versets {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .spinner-coran {
            width: 40px;
            height: 40px;
            border: 3px solid var(--accent-light);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin: 0 auto 16px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .btn-menu-sourates {
            display: none;
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            margin-bottom: 16px;
        }

        @media (max-width: 900px) {
            .btn-menu-sourates {
                display: flex;
                align-items: center;
                gap: 8px;
                justify-content: center;
            }
        }

        .liste-sourates::-webkit-scrollbar {
            width: 4px;
        }

        .liste-sourates::-webkit-scrollbar-track {
            background: transparent;
        }

        .liste-sourates::-webkit-scrollbar-thumb {
            background: var(--accent-border);
            border-radius: 4px;
        }

        .audio-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            border-top: 1px solid var(--accent-border);
            padding: 10px 24px;
            display: none;
            align-items: center;
            gap: 16px;
            z-index: 999;
            box-shadow: 0 -4px 20px rgba(113, 197, 93, .12);
        }

        .audio-bar.visible {
            display: flex;
        }

        .audio-bar audio {
            flex: 1;
            height: 36px;
            accent-color: var(--accent);
        }

        .btn-close-audio {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .audio-info {
            font-size: .78rem;
            color: var(--text-muted);
            white-space: nowrap;
        }
    </style>
</head>

<body class="index-page">

    <?php require_once '../view/sections/vitrine/menu.php'; ?>

    <section class="coran-hero" data-aos="fade-down">
        <div class="container">
            <h1><?= htmlspecialchars($t['titre']) ?></h1>
            <p><?= htmlspecialchars($t['sous_titre']) ?></p>
            <div class="hero-bismillah"><?= $t['bismillah'] ?></div>
        </div>
    </section>

    <div class="coran-wrap">

        <button class="btn-menu-sourates" onclick="toggleSidebar()">
            <i class="bi bi-list-ul"></i>
            <?= htmlspecialchars($t['sourates']) ?>
        </button>

        <aside class="sidebar-sourates" id="sidebarSourates">
            <div class="sidebar-header">
                <h6><?= htmlspecialchars($t['sourates']) ?></h6>
                <input
                    type="text"
                    class="search-sourate"
                    id="searchSourate"
                    placeholder="<?= htmlspecialchars($t['recherche']) ?>"
                    oninput="filtrerSourates(this.value)">
            </div>
            <div class="liste-sourates" id="listeSourates">

                <?php if (!empty($listeSourates)): ?>
                    <?php foreach ($listeSourates as $s): ?>
                        <div
                            class="sourate-item <?= (int)$s['number'] === $sourate ? 'active' : '' ?>"
                            data-num="<?= (int)$s['number'] ?>"
                            data-nom="<?= strtolower(htmlspecialchars($s['englishName'] ?? '')) ?>"
                            onclick="chargerSourate(<?= (int)$s['number'] ?>)">
                            <div class="sourate-num"><?= (int)$s['number'] ?></div>
                            <div class="sourate-info">
                                <div class="sourate-nom-fr"><?= htmlspecialchars($s['englishName'] ?? '') ?></div>
                                <div class="sourate-meta-small">
                                    <?= (int)($s['numberOfAyahs'] ?? 0) ?> <?= htmlspecialchars($t['versets']) ?>
                                    · <?= ($s['revelationType'] ?? '') === 'Meccan'
                                            ? htmlspecialchars($t['mecquoise'])
                                            : htmlspecialchars($t['medinoise']) ?>
                                </div>
                            </div>
                            <div class="sourate-nom-ar"><?= htmlspecialchars($s['name'] ?? '') ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="padding:20px;text-align:center;color:var(--text-muted);font-size:.85rem;">
                        <i class="bi bi-wifi-off" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        API indisponible — réessayez plus tard.
                    </div>
                <?php endif; ?>

            </div>
        </aside>

        <main class="zone-lecture" id="zoneLecture">

            <div class="sourate-header-card" id="sourateHeader" data-aos="fade-up">
                <div>
                    <div class="nom-arabe"><?= htmlspecialchars($sourateMeta['name'] ?? '') ?></div>
                    <div class="nom-latin" style="margin-top:4px">
                        <?= htmlspecialchars($sourateMeta['englishName'] ?? '') ?>
                        <span class="badge-type" style="margin-left:8px">
                            <?= ($sourateMeta['revelationType'] ?? '') === 'Meccan'
                                ? htmlspecialchars($t['mecquoise'])
                                : htmlspecialchars($t['medinoise']) ?>
                        </span>
                    </div>
                </div>
                <div class="sourate-stats">
                    <div class="stat-item">
                        <div class="stat-val"><?= (int)($sourateMeta['numberOfAyahs'] ?? 0) ?></div>
                        <div class="stat-lab"><?= htmlspecialchars($t['versets']) ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-val"><?= $sourate ?></div>
                        <div class="stat-lab"><?= htmlspecialchars($t['sourates']) ?></div>
                    </div>
                </div>
            </div>

            <?php if ($sourate !== 9): ?>
                <div class="bismillah-card"><?= $t['bismillah'] ?></div>
            <?php endif; ?>

            <div id="versetsContainer">
                <?php if (!empty($versets)): ?>
                    <?php foreach ($versets as $v): ?>
                        <div class="verset-card" data-verset="<?= (int)$v['number'] ?>">
                            <div class="verset-header">
                                <div class="verset-badge"><?= (int)$v['number'] ?></div>
                                <div class="verset-actions">
                                    <button class="btn-verset" title="Écouter" onclick="jouerAudio(<?= (int)$v['number'] ?>, '<?= htmlspecialchars($v['audio']) ?>')">
                                        <i class="bi bi-volume-up"></i>
                                    </button>
                                    <button class="btn-verset" title="Copier" onclick="copierVerset('<?= htmlspecialchars(addslashes($v['texteAr'])) ?>')">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="texte-arabe"><?= htmlspecialchars($v['texteAr']) ?></div>
                            <?php if (!empty($v['texteFr'])): ?>
                                <div class="texte-fr"><?= htmlspecialchars($v['texteFr']) ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="loading-versets">
                        <div class="spinner-coran"></div>
                        <p>Chargement des versets…</p>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <div class="audio-bar" id="audioBar">
        <span class="audio-info" id="audioInfo">Verset —</span>
        <audio id="audioPlayer" controls></audio>
        <button class="btn-close-audio" onclick="fermerAudio()" title="Fermer">
            <i class="bi bi-x-circle"></i>
        </button>
    </div>

    <?php require_once '../view/sections/vitrine/footer.php'; ?>

    <script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true
        });

        let sourateActive = <?= $sourate ?>;

        function chargerSourate(num) {
            if (num === sourateActive) return;
            sourateActive = num;

            document.querySelectorAll('.sourate-item').forEach(el => {
                el.classList.toggle('active', parseInt(el.dataset.num) === num);
            });

            document.getElementById('versetsContainer').innerHTML = `
    <div class="loading-versets">
      <div class="spinner-coran"></div>
      <p>Chargement…</p>
    </div>`;

            document.getElementById('sidebarSourates').classList.remove('open');

            fetch('?action=coranAjax&sourate=' + num)
                .then(r => r.json())
                .then(data => {
                    if (!data.success) return;

                    const m = data.meta;
                    document.getElementById('sourateHeader').innerHTML = `
        <div>
          <div class="nom-arabe">${m.name || ''}</div>
          <div class="nom-latin" style="margin-top:4px">
            ${m.englishName || ''}
            <span class="badge-type" style="margin-left:8px">
              ${m.revelationType === 'Meccan' ? '<?= htmlspecialchars(addslashes($t['mecquoise'])) ?>' : '<?= htmlspecialchars(addslashes($t['medinoise'])) ?>'}
            </span>
          </div>
        </div>
        <div class="sourate-stats">
          <div class="stat-item">
            <div class="stat-val">${m.numberOfAyahs || 0}</div>
            <div class="stat-lab"><?= htmlspecialchars(addslashes($t['versets'])) ?></div>
          </div>
          <div class="stat-item">
            <div class="stat-val">${num}</div>
            <div class="stat-lab"><?= htmlspecialchars(addslashes($t['sourates'])) ?></div>
          </div>
        </div>`;

                    let html = '';
                    data.versets.forEach(v => {
                        const audioUrl = v.audio || '';
                        const arEsc = v.texteAr.replace(/'/g, "\\'");
                        html += `
          <div class="verset-card" data-verset="${v.number}">
            <div class="verset-header">
              <div class="verset-badge">${v.number}</div>
              <div class="verset-actions">
                <button class="btn-verset" title="Écouter" onclick="jouerAudio(${v.number}, '${audioUrl}')">
                  <i class="bi bi-volume-up"></i>
                </button>
                <button class="btn-verset" title="Copier" onclick="copierVerset('${arEsc}')">
                  <i class="bi bi-clipboard"></i>
                </button>
              </div>
            </div>
            <div class="texte-arabe">${v.texteAr}</div>
            ${v.texteFr ? `<div class="texte-fr">${v.texteFr}</div>` : ''}
          </div>`;
                    });

                    document.getElementById('versetsContainer').innerHTML = html || '<p style="text-align:center;padding:40px;color:var(--text-muted)">Aucun verset trouvé.</p>';
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                })
                .catch(() => {
                    document.getElementById('versetsContainer').innerHTML =
                        '<p style="text-align:center;padding:40px;color:#dc2626">Erreur de chargement — vérifiez votre connexion.</p>';
                });
        }

        function filtrerSourates(q) {
            const q2 = q.toLowerCase().trim();
            document.querySelectorAll('.sourate-item').forEach(el => {
                const nom = el.dataset.nom || '';
                const num = el.dataset.num || '';
                el.style.display = (!q2 || nom.includes(q2) || num.includes(q2)) ? '' : 'none';
            });
        }

        function jouerAudio(num, url) {
            const bar = document.getElementById('audioBar');
            const player = document.getElementById('audioPlayer');
            const info = document.getElementById('audioInfo');
            player.src = url;
            info.textContent = `Verset ${num} — S.${sourateActive}`;
            bar.classList.add('visible');
            player.play();
        }

        function fermerAudio() {
            const player = document.getElementById('audioPlayer');
            player.pause();
            document.getElementById('audioBar').classList.remove('visible');
        }

        function copierVerset(texte) {
            navigator.clipboard.writeText(texte).then(() => {
                const t = document.createElement('div');
                t.textContent = 'Copié ✓';
                Object.assign(t.style, {
                    position: 'fixed',
                    bottom: '70px',
                    right: '24px',
                    background: 'var(--accent)',
                    color: '#fff',
                    padding: '8px 16px',
                    borderRadius: '8px',
                    fontSize: '.83rem',
                    zIndex: '9999',
                    boxShadow: '0 4px 14px rgba(113,197,93,.3)'
                });
                document.body.appendChild(t);
                setTimeout(() => t.remove(), 1800);
            });
        }

        function toggleSidebar() {
            document.getElementById('sidebarSourates').classList.toggle('open');
        }
    </script>
</body>

</html>