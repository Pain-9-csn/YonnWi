<?php
// ============================================================
// SESSION EN TOUT PREMIER — avant tout output HTML
// ============================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables injectées par CoranController::index()
$sourateNum    = $sourateNum    ?? 1;
$listeSourates = $listeSourates ?? [];
$sourateActive = $sourateActive ?? [];
$versets       = $versets       ?? [];
$userId        = $userId        ?? null;
$progression   = $progression   ?? null;
$lang          = $lang          ?? 'fr';

// Chemin racine depuis view/pages/vitrine/coran/
$root = '../../../../';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Coran — YoonWi</title>
    <?php require_once("../../../sections/vitrine/header.php"); ?>
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&family=Amiri:wght@400;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="<?= $root ?>public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $root ?>public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $root ?>public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

    <style>
        :root {
            --em: #1a6b50;
            --eml: #25957a;
            --gd: #c9a84c;
            --gdl: #e8c97a;
            --bg: #07100e;
            --c1: #0d1f1a;
            --c2: #122b24;
            --txt: #d8ede8;
            --mt: #6a9a8a;
            --br: rgba(26, 107, 80, .3);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body{

        background:
        #07100e;

        min-height:100vh;
        color:white;

        }

        /* ---------- page shell ---------- */
        .yw-shell {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 70px;
        }

        .yw-main {
            flex: 1;
        }

        /* ---------- hero ---------- */
        .hero {
            text-align: center;
            padding: 2.5rem 1rem 2rem;
            background: linear-gradient(180deg, #0b1f18 0%, var(--bg) 100%);
            border-bottom: 1px solid var(--br);
        }

        .hero .bsm {
            font-family: 'Scheherazade New', serif;
            font-size: 1.9rem;
            color: var(--gdl);
            display: block;
            direction: rtl;
            margin-bottom: .3rem;
        }

        .hero h1 {
            font-size: 2rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--eml), #8de8c8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .25rem;
        }

        .hero p {
            font-size: .85rem;
            color: var(--mt);
        }

        /* ---------- layout ---------- */
        .coran-wrap {
            max-width: 1140px;
            margin: 0 auto;
            padding: 1.5rem 1rem 3rem;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 1.25rem;
            align-items: start;
        }

        @media (max-width: 800px) {
            .coran-wrap {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static !important;
                max-height: 300px !important;
            }
        }

        /* ---------- sidebar ---------- */
        .sidebar {
            background: var(--c1);
            border: 1px solid var(--br);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 80px;
            max-height: calc(100vh - 90px);
        }

        .sb-search {
            padding: .75rem;
            border-bottom: 1px solid var(--br);
        }

        .sb-search input {
            width: 100%;
            background: var(--c2);
            border: 1px solid var(--br);
            color: var(--txt);
            border-radius: 10px;
            padding: .5rem .85rem;
            font-family: 'Outfit', sans-serif;
            font-size: .82rem;
            outline: none;
            transition: border-color .2s;
        }

        .sb-search input:focus {
            border-color: var(--eml);
        }

        .sb-search input::placeholder {
            color: var(--mt);
        }

        .sb-list {
            overflow-y: auto;
            flex: 1;
        }

        .sb-list::-webkit-scrollbar {
            width: 4px;
        }

        .sb-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .sb-list::-webkit-scrollbar-thumb {
            background: var(--br);
            border-radius: 4px;
        }

        .sb-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
            gap: .75rem;
            color: var(--mt);
            font-size: .82rem;
        }

        .s-item {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .6rem .9rem;
            cursor: pointer;
            border-bottom: 1px solid rgba(26, 107, 80, .08);
            transition: background .15s;
        }

        .s-item:hover {
            background: var(--c2);
        }

        .s-item.active {
            background: rgba(26, 107, 80, .2);
            border-left: 3px solid var(--eml);
        }

        .s-num {
            width: 28px;
            height: 28px;
            flex-shrink: 0;
            border-radius: 7px;
            background: var(--c2);
            border: 1px solid var(--br);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .68rem;
            font-weight: 700;
            color: var(--eml);
        }

        .s-item.active .s-num {
            background: var(--em);
            border-color: var(--eml);
            color: #fff;
        }

        .s-name-ar {
            font-family: 'Amiri', serif;
            font-size: .95rem;
            color: var(--gdl);
            direction: rtl;
        }

        .s-name-en {
            font-size: .7rem;
            color: var(--mt);
        }

        .s-ayahs {
            font-size: .68rem;
            color: var(--mt);
            margin-left: auto;
            flex-shrink: 0;
        }

        /* ---------- reader ---------- */
        .reader {
            background: var(--c1);
            border: 1px solid var(--br);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-height: 500px;
        }

        .r-head {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--br);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .75rem;
        }

        .r-head-name-ar {
            font-family: 'Scheherazade New', serif;
            font-size: 1.5rem;
            color: var(--gdl);
            direction: rtl;
        }

        .r-head-sub {
            font-size: .75rem;
            color: var(--mt);
            margin-top: .1rem;
        }

        .r-controls {
            display: flex;
            gap: .4rem;
        }

        .ctrl {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            border: 1px solid var(--br);
            background: var(--c2);
            color: var(--txt);
            cursor: pointer;
            font-size: .85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .2s;
        }

        .ctrl:hover {
            background: var(--em);
            border-color: var(--eml);
        }

        .ctrl.on {
            background: var(--em);
            border-color: var(--eml);
            color: #fff;
        }

        .r-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem;
        }

        .r-body::-webkit-scrollbar {
            width: 4px;
        }

        .r-body::-webkit-scrollbar-thumb {
            background: var(--br);
            border-radius: 4px;
        }

        .r-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 4rem 1rem;
            color: var(--mt);
            gap: 1rem;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .spin-ring {
            width: 32px;
            height: 32px;
            border: 3px solid var(--br);
            border-top-color: var(--eml);
            border-radius: 50%;
            animation: spin .8s linear infinite;
        }

        .verset {
            background: var(--c2);
            border: 1px solid var(--br);
            border-radius: 12px;
            margin-bottom: .9rem;
            overflow: hidden;
            transition: border-color .2s;
        }

        .verset:hover {
            border-color: rgba(26, 107, 80, .55);
        }

        .verset.playing {
            border-color: var(--eml);
            box-shadow: 0 0 14px rgba(26, 107, 80, .2);
        }

        .verset-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: .45rem .9rem;
            border-bottom: 1px solid rgba(26, 107, 80, .08);
        }

        .v-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--em);
            color: #fff;
            font-size: .68rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .v-play {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--mt);
            font-size: .95rem;
            padding: .2rem .45rem;
            border-radius: 6px;
            transition: all .2s;
        }

        .v-play:hover {
            color: var(--eml);
            background: rgba(26, 107, 80, .12);
        }

        .verset-ar {
            font-family: 'Scheherazade New', serif;
            font-size: 1.55rem;
            line-height: 2.1;
            text-align: right;
            direction: rtl;
            color: var(--txt);
            padding: .9rem 1rem .5rem;
        }

        .verset-fr {
            font-size: .82rem;
            color: var(--mt);
            line-height: 1.65;
            padding: .3rem 1rem .9rem;
            border-top: 1px solid rgba(26, 107, 80, .07);
        }

        .hide-trad .verset-fr {
            display: none;
        }

        .r-progress {
            padding: .6rem 1.25rem;
            background: rgba(201, 168, 76, .06);
            border-top: 1px solid var(--br);
            font-size: .76rem;
            color: var(--mt);
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .r-progress i {
            color: var(--gd);
        }
    </style>
</head>

<body>
    <div class="yw-shell">


        <?php require_once("../../../sections/vitrine/menu.php"); ?>

        <main class="yw-main">

            <section class="hero">
                <span class="bsm">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</span>
                <h1>القرآن الكريم</h1>
                <p>Lecture du Saint Coran avec traduction française</p>
            </section>

            <div class="coran-wrap">

                <aside class="sidebar">
                    <div class="sb-search">
                        <input type="text" id="sbSearch" placeholder="Rechercher une sourate…" oninput="filtrerSourates(this.value)">
                    </div>
                    <div class="sb-list" id="sbList">
                        <?php if (!empty($listeSourates)): ?>
                            <?php foreach ($listeSourates as $s):
                                $num      = (int)($s['number'] ?? 0);
                                $nameAr   = htmlspecialchars($s['name'] ?? '');
                                $nameEn   = htmlspecialchars($s['englishName'] ?? '');
                                $ayahs    = (int)($s['numberOfAyahs'] ?? 0);
                                $isActive = ($num === $sourateNum) ? 'active' : '';
                                $dataSearch = strtolower($nameEn . ' ' . ($s['name'] ?? '') . ' ' . $num);
                            ?>
                                <div class="s-item <?= $isActive ?>"
                                    data-num="<?= $num ?>"
                                    data-search="<?= htmlspecialchars($dataSearch) ?>"
                                    onclick="chargerSourate(<?= $num ?>, this)">
                                    <div class="s-num"><?= $num ?></div>
                                    <div>
                                        <div class="s-name-ar"><?= $nameAr ?></div>
                                        <div class="s-name-en"><?= $nameEn ?></div>
                                    </div>
                                    <div class="s-ayahs"><?= $ayahs ?>v</div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="sb-loading" id="sbLoadingSpinner">
                                <div class="spin-ring"></div>
                                <span>Chargement des sourates…</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </aside>

                <section class="reader" id="reader">
                    <div class="r-head">
                        <div>
                            <div class="r-head-name-ar" id="rNameAr"><?= htmlspecialchars($sourateActive['name'] ?? 'الفاتحة') ?></div>
                            <div class="r-head-sub" id="rNameEn">
                                <?= htmlspecialchars($sourateActive['englishName'] ?? 'Al-Fatiha') ?>
                                &nbsp;·&nbsp;<?= (int)($sourateActive['numberOfAyahs'] ?? 0) ?> versets
                                &nbsp;·&nbsp;<?= htmlspecialchars($sourateActive['revelationType'] ?? '') ?>
                            </div>
                        </div>
                        <div class="r-controls">
                            <button class="ctrl on" id="btnTrad" onclick="toggleTrad()" title="Traduction">fr</button>
                            <button class="ctrl" id="btnAuto" onclick="toggleAuto()" title="Lecture auto"><i class="bi bi-skip-end"></i></button>
                            <button class="ctrl" onclick="scrollTop()" title="Haut"><i class="bi bi-arrow-up"></i></button>
                        </div>
                    </div>

                    <div class="r-body" id="rBody">
                        <?php if (empty($versets)): ?>
                            <div class="r-loading" id="rInitLoader">
                                <div class="spin-ring"></div>
                                Chargement des versets…
                            </div>
                        <?php else: ?>
                            <?php foreach ($versets as $v):
                                $vNum  = (int)($v['number'] ?? 0);
                                $texAr = $v['texteAr'] ?? '';
                                $texFr = $v['texteFr'] ?? '';
                                $audio = htmlspecialchars($v['audio'] ?? '');
                            ?>
                                <div class="verset" id="v<?= $vNum ?>" data-num="<?= $vNum ?>" data-audio="<?= $audio ?>">
                                    <div class="verset-top">
                                        <div class="v-num"><?= $vNum ?></div>
                                        <?php if ($audio): ?>
                                            <button class="v-play" onclick="jouer(<?= $vNum ?>)" id="btn<?= $vNum ?>"><i class="bi bi-play-circle"></i></button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="verset-ar"><?= htmlspecialchars($texAr) ?></div>
                                    <?php if ($texFr): ?>
                                        <div class="verset-fr"><?= htmlspecialchars($texFr) ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="r-progress" id="rProgress" style="display:none">
                        <i class="bi bi-bookmark-check-fill"></i>
                        <span id="rProgressTxt"></span>
                    </div>
                </section>

            </div>
        </main>

        <?php
        $footerPath = __DIR__ . '/../../../../view/sections/vitrine/footer.php';
        if (file_exists($footerPath)) require_once $footerPath;
        ?>

    </div>

    <audio id="player" preload="none"></audio>

    <script>
        const ROOT = '<?= $root ?>';
        const AJAX_URL = ROOT + 'index.php';
        const API_SURAH_LIST = 'https://api.alquran.cloud/v1/surah';
        const API_SURAH_AR = 'https://api.alquran.cloud/v1/surah/{n}/ar.alafasy';
        const API_SURAH_FR = 'https://api.alquran.cloud/v1/surah/{n}/fr.hamidullah';

        let curSura = <?= $sourateNum ?>;
        let showTrad = true;
        let autoPlay = false;
        let playingNum = -1;
        const player = document.getElementById('player');

        <?php if ($progression): ?>
            const savedSura = <?= (int)$progression['sourate_num'] ?>;
            const savedVers = <?= (int)$progression['verset_num'] ?>;
        <?php else: ?>
            const savedSura = <?= $sourateNum ?>;
            const savedVers = 1;
        <?php endif; ?>

        document.addEventListener('DOMContentLoaded', () => {
            const activeItem = document.querySelector('.s-item.active');
            if (activeItem) activeItem.scrollIntoView({
                block: 'center'
            });

            const spinner = document.getElementById('sbLoadingSpinner');
            if (spinner) chargerListeSourates();

            const initLoader = document.getElementById('rInitLoader');
            if (initLoader) {
                chargerSourate(curSura, null);
            } else if (savedVers > 1) {
                setTimeout(() => {
                    const el = document.getElementById('v' + savedVers);
                    if (el) el.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }, 400);
            }
        });

        async function chargerListeSourates() {
            try {
                const res = await fetch(API_SURAH_LIST);
                const json = await res.json();
                if (json.code !== 200 || !json.data) throw new Error('API indisponible');
                const list = json.data;
                const sbList = document.getElementById('sbList');
                let html = '';
                list.forEach(s => {
                    const num = s.number;
                    const isActive = (num === curSura) ? 'active' : '';
                    const dataSearch = (s.englishName + ' ' + s.name + ' ' + num).toLowerCase();
                    html += `
        <div class="s-item ${isActive}" data-num="${num}" data-search="${escAttr(dataSearch)}" onclick="chargerSourate(${num}, this)">
          <div class="s-num">${num}</div>
          <div>
            <div class="s-name-ar">${escHtml(s.name)}</div>
            <div class="s-name-en">${escHtml(s.englishName)}</div>
          </div>
          <div class="s-ayahs">${s.numberOfAyahs}v</div>
        </div>`;
                });
                sbList.innerHTML = html;
                const active = sbList.querySelector('.s-item.active');
                if (active) active.scrollIntoView({
                    block: 'center'
                });
            } catch (err) {
                document.getElementById('sbList').innerHTML =
                    `<p style="padding:1.5rem;text-align:center;color:var(--mt);font-size:.82rem;">Impossible de charger la liste (${err.message})</p>`;
            }
        }

        function chargerSourate(num, el) {
            if (num === curSura && el?.classList.contains('active') && !document.getElementById('rInitLoader')) return;
            curSura = num;
            document.querySelectorAll('.s-item').forEach(i => i.classList.remove('active'));
            if (el) {
                el.classList.add('active');
                el.scrollIntoView({
                    block: 'nearest'
                });
            }
            if (playingNum >= 0) {
                player.pause();
                resetBtnIcon(playingNum);
                playingNum = -1;
            }
            const rBody = document.getElementById('rBody');
            rBody.innerHTML = '<div class="r-loading"><div class="spin-ring"></div>Chargement…</div>';
            document.getElementById('rNameAr').textContent = '…';
            document.getElementById('rNameEn').textContent = '…';

            fetch(`${AJAX_URL}?action=ajax_versets&sourate=${num}`)
                .then(r => {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                })
                .then(data => {
                    if (!data.success) throw new Error('Backend error');
                    afficherVersets(data.versets || [], data.meta || {});
                })
                .catch(() => chargerDepuisAPI(num));
        }

        async function chargerDepuisAPI(num) {
            const rBody = document.getElementById('rBody');
            try {
                const [resAr, resFr] = await Promise.all([
                    fetch(API_SURAH_AR.replace('{n}', num)),
                    fetch(API_SURAH_FR.replace('{n}', num))
                ]);
                const [jsonAr, jsonFr] = await Promise.all([resAr.json(), resFr.json()]);
                if (jsonAr.code !== 200) throw new Error('API arabe indisponible');
                const surah = jsonAr.data;
                const ayahsAr = surah.ayahs || [];
                const ayahsFr = (jsonFr.code === 200 && jsonFr.data?.ayahs) ? jsonFr.data.ayahs : [];
                const meta = {
                    nameAr: surah.name,
                    nameEn: surah.englishName + ' · ' + surah.numberOfAyahs + ' versets · ' + surah.revelationType
                };
                const versets = ayahsAr.map((a, i) => ({
                    number: a.numberInSurah,
                    texteAr: a.text,
                    texteFr: ayahsFr[i]?.text || '',
                    audio: a.audio || ''
                }));
                document.getElementById('rNameAr').textContent = meta.nameAr;
                document.getElementById('rNameEn').textContent = meta.nameEn;
                afficherVersets(versets, meta);
            } catch (err) {
                rBody.innerHTML = `<div class="r-loading" style="color:#e74c3c;"><i class="bi bi-exclamation-triangle" style="font-size:1.5rem"></i>Erreur (${err.message})</div>`;
            }
        }

        function afficherVersets(versets, meta) {
            document.getElementById('rNameAr').textContent = meta.nameAr || '';
            document.getElementById('rNameEn').textContent = (meta.nameEn || '') + (meta.ayahs ? ' · ' + meta.ayahs + ' versets' : '');
            if (!versets.length) {
                document.getElementById('rBody').innerHTML = '<div class="r-loading">Aucun verset disponible.</div>';
                return;
            }
            const tradClass = showTrad ? '' : 'hide-trad';
            let html = '';
            versets.forEach(v => {
                const num = parseInt(v.number) || 0;
                const texAr = escHtml(v.texteAr || '');
                const texFr = escHtml(v.texteFr || '');
                const audio = escAttr(v.audio || '');
                const playBtn = audio ? `<button class="v-play" onclick="jouer(${num})" id="btn${num}"><i class="bi bi-play-circle"></i></button>` : '';
                const frDiv = texFr ? `<div class="verset-fr">${texFr}</div>` : '';
                html += `<div class="verset ${tradClass}" id="v${num}" data-num="${num}" data-audio="${audio}">
      <div class="verset-top"><div class="v-num">${num}</div>${playBtn}</div>
      <div class="verset-ar">${texAr}</div>${frDiv}</div>`;
            });
            document.getElementById('rBody').innerHTML = html;
            document.getElementById('rBody').scrollTop = 0;
        }

        function jouer(num) {
            const el = document.getElementById('v' + num);
            const url = el ? el.dataset.audio : '';
            if (!url) return;
            if (playingNum === num) {
                player.paused ? player.play() : player.pause();
                updateBtnIcon(num, player.paused ? 'bi-play-circle' : 'bi-pause-circle');
                return;
            }
            if (playingNum >= 0) resetBtnIcon(playingNum);
            document.querySelectorAll('.verset').forEach(v => v.classList.remove('playing'));
            playingNum = num;
            player.src = url;
            player.play().catch(() => {});
            updateBtnIcon(num, 'bi-pause-circle');
            el.classList.add('playing');
            sauvegarderProgression(curSura, num);
            player.onended = () => {
                resetBtnIcon(num);
                el.classList.remove('playing');
                playingNum = -1;
                if (autoPlay) {
                    const next = document.getElementById('v' + (num + 1));
                    if (next) jouer(num + 1);
                }
            };
        }

        function updateBtnIcon(num, icon) {
            const btn = document.getElementById('btn' + num);
            if (btn) btn.querySelector('i').className = 'bi ' + icon;
        }

        function resetBtnIcon(num) {
            updateBtnIcon(num, 'bi-play-circle');
        }

        function toggleTrad() {
            showTrad = !showTrad;
            document.getElementById('btnTrad').classList.toggle('on', showTrad);
            document.querySelectorAll('.verset').forEach(v => v.classList.toggle('hide-trad', !showTrad));
        }

        function toggleAuto() {
            autoPlay = !autoPlay;
            document.getElementById('btnAuto').classList.toggle('on', autoPlay);
        }

        function scrollTop() {
            document.getElementById('rBody').scrollTop = 0;
        }

        function sauvegarderProgression(sura, verset) {
            <?php if ($userId): ?>
                fetch(`${AJAX_URL}?action=ajax_progression_coran`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `sourate=${sura}&verset=${verset}`
                }).catch(() => {});
                const bar = document.getElementById('rProgress');
                document.getElementById('rProgressTxt').textContent = `Progression : Sourate ${sura}, verset ${verset}`;
                bar.style.display = 'flex';
                clearTimeout(bar._t);
                bar._t = setTimeout(() => bar.style.display = 'none', 3000);
            <?php endif; ?>
        }

        function filtrerSourates(q) {
            const term = q.toLowerCase().trim();
            document.querySelectorAll('#sbList .s-item').forEach(el => {
                el.style.display = (!term || (el.dataset.search || '').includes(term)) ? '' : 'none';
            });
        }

        function escHtml(s) {
            return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function escAttr(s) {
            return String(s).replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        }
    </script>
</body>

</html>