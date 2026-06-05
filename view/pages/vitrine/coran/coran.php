<!DOCTYPE html>
<html lang="fr" dir="<?= htmlspecialchars($t['dir']) ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($t['titre']) ?> &mdash; YonnWi</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

    <style>
        :root {
            --accent: #71c55d;
            --accent-dark: #5fb04d;
            --accent-light: #eaf7e6;
            --accent-border: rgba(113, 197, 93, .28);
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

        /* ── HERO ── */
        .coran-hero {
            background: linear-gradient(135deg, #dff5d8 0%, #edfae8 100%);
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

        /* ── LAYOUT PRINCIPAL ── */
        .coran-wrap {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 24px;
            max-width: 1200px;
            margin: 32px auto;
            padding: 0 20px 80px;
        }

        @media (max-width: 900px) {
            .coran-wrap {
                grid-template-columns: 1fr;
            }
        }

        /* ── SIDEBAR ── */
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

        @media (max-width: 900px) {
            .sidebar-sourates {
                display: none;
                position: static;
                max-height: 400px;
            }

            .sidebar-sourates.open {
                display: flex;
            }
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
            font-family: 'Poppins', sans-serif;
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

        .liste-sourates::-webkit-scrollbar {
            width: 4px;
        }

        .liste-sourates::-webkit-scrollbar-thumb {
            background: var(--accent-border);
            border-radius: 4px;
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

        .sourate-meta-sm {
            font-size: .72rem;
            color: var(--text-muted);
        }

        .sourate-nom-ar {
            font-family: 'Amiri', serif;
            font-size: 1rem;
            color: var(--accent-dark);
            flex-shrink: 0;
        }

        /* ── ZONE LECTURE ── */
        .zone-lecture {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Bouton mobile */
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
            font-family: 'Poppins', sans-serif;
            align-items: center;
            gap: 8px;
            justify-content: center;
            margin-bottom: 16px;
        }

        @media (max-width: 900px) {
            .btn-menu-sourates {
                display: flex;
            }
        }

        /* Header sourate */
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
            flex-wrap: wrap;
        }

        .nom-arabe {
            font-family: 'Amiri', serif;
            font-size: 2.2rem;
            color: var(--accent-dark);
            line-height: 1;
        }

        .nom-latin {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
            margin-top: 4px;
        }

        .badge-type {
            font-size: .72rem;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid var(--accent-border);
            color: var(--accent-dark);
            background: var(--accent-light);
            font-weight: 500;
            margin-left: 8px;
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

        /* Bismillah */
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

        /* Verset */
        .verset-card {
            background: var(--bg-card);
            border: 1px solid var(--accent-border);
            border-radius: var(--radius-md);
            padding: 22px 24px;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .2s, border-color .2s;
        }

        .verset-card:hover {
            box-shadow: var(--shadow-md);
            border-color: rgba(113, 197, 93, .45);
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

        /* Spinner */
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
            animation: spn .7s linear infinite;
            margin: 0 auto 16px;
        }

        @keyframes spn {
            to {
                transform: rotate(360deg);
            }
        }

        /* Barre audio fixe */
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

    <?php require_once 'view/sections/vitrine/menu.php'; ?>

    <!-- HERO -->
    <section class="coran-hero" data-aos="fade-down">
        <div class="container">
            <h1><?= htmlspecialchars($t['titre']) ?></h1>
            <p><?= htmlspecialchars($t['sous_titre']) ?></p>
            <div class="hero-bismillah"><?= htmlspecialchars($t['bismillah']) ?></div>
        </div>
    </section>

    <!-- LAYOUT PRINCIPAL -->
    <div class="coran-wrap">

        <!-- Bouton menu mobile -->
        <button class="btn-menu-sourates" onclick="toggleSidebar()">
            <i class="bi bi-list-ul"></i>
            <?= htmlspecialchars($t['sourates']) ?>
        </button>

        <!-- SIDEBAR SOURATES -->
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
                    <?php foreach ($listeSourates as $s):
                        $num    = (int)($s['number'] ?? 0);
                        $nomFr  = htmlspecialchars($s['englishName'] ?? '');
                        $nomAr  = htmlspecialchars($s['name'] ?? '');
                        $nbAy   = (int)($s['numberOfAyahs'] ?? 0);
                        $type   = ($s['revelationType'] ?? '') === 'Meccan'
                            ? htmlspecialchars($t['mecquoise'])
                            : htmlspecialchars($t['medinoise']);
                        $active = ($num === $sourate) ? 'active' : '';
                        $nomLow = strtolower($s['englishName'] ?? '');
                    ?>
                        <div
                            class="sourate-item <?= $active ?>"
                            data-num="<?= $num ?>"
                            data-nom="<?= htmlspecialchars($nomLow) ?>"
                            onclick="chargerSourate(<?= $num ?>)">
                            <div class="sourate-num"><?= $num ?></div>
                            <div class="sourate-info">
                                <div class="sourate-nom-fr"><?= $nomFr ?></div>
                                <div class="sourate-meta-sm"><?= $nbAy ?> <?= htmlspecialchars($t['versets']) ?> &middot; <?= $type ?></div>
                            </div>
                            <div class="sourate-nom-ar"><?= $nomAr ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="padding:20px;text-align:center;color:var(--text-muted);font-size:.85rem;">
                        <i class="bi bi-wifi-off" style="font-size:2rem;display:block;margin-bottom:8px"></i>
                        API indisponible &mdash; r&eacute;essayez plus tard.
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        <!-- ZONE DE LECTURE -->
        <main class="zone-lecture" id="zoneLecture">

            <!-- Header sourate active -->
            <div class="sourate-header-card" id="sourateHeader" data-aos="fade-up">
                <div>
                    <div class="nom-arabe"><?= htmlspecialchars($sourateMeta['name'] ?? '') ?></div>
                    <div class="nom-latin">
                        <?= htmlspecialchars($sourateMeta['englishName'] ?? '') ?>
                        <span class="badge-type">
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

            <!-- Bismillah (sauf At-Tawbah = sourate 9) -->
            <?php if ($sourate !== 9): ?>
                <div class="bismillah-card"><?= htmlspecialchars($t['bismillah']) ?></div>
            <?php endif; ?>

            <!-- Versets -->
            <div id="versetsContainer">
                <?php if (!empty($versets)): ?>
                    <?php foreach ($versets as $v):
                        $vNum   = (int)($v['number'] ?? 0);
                        $texteAr = $v['texteAr'] ?? '';
                        $texteFr = $v['texteFr'] ?? '';
                        $audioUrl = $v['audio'] ?? '';
                    ?>
                        <div class="verset-card" data-verset="<?= $vNum ?>">
                            <div class="verset-header">
                                <div class="verset-badge"><?= $vNum ?></div>
                                <div class="verset-actions">
                                    <button class="btn-verset" title="Ecouter"
                                        data-audio="<?= htmlspecialchars($audioUrl) ?>"
                                        onclick="jouerAudio(<?= $vNum ?>, this.dataset.audio)">
                                        <i class="bi bi-volume-up"></i>
                                    </button>
                                    <button class="btn-verset" title="Copier"
                                        onclick="copierVerset(this)">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="texte-arabe"><?= htmlspecialchars($texteAr) ?></div>
                            <?php if ($texteFr !== ''): ?>
                                <div class="texte-fr"><?= htmlspecialchars($texteFr) ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="loading-versets">
                        <div class="spinner-coran"></div>
                        <p>Chargement des versets&hellip;</p>
                    </div>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <!-- BARRE AUDIO FIXE -->
    <div class="audio-bar" id="audioBar">
        <span class="audio-info" id="audioInfo"></span>
        <audio id="audioPlayer" controls></audio>
        <button class="btn-close-audio" onclick="fermerAudio()" title="Fermer">
            <i class="bi bi-x-circle"></i>
        </button>
    </div>

    <?php require_once 'view/sections/vitrine/footer.php'; ?>

    <script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true
        });

        // Numéro de sourate courante (initialisé depuis PHP)
        var sourateActive = <?= (int)$sourate ?>;

        // Textes traduits passés depuis PHP (évite les quotes imbriquées)
        var LANG = {
            mecquoise: <?= json_encode($t['mecquoise']) ?>,
            medinoise: <?= json_encode($t['medinoise']) ?>,
            versets: <?= json_encode($t['versets'])   ?>,
            sourates: <?= json_encode($t['sourates'])  ?>
        };

        /* ──────────────────────────────────────────────────────────────
           CHARGER UNE SOURATE VIA AJAX
        ────────────────────────────────────────────────────────────── */
        function chargerSourate(num) {
            if (num === sourateActive) return;
            sourateActive = num;

            // Activer l'élément dans la sidebar
            document.querySelectorAll('.sourate-item').forEach(function(el) {
                el.classList.toggle('active', parseInt(el.dataset.num) === num);
            });

            // Spinner
            document.getElementById('versetsContainer').innerHTML =
                '<div class="loading-versets"><div class="spinner-coran"></div><p>Chargement&hellip;</p></div>';

            // Fermer sidebar mobile
            document.getElementById('sidebarSourates').classList.remove('open');

            // Appel AJAX
            fetch('?action=coranAjax&sourate=' + num)
                .then(function(r) {
                    return r.json();
                })
                .then(function(data) {
                    if (!data.success) {
                        document.getElementById('versetsContainer').innerHTML =
                            '<p style="text-align:center;padding:40px;color:#dc2626">Erreur serveur.</p>';
                        return;
                    }

                    // Mettre à jour l'en-tête sourate
                    var m = data.meta || {};
                    var typeLabel = (m.revelationType === 'Meccan') ? LANG.mecquoise : LANG.medinoise;
                    document.getElementById('sourateHeader').innerHTML =
                        '<div>' +
                        '<div class="nom-arabe">' + (m.name || '') + '</div>' +
                        '<div class="nom-latin">' + (m.englishName || '') +
                        '<span class="badge-type">' + typeLabel + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="sourate-stats">' +
                        '<div class="stat-item">' +
                        '<div class="stat-val">' + (m.numberOfAyahs || 0) + '</div>' +
                        '<div class="stat-lab">' + LANG.versets + '</div>' +
                        '</div>' +
                        '<div class="stat-item">' +
                        '<div class="stat-val">' + num + '</div>' +
                        '<div class="stat-lab">' + LANG.sourates + '</div>' +
                        '</div>' +
                        '</div>';

                    // Rendu des versets
                    var html = '';
                    (data.versets || []).forEach(function(v) {
                        var audioUrl = (v.audio || '').replace(/'/g, '%27');
                        html +=
                            '<div class="verset-card" data-verset="' + v.number + '">' +
                            '<div class="verset-header">' +
                            '<div class="verset-badge">' + v.number + '</div>' +
                            '<div class="verset-actions">' +
                            '<button class="btn-verset" title="Ecouter" ' +
                            'onclick="jouerAudio(' + v.number + ', \'' + audioUrl + '\')">' +
                            '<i class="bi bi-volume-up"></i></button>' +
                            '<button class="btn-verset" title="Copier" onclick="copierVerset(this)">' +
                            '<i class="bi bi-clipboard"></i></button>' +
                            '</div>' +
                            '</div>' +
                            '<div class="texte-arabe">' + escHtml(v.texteAr || '') + '</div>' +
                            (v.texteFr ? '<div class="texte-fr">' + escHtml(v.texteFr) + '</div>' : '') +
                            '</div>';
                    });

                    document.getElementById('versetsContainer').innerHTML =
                        html || '<p style="text-align:center;padding:40px;color:var(--text-muted)">Aucun verset trouv&eacute;.</p>';

                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                })
                .catch(function() {
                    document.getElementById('versetsContainer').innerHTML =
                        '<p style="text-align:center;padding:40px;color:#dc2626">Erreur de chargement &mdash; v&eacute;rifiez votre connexion.</p>';
                });
        }

        /* ──────────────────────────────────────────────────────────────
           FILTRER LA LISTE DES SOURATES
        ────────────────────────────────────────────────────────────── */
        function filtrerSourates(q) {
            var q2 = q.toLowerCase().trim();
            document.querySelectorAll('.sourate-item').forEach(function(el) {
                var nom = el.dataset.nom || '';
                var num = el.dataset.num || '';
                el.style.display = (!q2 || nom.includes(q2) || num.includes(q2)) ? '' : 'none';
            });
        }

        /* ──────────────────────────────────────────────────────────────
           LECTEUR AUDIO
        ────────────────────────────────────────────────────────────── */
        function jouerAudio(num, url) {
            var bar = document.getElementById('audioBar');
            var player = document.getElementById('audioPlayer');
            var info = document.getElementById('audioInfo');
            player.pause();
            player.src = url;
            info.textContent = 'Verset ' + num + ' \u2014 S.' + sourateActive;
            bar.classList.add('visible');
            player.play().catch(function() {});
        }

        function fermerAudio() {
            document.getElementById('audioPlayer').pause();
            document.getElementById('audioBar').classList.remove('visible');
        }

        /* ──────────────────────────────────────────────────────────────
           COPIER UN VERSET (lit le texte depuis le DOM)
        ────────────────────────────────────────────────────────────── */
        function copierVerset(btn) {
            var card = btn.closest('.verset-card');
            var texte = card ? (card.querySelector('.texte-arabe') || {}).textContent || '' : '';
            if (!texte) return;
            navigator.clipboard.writeText(texte.trim()).then(function() {
                var toast = document.createElement('div');
                toast.textContent = 'Copi\u00e9 \u2713';
                Object.assign(toast.style, {
                    position: 'fixed',
                    bottom: '70px',
                    right: '24px',
                    background: 'var(--accent)',
                    color: '#fff',
                    padding: '8px 16px',
                    borderRadius: '8px',
                    fontSize: '.83rem',
                    zIndex: '9999',
                    boxShadow: '0 4px 14px rgba(113,197,93,.3)',
                    fontFamily: 'Poppins,sans-serif'
                });
                document.body.appendChild(toast);
                setTimeout(function() {
                    toast.remove();
                }, 1800);
            });
        }

        /* ──────────────────────────────────────────────────────────────
           SIDEBAR MOBILE
        ────────────────────────────────────────────────────────────── */
        function toggleSidebar() {
            document.getElementById('sidebarSourates').classList.toggle('open');
        }

        /* ──────────────────────────────────────────────────────────────
           UTILITAIRE — échapper le HTML
        ────────────────────────────────────────────────────────────── */
        function escHtml(str) {
            var d = document.createElement('div');
            d.appendChild(document.createTextNode(str));
            return d.innerHTML;
        }
    </script>
</body>

</html>