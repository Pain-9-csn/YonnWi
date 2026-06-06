<?php
// ============================================================
// SESSION EN TOUT PREMIER — avant tout output HTML
// ============================================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variables injectées par CaptureAudioController::index()
$textes   = $textes   ?? [];
$userId   = $userId   ?? null;
$lang     = $lang     ?? 'fr';
$dir      = $textes['dir'] ?? 'ltr';

// Chemin racine depuis view/pages/vitrine/dictaphone/
$root = '../../../../';
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $dir ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= htmlspecialchars($textes['titre'] ?? 'Saisie Vocale') ?> — YoonWi</title>
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

        .hero h1 {
            font-size: 2rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--eml),  #71c55d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: .3rem;
        }

        .hero p {
            font-size: .85rem;
            color: var(--mt);
        }

        .voc-main {
            max-width: 560px;
            margin: 0 auto;
            padding: 2.5rem 1rem 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .rec-block {
            width: 100%;
            background: var(--c1);
            border: 1px solid var(--br);
            border-radius: 20px;
            padding: 2.5rem 1.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .rec-block::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 0%, rgba(26, 107, 80, .07), transparent 70%);
            pointer-events: none;
        }

        .mic-ring {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: var(--c2);
            border: 2px solid  #71c55d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.4rem;
            transition: border-color .3s, box-shadow .3s;
        }

        .mic-ring.recording {
            border-color: var(--eml);
            animation: ring-pulse 1.2s ease-in-out infinite;
        }

        @keyframes ring-pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(26, 107, 80, .5);
            }

            50% {
                box-shadow: 0 0 0 18px rgba(26, 107, 80, 0);
            }
        }

        .mic-btn {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            border: none;
            background:  #71c55d;
            color: #fff;
            font-size: 1.7rem;
            cursor: pointer;
            transition: all .25s;
            box-shadow: 0 4px 18px rgba(26, 107, 80, .4);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mic-btn:hover {
            transform: scale(1.06);
        }

        .mic-btn.rec-on {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            box-shadow: 0 4px 18px rgba(192, 57, 43, .5);
        }

        .mic-btn:disabled {
            opacity: .5;
            cursor: wait;
            transform: none;
        }

        .wavef {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            height: 36px;
            margin-bottom: 1rem;
        }

        .wbar {
            width: 4px;
            border-radius: 3px;
            background:  #71c55d;
            height: 5px;
            transition: height .08s;
        }

        .recording .wbar {
            animation: wwave .5s ease-in-out infinite alternate;
        }

        .wbar:nth-child(2) {
            animation-delay: .05s;
        }

        .wbar:nth-child(3) {
            animation-delay: .10s;
        }

        .wbar:nth-child(4) {
            animation-delay: .15s;
        }

        .wbar:nth-child(5) {
            animation-delay: .20s;
        }

        .wbar:nth-child(6) {
            animation-delay: .25s;
        }

        .wbar:nth-child(7) {
            animation-delay: .30s;
        }

        .wbar:nth-child(8) {
            animation-delay: .35s;
        }

        .wbar:nth-child(9) {
            animation-delay: .40s;
        }

        .wbar:nth-child(10) {
            animation-delay: .45s;
        }

        @keyframes wwave {
            from {
                height: 4px;
            }

            to {
                height: 28px;
            }
        }

        .rec-timer {
            font-size: 1.8rem;
            font-weight: 700;
            color:  #71c55d;
            font-variant-numeric: tabular-nums;
            margin-bottom: .6rem;
        }

        .rec-status {
            font-size: .85rem;
            color: var(--mt);
            min-height: 22px;
            margin-bottom: 1.1rem;
        }

        .rec-actions {
            display: flex;
            gap: .75rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .rbtn {
            padding: .6rem 1.3rem;
            border-radius: 11px;
            border: none;
            font-family: 'Outfit', sans-serif;
            font-size: .85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: .45rem;
        }

        .rbtn-start {
            background:  #71c55d;
            color: #fff;
            box-shadow: 0 3px 12px rgba(26, 107, 80, .35);
        }

        .rbtn-stop {
            background: rgba(192, 57, 43, .12);
            color: #e74c3c;
            border: 1px solid rgba(192, 57, 43, .28);
        }

        .rbtn-retry {
            background: var(--c2);
            color: var(--txt);
            border: 1px solid var(--br);
        }

        .rbtn:hover:not(:disabled) {
            transform: translateY(-1px);
        }

        .rbtn:disabled {
            opacity: .4;
            cursor: not-allowed;
            transform: none;
        }

        .result-box {
            width: 100%;
            background: var(--c1);
            border: 1px solid var(--br);
            border-radius: 16px;
            padding: 1.4rem;
            margin-top: 1.25rem;
            display: none;
        }

        .result-box.show {
            display: block;
            animation: fadeup .3s ease;
        }

        @keyframes fadeup {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-found {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: var(--c2);
            border-radius: 12px;
            padding: 1rem;
        }

        .result-thumb {
            width: 64px;
            height: 64px;
            border-radius: 10px;
            flex-shrink: 0;
            background: var(--c1);
            border: 1px solid var(--br);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            overflow: hidden;
        }

        .result-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .result-info h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: .15rem;
        }

        .result-info p {
            font-size: .78rem;
            color: var(--mt);
        }

        .result-playbtn {
            margin-left: auto;
            flex-shrink: 0;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--em), var(--eml));
            border: none;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .result-nope {
            text-align: center;
            padding: .5rem;
            color: var(--mt);
        }

        .result-nope i {
            font-size: 1.8rem;
            display: block;
            color: var(--gd);
            margin-bottom: .4rem;
        }
    </style>
</head>

<body>
    <div class="yw-shell">

        
        <?php require_once("../../../sections/vitrine/menu.php"); ?>

        <main class="yw-main">

            <section class="hero">
                <h1><?= htmlspecialchars($textes['titre'] ?? 'Reconnaissance Vocale') ?></h1>
                <p><?= htmlspecialchars($textes['sous_titre'] ?? 'Fredonnez un Xassida pour l\'identifier') ?></p>
            </section>

            <div class="voc-main">

                <div class="rec-block" id="recBlock">
                    <div class="mic-ring" id="micRing">
                        <button class="mic-btn" id="micBtn" onclick="toggleRec()">
                            <i class="bi bi-mic-fill" id="micIcon"></i>
                        </button>
                    </div>
                    <div class="wavef" id="wavef">
                        <?php for ($i = 0; $i < 12; $i++): ?><div class="wbar"></div><?php endfor; ?>
                    </div>
                    <div class="rec-timer" id="recTimer">0:00</div>
                    <div class="rec-status" id="recStatus"><?= htmlspecialchars($textes['btn_ecouter'] ?? 'Appuyez pour commencer') ?></div>
                    <div class="rec-actions">
                        <button class="rbtn rbtn-start" id="btnStart" onclick="demarrer()">
                            <i class="bi bi-mic"></i> <?= htmlspecialchars($textes['btn_ecouter'] ?? 'Écouter') ?>
                        </button>
                        <button class="rbtn rbtn-stop" id="btnStop" onclick="arreter()" disabled>
                            <i class="bi bi-stop-circle"></i> <?= htmlspecialchars($textes['btn_stop'] ?? 'Stop') ?>
                        </button>
                        <button class="rbtn rbtn-retry" id="btnRetry" onclick="reinit()" style="display:none">
                            <i class="bi bi-arrow-repeat"></i> <?= htmlspecialchars($textes['btn_relancer'] ?? 'Réessayer') ?>
                        </button>
                    </div>
                </div>

                <div class="result-box" id="resultBox">
                    <div id="resultInner"></div>
                </div>

            </div>
        </main>

        <?php
        $footerPath = __DIR__ . '/../../../../view/sections/vitrine/footer.php';
        if (file_exists($footerPath)) require_once $footerPath;
        ?>

    </div>

    <audio id="bgAudio" preload="none"></audio>

    <script>
        const AJAX_URL = '<?= $root ?>index.php?action=ajax_identifier';
        let mediaRecorder = null,
            audioChunks = [],
            timerInt = null,
            seconds = 0;
        let isRec = false,
            audioCtx = null,
            analyser = null,
            animId = null;

        function toggleRec() {
            isRec ? arreter() : demarrer();
        }

        function demarrer() {
            if (!navigator.mediaDevices?.getUserMedia) {
                alert('Microphone non disponible.');
                return;
            }
            navigator.mediaDevices.getUserMedia({
                audio: true
            }).then(stream => {
                audioCtx = new(window.AudioContext || window.webkitAudioContext)();
                analyser = audioCtx.createAnalyser();
                analyser.fftSize = 64;
                audioCtx.createMediaStreamSource(stream).connect(analyser);
                mediaRecorder = new MediaRecorder(stream);
                audioChunks = [];
                mediaRecorder.ondataavailable = e => {
                    if (e.data.size > 0) audioChunks.push(e.data);
                };
                mediaRecorder.onstop = analyserAudio;
                mediaRecorder.start(100);
                isRec = true;
                seconds = 0;
                setUI('rec');
                timerInt = setInterval(() => {
                    seconds++;
                    document.getElementById('recTimer').textContent = Math.floor(seconds / 60) + ':' + String(seconds % 60).padStart(2, '0');
                }, 1000);
                animerVagues();
            }).catch(() => alert('Accès au microphone refusé.'));
        }

        function arreter() {
            if (mediaRecorder && isRec) {
                mediaRecorder.stop();
                mediaRecorder.stream.getTracks().forEach(t => t.stop());
                clearInterval(timerInt);
                cancelAnimationFrame(animId);
                isRec = false;
                setUI('analyse');
            }
        }

        function reinit() {
            setUI('idle');
            document.getElementById('recTimer').textContent = '0:00';
            document.getElementById('resultBox').classList.remove('show');
            seconds = 0;
        }

        function animerVagues() {
            if (!analyser) return;
            const bars = document.querySelectorAll('.wbar'),
                data = new Uint8Array(analyser.frequencyBinCount);

            function draw() {
                animId = requestAnimationFrame(draw);
                analyser.getByteFrequencyData(data);
                bars.forEach((bar, i) => {
                    bar.style.height = Math.max(4, (data[i * 2] || 0) * 0.22) + 'px';
                });
            }
            draw();
        }

        function analyserAudio() {
            if (!audioChunks.length) {
                reinit();
                return;
            }
            const blob = new Blob(audioChunks, {
                    type: 'audio/webm'
                }),
                reader = new FileReader();
            reader.onload = () => {
                const b64 = reader.result.split(',')[1] || '',
                    fp = genFingerprint(b64, seconds);
                const fd = new FormData();
                fd.append('fingerprint', fp);
                fd.append('duree', seconds);
                fetch(AJAX_URL, {
                        method: 'POST',
                        body: fd
                    }).then(r => r.json())
                    .then(data => {
                        afficherResultat(data);
                        setUI('done');
                    })
                    .catch(() => {
                        afficherResultat({
                            success: false
                        });
                        setUI('done');
                    });
            };
            reader.readAsDataURL(blob);
        }

        function genFingerprint(b64, dur) {
            let h = 5381;
            const sample = b64.substring(0, 512);
            for (let i = 0; i < sample.length; i++) {
                h = ((h << 5) + h) ^ sample.charCodeAt(i);
                h = h >>> 0;
            }
            return h.toString(16).padStart(8, '0') + '_' + b64.length + '_' + dur;
        }

        function afficherResultat(data) {
            const box = document.getElementById('resultBox'),
                inner = document.getElementById('resultInner');
            if (data.success && data.trouve && data.xassida) {
                const x = data.xassida;
                const img = x.image_url ? '<img src="' + esc(x.image_url) + '" alt="">' : '🎵';
                const playBtn = x.audio_url ? '<button class="result-playbtn" onclick="lireAudio(\'' + esc(x.audio_url) + '\')"><i class="bi bi-play-fill"></i></button>' : '';
                inner.innerHTML =
                    '<div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.07em;color:var(--eml);margin-bottom:.7rem">✅ <?= addslashes($textes['trouve'] ?? 'Xassida identifié') ?></div>' +
                    '<div class="result-found"><div class="result-thumb">' + img + '</div>' +
                    '<div class="result-info"><h4>' + esc(x.titre || '') + '</h4><p>' + esc(x.auteur || '') + '</p></div>' + playBtn + '</div>';
            } else {
                inner.innerHTML = '<div class="result-nope"><i class="bi bi-question-circle"></i><?= addslashes($textes['non_trouve'] ?? 'Non reconnu') ?><br><small>' + esc(data.message || 'Réessayez en fredonnant plus longtemps.') + '</small></div>';
            }
            box.classList.add('show');
        }

        function lireAudio(url) {
            if (!url) return;
            const a = document.getElementById('bgAudio');
            a.src = url;
            a.play().catch(() => {});
        }

        function setUI(state) {
            const ring = document.getElementById('micRing'),
                btn = document.getElementById('micBtn'),
                icon = document.getElementById('micIcon'),
                status = document.getElementById('recStatus'),
                wavef = document.getElementById('wavef'),
                btnStart = document.getElementById('btnStart'),
                btnStop = document.getElementById('btnStop'),
                btnRetry = document.getElementById('btnRetry'),
                bars = document.querySelectorAll('.wbar');
            ring.classList.toggle('recording', state === 'rec');
            wavef.classList.toggle('recording', state === 'rec');
            if (state === 'idle') {
                btn.className = 'mic-btn';
                btn.disabled = false;
                icon.className = 'bi bi-mic-fill';
                status.textContent = '<?= addslashes($textes['btn_ecouter'] ?? 'Appuyez pour commencer') ?>';
                btnStart.disabled = false;
                btnStop.disabled = true;
                btnRetry.style.display = 'none';
                bars.forEach(b => b.style.height = '5px');
            } else if (state === 'rec') {
                btn.className = 'mic-btn rec-on';
                icon.className = 'bi bi-stop-fill';
                status.textContent = '<?= addslashes($textes['ecoute'] ?? 'Écoute en cours…') ?>';
                btnStart.disabled = true;
                btnStop.disabled = false;
                btnRetry.style.display = 'none';
            } else if (state === 'analyse') {
                btn.className = 'mic-btn';
                btn.disabled = true;
                icon.className = 'bi bi-hourglass-split';
                status.textContent = '<?= addslashes($textes['analyse'] ?? 'Analyse en cours…') ?>';
                btnStart.disabled = true;
                btnStop.disabled = true;
            } else if (state === 'done') {
                btn.disabled = false;
                icon.className = 'bi bi-mic-fill';
                status.textContent = '';
                btnStart.disabled = false;
                btnStop.disabled = true;
                btnRetry.style.display = 'flex';
            }
        }

        function esc(s) {
            return String(s || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        }
    </script>
</body>

</html>