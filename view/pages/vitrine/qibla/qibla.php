<?php
// ============================================================
// SESSION EN TOUT PREMIER — avant tout output HTML
// ============================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables injectées par QiblaController::index()
$textes   = $textes   ?? [];
$meccaLat = $meccaLat ?? 21.4225;
$meccaLng = $meccaLng ?? 39.8262;
$userId   = $userId   ?? null;
$lang     = $lang     ?? 'fr';
$dir      = $textes['dir'] ?? 'ltr';

// Chemin racine depuis view/pages/vitrine/qibla/
$root = '../../../../';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($textes['titre'] ?? 'Qibla') ?> — YoonWi</title>
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

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--txt);
            min-height: 100vh;
        }

        .yw-shell {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 70px;
        }

        .yw-main {
            flex: 1;
        }

        .hero {
            padding: 2.5rem 1rem 2rem;
            text-align: center;
            background: linear-gradient(180deg, #0b1f18 0%, var(--bg) 100%);
            border-bottom: 1px solid var(--br);
        }

        .hero .bsm {
            font-family: 'Amiri', serif;
            font-size: 1.3rem;
            color: var(--gdl);
            direction: rtl;
            display: block;
            margin-bottom: .2rem;
        }

        .hero .bsm-ref {
            font-size: .75rem;
            color: var(--mt);
            margin-bottom: 1.2rem;
            display: block;
        }

        .hero h1 {
            font-size: 2rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--eml), #8de8c8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .3rem;
        }

        .hero p {
            font-size: .85rem;
            color: var(--mt);
        }

        .q-wrap {
            max-width: 760px;
            margin: 0 auto;
            padding: 2.5rem 1rem 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            align-items: center;
        }

        @media (max-width: 640px) {
            .q-wrap {
                grid-template-columns: 1fr;
            }
        }

        .compass-card {
            background: var(--c1);
            border: 1px solid var(--br);
            border-radius: 18px;
            padding: 1.75rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.4rem;
        }

        .compass-outer {
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #0d1f1a 0%, #1a3326 50%, #0d1f1a 100%);
            border: 2px solid var(--br);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 32px rgba(26, 107, 80, .07), inset 0 0 20px rgba(0, 0, 0, .4);
            transition: box-shadow .4s;
        }

        .compass-outer.active {
            box-shadow: 0 0 40px rgba(26, 107, 80, .2), inset 0 0 20px rgba(0, 0, 0, .4);
        }

        .compass-outer::before {
            content: '';
            position: absolute;
            inset: 10px;
            border-radius: 50%;
            border: 1px solid rgba(26, 107, 80, .18);
        }

        .card-pt {
            position: absolute;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: .04em;
            color: var(--mt);
        }

        .card-pt.n {
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--gdl);
        }

        .card-pt.s {
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .card-pt.e {
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        .card-pt.w {
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
        }

        .q-arrow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(0deg);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 1s cubic-bezier(.34, 1.56, .64, 1);
            z-index: 2;
        }

        .arr-tip {
            width: 0;
            height: 0;
            border-left: 9px solid transparent;
            border-right: 9px solid transparent;
            border-bottom: 16px solid var(--gdl);
        }

        .arr-body {
            width: 4px;
            height: 65px;
            background: linear-gradient(to bottom, var(--gdl), rgba(201, 168, 76, .3));
            border-radius: 0 0 4px 4px;
        }

        .kaaba-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            border-radius: 6px;
            background: var(--bg);
            border: 2px solid var(--gd);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .95rem;
            z-index: 3;
            box-shadow: 0 0 10px rgba(201, 168, 76, .25);
        }

        .compass-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .8rem;
            width: 100%;
        }

        .stat-chip {
            background: var(--c2);
            border: 1px solid var(--br);
            border-radius: 11px;
            padding: .75rem .9rem;
            text-align: center;
        }

        .stat-chip .lbl {
            font-size: .67rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--mt);
        }

        .stat-chip .val {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--gdl);
            line-height: 1.1;
        }

        .stat-chip .unit {
            font-size: .7rem;
            color: var(--mt);
        }

        .info-card {
            background: var(--c1);
            border: 1px solid var(--br);
            border-radius: 18px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .loc-btn {
            width: 100%;
            padding: .85rem;
            background: linear-gradient(135deg, var(--em), var(--eml));
            border: none;
            border-radius: 13px;
            color: #fff;
            font-family: 'Outfit', sans-serif;
            font-size: .95rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .55rem;
            transition: all .25s;
            box-shadow: 0 4px 16px rgba(26, 107, 80, .3);
        }

        .loc-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 107, 80, .4);
        }

        .loc-btn:disabled {
            opacity: .55;
            cursor: wait;
            transform: none;
        }

        .status {
            padding: .8rem 1rem;
            border-radius: 11px;
            border: 1px solid var(--br);
            background: var(--c2);
            font-size: .82rem;
            color: var(--mt);
            display: flex;
            align-items: center;
            gap: .5rem;
            min-height: 46px;
        }

        .status.ok {
            border-color: rgba(26, 107, 80, .4);
            color: var(--eml);
            background: rgba(26, 107, 80, .1);
        }

        .status.err {
            border-color: rgba(240, 80, 80, .4);
            color: #f05050;
            background: rgba(240, 80, 80, .08);
        }

        .coords {
            font-size: .78rem;
            color: var(--mt);
            display: none;
        }

        .coords span {
            color: var(--txt);
            font-weight: 500;
        }

        @keyframes rot {
            to {
                transform: rotate(360deg);
            }
        }

        .rotating {
            animation: rot 1s linear infinite;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="yw-shell">

        <?php
        $menuPath = __DIR__ . '/../../../../view/sections/vitrine/menu.php';
        if (file_exists($menuPath)) require_once $menuPath;
        ?>

        <main class="yw-main">

            <section class="hero">
                <span class="bsm"><?= htmlspecialchars($textes['bismillah'] ?? 'وَلِلَّهِ الْمَشْرِقُ وَالْمَغْرِبُ') ?></span>
                <span class="bsm-ref"><?= htmlspecialchars($textes['verset_ref'] ?? 'Sourate Al-Baqara, verset 115') ?></span>
                <h1><?= htmlspecialchars($textes['titre'] ?? 'Direction de la Qibla') ?></h1>
                <p><?= htmlspecialchars($textes['sous_titre'] ?? 'Trouvez la direction de La Mecque') ?></p>
            </section>

            <div class="q-wrap">

                <div class="compass-card">
                    <div class="compass-outer" id="compassOuter">
                        <span class="card-pt n"><?= htmlspecialchars($textes['nord'] ?? 'N') ?></span>
                        <span class="card-pt s">S</span>
                        <span class="card-pt e">E</span>
                        <span class="card-pt w">O</span>
                        <div class="q-arrow" id="qArrow">
                            <div class="arr-tip"></div>
                            <div class="arr-body"></div>
                        </div>
                        <div class="kaaba-center">🕋</div>
                    </div>
                    <div class="compass-stats">
                        <div class="stat-chip">
                            <div class="lbl"><?= htmlspecialchars($textes['direction'] ?? 'Direction') ?></div>
                            <div class="val" id="valDir">—</div>
                            <div class="unit">°</div>
                        </div>
                        <div class="stat-chip">
                            <div class="lbl"><?= htmlspecialchars($textes['distance'] ?? 'Distance') ?></div>
                            <div class="val" id="valDist">—</div>
                            <div class="unit">km</div>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <button class="loc-btn" id="locBtn" onclick="localiser()">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span id="locTxt"><?= htmlspecialchars($textes['localiser'] ?? 'Me localiser') ?></span>
                    </button>
                    <div class="status" id="statusBox">
                        <i class="bi bi-info-circle"></i>
                        <?= htmlspecialchars($textes['en_cours'] ?? 'Cliquez pour localiser') ?>
                    </div>
                    <div class="coords" id="coordsBox">
                        Lat : <span id="dLat">—</span> &nbsp;·&nbsp; Lng : <span id="dLng">—</span>
                    </div>
                </div>

            </div>
        </main>

        <?php
        $footerPath = __DIR__ . '/../../../../view/sections/vitrine/footer.php';
        if (file_exists($footerPath)) require_once $footerPath;
        ?>

    </div>

    <script>
        const AJAX_URL = '<?= $root ?>index.php?action=ajax_qibla';
        const arrow = document.getElementById('qArrow');
        let qiblaAngle = 0;

        function localiser() {
            const btn = document.getElementById('locBtn'),
                locTxt = document.getElementById('locTxt');
            if (!navigator.geolocation) {
                setStatus('err', '<i class="bi bi-exclamation-triangle"></i> <?= addslashes($textes['erreur_geo'] ?? 'Géolocalisation non disponible') ?>');
                return;
            }
            btn.disabled = true;
            locTxt.innerHTML = '<i class="bi bi-arrow-repeat rotating"></i> <?= addslashes($textes['en_cours'] ?? 'Localisation…') ?>';
            setStatus('', '<i class="bi bi-arrow-repeat rotating"></i> Localisation en cours…');

            navigator.geolocation.getCurrentPosition(
                pos => {
                    const lat = pos.coords.latitude,
                        lng = pos.coords.longitude;
                    document.getElementById('dLat').textContent = lat.toFixed(5);
                    document.getElementById('dLng').textContent = lng.toFixed(5);
                    document.getElementById('coordsBox').style.display = 'block';

                    fetch(AJAX_URL, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'lat=' + encodeURIComponent(lat) + '&lng=' + encodeURIComponent(lng)
                        })
                        .then(r => {
                            if (!r.ok) throw new Error('HTTP ' + r.status);
                            return r.json();
                        })
                        .then(data => {
                            if (!data.success) throw new Error(data.erreur || 'Erreur serveur');
                            qiblaAngle = parseFloat(data.direction);
                            const dist = Math.round(parseFloat(data.distance));
                            document.getElementById('valDir').textContent = qiblaAngle.toFixed(1);
                            document.getElementById('valDist').textContent = dist.toLocaleString();
                            arrow.style.transform = 'translate(-50%,-50%) rotate(' + qiblaAngle + 'deg)';
                            document.getElementById('compassOuter').classList.add('active');
                            setStatus('ok', '<i class="bi bi-compass"></i> Direction : ' + qiblaAngle.toFixed(1) + '° — Distance : ' + dist.toLocaleString() + ' km');
                        })
                        .catch(err => setStatus('err', '<i class="bi bi-exclamation-triangle"></i> ' + err.message))
                        .finally(() => {
                            btn.disabled = false;
                            locTxt.innerHTML = '<i class="bi bi-geo-alt-fill"></i> <?= addslashes($textes['localiser'] ?? 'Me localiser') ?>';
                        });
                },
                err => {
                    const msg = err.code === 1 ? '<?= addslashes($textes['refus_geo'] ?? 'Géolocalisation refusée') ?>' : '<?= addslashes($textes['erreur_geo'] ?? 'Erreur de géolocalisation') ?>';
                    setStatus('err', '<i class="bi bi-exclamation-triangle"></i> ' + msg);
                    btn.disabled = false;
                    locTxt.innerHTML = '<i class="bi bi-geo-alt-fill"></i> <?= addslashes($textes['localiser'] ?? 'Me localiser') ?>';
                }, {
                    enableHighAccuracy: true,
                    timeout: 12000,
                    maximumAge: 60000
                }
            );
        }

        function setStatus(type, html) {
            const box = document.getElementById('statusBox');
            box.className = 'status' + (type ? ' ' + type : '');
            box.innerHTML = html;
        }

        if (typeof DeviceOrientationEvent !== 'undefined') {
            window.addEventListener('deviceorientation', e => {
                if (qiblaAngle === 0) return;
                const heading = e.webkitCompassHeading || (360 - (e.alpha || 0));
                arrow.style.transform = 'translate(-50%,-50%) rotate(' + (qiblaAngle - heading) + 'deg)';
            });
        }
    </script>
</body>

</html>