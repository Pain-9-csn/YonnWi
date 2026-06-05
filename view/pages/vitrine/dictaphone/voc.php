<!DOCTYPE html>
<html lang="fr" dir="<?= ($textes['dir'] ?? 'ltr') ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($textes['titre']) ?> — YoonWi</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="../../../../public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../../public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
    <style>
        :root {
            --teal: #1a8a8a;
            --teal-l: #26b5b5;
            --gold: #c9a84c;
            --bg: #080e14;
            --card: #0f1923;
            --card2: #15222e;
            --text: #dce8f0;
            --muted: #7a94a8;
            --border: rgba(26, 138, 138, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .page-wrapper {
            padding-top: 80px
        }

        /* Hero */
        .voc-hero {
            padding: 3rem 0 2.5rem;
            text-align: center;
            background: linear-gradient(180deg, #0d1c2b 0%, var(--bg) 100%);
            border-bottom: 1px solid var(--border);
        }

        .voc-hero h1 {
            font-size: 2.4rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--teal-l), #7ee8e8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.4rem;
        }

        .voc-hero p {
            color: var(--muted);
            font-size: 1rem;
        }

        /* Main grid */
        .voc-main {
            max-width: 960px;
            margin: 0 auto;
            padding: 2.5rem 1rem 4rem;
        }

        /* Record block */
        .record-block {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .record-block::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 0%, rgba(26, 138, 138, 0.07), transparent 70%);
            pointer-events: none;
        }

        /* Visualizer */
        .visualizer-ring {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            position: relative;
            background: var(--card2);
            box-shadow: 0 0 0 0 rgba(26, 138, 138, 0);
            transition: box-shadow 0.3s;
        }

        .visualizer-ring.recording {
            animation: ring-pulse 1.2s ease-in-out infinite;
            border-color: var(--teal-l);
        }

        @keyframes ring-pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(26, 138, 138, 0.5);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(26, 138, 138, 0);
            }
        }

        .mic-btn {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: none;
            background: linear-gradient(135deg, var(--teal), var(--teal-l));
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 20px rgba(26, 138, 138, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .mic-btn:hover {
            transform: scale(1.07);
        }

        .mic-btn.recording {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            box-shadow: 0 4px 20px rgba(192, 57, 43, 0.5);
        }

        .mic-btn:disabled {
            opacity: 0.5;
            cursor: wait;
        }

        /* Waveform bars */
        .waveform {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
            height: 40px;
            margin-bottom: 1.2rem;
        }

        .wave-bar {
            width: 4px;
            border-radius: 4px;
            background: var(--teal);
            height: 6px;
            transition: height 0.1s;
        }

        .recording .wave-bar {
            animation: wave-anim 0.5s ease-in-out infinite alternate;
        }

        .wave-bar:nth-child(2) {
            animation-delay: 0.05s;
        }

        .wave-bar:nth-child(3) {
            animation-delay: 0.1s;
        }

        .wave-bar:nth-child(4) {
            animation-delay: 0.15s;
        }

        .wave-bar:nth-child(5) {
            animation-delay: 0.2s;
        }

        .wave-bar:nth-child(6) {
            animation-delay: 0.25s;
        }

        .wave-bar:nth-child(7) {
            animation-delay: 0.3s;
        }

        .wave-bar:nth-child(8) {
            animation-delay: 0.35s;
        }

        @keyframes wave-anim {
            from {
                height: 4px;
            }

            to {
                height: 32px;
            }
        }

        .record-status {
            font-size: 0.9rem;
            color: var(--muted);
            min-height: 26px;
            margin-bottom: 0.8rem;
        }

        .timer {
            font-size: 2rem;
            font-weight: 700;
            color: var(--teal-l);
            font-variant-numeric: tabular-nums;
            margin-bottom: 1.2rem;
        }

        .record-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-rec {
            padding: 0.65rem 1.5rem;
            border-radius: 12px;
            border: none;
            font-family: 'Outfit', sans-serif;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-start {
            background: linear-gradient(135deg, var(--teal), var(--teal-l));
            color: #fff;
            box-shadow: 0 4px 14px rgba(26, 138, 138, 0.35);
        }

        .btn-stop {
            background: rgba(192, 57, 43, 0.15);
            color: #e74c3c;
            border: 1px solid rgba(192, 57, 43, 0.3);
        }

        .btn-retry {
            background: var(--card2);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-rec:hover {
            transform: translateY(-1px);
        }

        .btn-rec:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
        }

        /* Result card */
        .result-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.8rem;
            margin-bottom: 2rem;
            display: none;
        }

        .result-card.show {
            display: block;
            animation: fadeUp 0.3s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-found {
            display: flex;
            gap: 1.2rem;
            align-items: center;
            background: var(--card2);
            border-radius: 14px;
            padding: 1.2rem;
        }

        .result-img {
            width: 72px;
            height: 72px;
            border-radius: 12px;
            object-fit: cover;
            background: var(--card);
            border: 1px solid var(--border);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .result-info h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.2rem;
        }

        .result-info p {
            font-size: 0.82rem;
            color: var(--muted);
        }

        .result-play {
            margin-left: auto;
            flex-shrink: 0;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--teal), var(--teal-l));
            border: none;
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .result-notfound {
            text-align: center;
            color: var(--muted);
            padding: 0.5rem;
        }

        .result-notfound i {
            font-size: 2rem;
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gold);
        }

        /* Tips row */
        .tips-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        @media(max-width:600px) {
            .tips-row {
                grid-template-columns: 1fr;
            }
        }

        .tip-chip {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .tip-chip i {
            font-size: 1.2rem;
            color: var(--teal-l);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .tip-chip p {
            font-size: 0.82rem;
            color: var(--muted);
            margin: 0;
        }

        /* Popular grid */
        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .popular-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }

        .popular-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .popular-card:hover {
            border-color: var(--teal);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 138, 138, 0.15);
        }

        .popular-card .thumb {
            width: 100%;
            height: 80px;
            border-radius: 10px;
            background: var(--card2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            overflow: hidden;
        }

        .popular-card .thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .popular-card h5 {
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .popular-card p {
            font-size: 0.76rem;
            color: var(--muted);
            margin: 0;
        }

        .popular-card .ecoutes {
            font-size: 0.72rem;
            color: var(--teal-l);
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        <?php if (file_exists(__DIR__ . '/../../../../view/sections/vitrine/menu.php')) {
            require_once __DIR__ . '/../../../../view/sections/vitrine/menu.php';
        } ?>

        <!-- Hero -->
        <section class="voc-hero">
            <h1><?= htmlspecialchars($textes['titre']) ?></h1>
            <p><?= htmlspecialchars($textes['sous_titre']) ?></p>
        </section>

        <div class="voc-main">

            <!-- Record block -->
            <div class="record-block" id="recordBlock">
                <div class="visualizer-ring" id="vizRing">
                    <button class="mic-btn" id="micBtn" onclick="toggleRecord()">
                        <i class="bi bi-mic-fill" id="micIcon"></i>
                    </button>
                </div>
                <div class="waveform" id="waveform">
                    <?php for ($i = 0; $i < 12; $i++): ?><div class="wave-bar"></div><?php endfor; ?>
                </div>
                <div class="timer" id="timerDisplay">0:00</div>
                <div class="record-status" id="recordStatus"><?= htmlspecialchars($textes['btn_ecouter']) ?></div>
                <div class="record-actions">
                    <button class="btn-rec btn-start" id="btnStart" onclick="startRecord()">
                        <i class="bi bi-mic"></i> <?= htmlspecialchars($textes['btn_ecouter']) ?>
                    </button>
                    <button class="btn-rec btn-stop" id="btnStop" onclick="stopRecord()" disabled>
                        <i class="bi bi-stop-circle"></i> <?= htmlspecialchars($textes['btn_stop']) ?>
                    </button>
                    <button class="btn-rec btn-retry" id="btnRetry" onclick="resetRecord()" style="display:none">
                        <i class="bi bi-arrow-repeat"></i> <?= htmlspecialchars($textes['btn_relancer']) ?>
                    </button>
                </div>
            </div>

            <!-- Result -->
            <div class="result-card" id="resultCard">
                <div id="resultInner"></div>
            </div>

            <!-- Tips -->
            <div class="tips-row">
                <div class="tip-chip"><i class="bi bi-music-note-beamed"></i>
                    <p><?= htmlspecialchars($textes['conseil1']) ?></p>
                </div>
                <div class="tip-chip"><i class="bi bi-volume-mute"></i>
                    <p><?= htmlspecialchars($textes['conseil2']) ?></p>
                </div>
                <div class="tip-chip"><i class="bi bi-phone"></i>
                    <p><?= htmlspecialchars($textes['conseil3']) ?></p>
                </div>
                <div class="tip-chip"><i class="bi bi-speedometer"></i>
                    <p><?= htmlspecialchars($textes['conseil4']) ?></p>
                </div>
            </div>

            <!-- Populaires -->
            <div class="section-title"><i class="bi bi-fire"></i> <?= htmlspecialchars($textes['populaires']) ?></div>
            <div class="popular-grid" id="popularGrid">
                <?php if (!empty($xassidas)): foreach ($xassidas as $x): ?>
                        <div class="popular-card" onclick="playXassida('<?= htmlspecialchars($x['audio_url'] ?? '') ?>')">
                            <div class="thumb">
                                <?php if (!empty($x['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($x['image_url']) ?>" alt="">
                                    <?php else: ?>🎵<?php endif; ?>
                            </div>
                            <h5><?= htmlspecialchars($x['titre'] ?? 'Xassida') ?></h5>
                            <p><?= htmlspecialchars($x['auteur'] ?? '') ?></p>
                            <span class="ecoutes"><i class="bi bi-ear"></i> <?= (int)($x['nb_ecoutes'] ?? 0) ?> écoutes</span>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p style="color:var(--muted);grid-column:1/-1;text-align:center;padding:2rem;">Aucun Xassida disponible pour l'instant.</p>
                <?php endif; ?>
            </div>

        </div>

        <?php if (file_exists(__DIR__ . '/../../../../view/sections/vitrine/footer.php')) {
            require_once __DIR__ . '/../../../../view/sections/vitrine/footer.php';
        } ?>

        <audio id="bgPlayer" style="display:none"></audio>

        <script>
            let mediaRecorder = null;
            let audioChunks = [];
            let timerInterval = null;
            let seconds = 0;
            let isRecording = false;
            let audioContext = null;
            let analyser = null;
            let animFrame = null;

            const AJAX_URL = '../../../../index.php?action=ajax_identifier';

            function startRecord() {
                if (!navigator.mediaDevices) {
                    alert('Microphone non accessible sur ce navigateur.');
                    return;
                }
                navigator.mediaDevices.getUserMedia({
                        audio: true
                    })
                    .then(stream => {
                        audioContext = new(window.AudioContext || window.webkitAudioContext)();
                        analyser = audioContext.createAnalyser();
                        analyser.fftSize = 64;
                        audioContext.createMediaStreamSource(stream).connect(analyser);

                        mediaRecorder = new MediaRecorder(stream);
                        audioChunks = [];
                        mediaRecorder.ondataavailable = e => audioChunks.push(e.data);
                        mediaRecorder.onstop = analyzeAudio;
                        mediaRecorder.start(100);

                        isRecording = true;
                        seconds = 0;
                        setUI('recording');
                        timerInterval = setInterval(() => {
                            seconds++;
                            const m = Math.floor(seconds / 60);
                            const s = seconds % 60;
                            document.getElementById('timerDisplay').textContent = `${m}:${s.toString().padStart(2,'0')}`;
                        }, 1000);

                        animateWave();
                    })
                    .catch(() => alert('Accès microphone refusé.'));
            }

            function stopRecord() {
                if (mediaRecorder && isRecording) {
                    mediaRecorder.stop();
                    mediaRecorder.stream.getTracks().forEach(t => t.stop());
                    clearInterval(timerInterval);
                    cancelAnimationFrame(animFrame);
                    isRecording = false;
                    setUI('analyzing');
                }
            }

            function resetRecord() {
                setUI('idle');
                document.getElementById('timerDisplay').textContent = '0:00';
                document.getElementById('resultCard').classList.remove('show');
                seconds = 0;
            }

            function animateWave() {
                if (!analyser) return;
                const bars = document.querySelectorAll('.wave-bar');
                const data = new Uint8Array(analyser.frequencyBinCount);

                function draw() {
                    animFrame = requestAnimationFrame(draw);
                    analyser.getByteFrequencyData(data);
                    bars.forEach((bar, i) => {
                        const v = data[i * 2] || 0;
                        bar.style.height = Math.max(4, v * 0.25) + 'px';
                        bar.style.background = `hsl(${180 - v/2},70%,55%)`;
                    });
                }
                draw();
            }

            function analyzeAudio() {
                setUI('analyzing');
                if (!audioChunks.length) {
                    resetRecord();
                    return;
                }

                const blob = new Blob(audioChunks, {
                    type: 'audio/webm'
                });
                const reader = new FileReader();
                reader.onload = () => {
                    const base64 = reader.result.split(',')[1];
                    const fp = simpleFingerprint(base64);

                    const fd = new FormData();
                    fd.append('fingerprint', fp);
                    fd.append('duree', seconds);

                    fetch(AJAX_URL, {
                            method: 'POST',
                            body: fd
                        })
                        .then(r => r.json())
                        .then(data => {
                            showResult(data);
                            setUI('done');
                        })
                        .catch(() => {
                            showResult({
                                success: false
                            });
                            setUI('done');
                        });
                };
                reader.readAsDataURL(blob);
            }

            function simpleFingerprint(b64) {
                let h = 0;
                for (let i = 0; i < Math.min(b64.length, 512); i++) {
                    h = ((h << 5) - h) + b64.charCodeAt(i);
                    h |= 0;
                }
                return Math.abs(h).toString(16).padStart(8, '0') + '_' + b64.length;
            }

            function showResult(data) {
                const card = document.getElementById('resultCard');
                const inner = document.getElementById('resultInner');

                if (data.success && data.trouve && data.xassida) {
                    const x = data.xassida;
                    inner.innerHTML = `
      <div style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.08em;color:var(--teal-l);margin-bottom:0.8rem;">
        ✅ <?= addslashes($textes['trouve']) ?>
      </div>
      <div class="result-found">
        <div class="result-img">${x.image_url ? `<img src="${x.image_url}" alt="">` : '🎵'}</div>
        <div class="result-info">
          <h4>${escHtml(x.titre)}</h4>
          <p>${escHtml(x.auteur || '')}</p>
          ${x.description ? `<p style="margin-top:4px;font-size:0.78rem;">${escHtml(x.description.substring(0,80))}…</p>` : ''}
        </div>
        ${x.audio_url ? `<button class="result-play" onclick="playXassida('${x.audio_url}')"><i class="bi bi-play-fill"></i></button>` : ''}
      </div>`;
                } else {
                    inner.innerHTML = `
      <div class="result-notfound">
        <i class="bi bi-question-circle"></i>
        <?= addslashes($textes['non_trouve']) ?><br>
        <small style="font-size:0.78rem;">${data.message || 'Réessayez en fredonnant plus longtemps.'}</small>
      </div>`;
                }
                card.classList.add('show');
            }

            function playXassida(url) {
                if (!url) return;
                const player = document.getElementById('bgPlayer');
                player.src = url;
                player.play().catch(() => {});
            }

            function setUI(state) {
                const ring = document.getElementById('vizRing');
                const micBtn = document.getElementById('micBtn');
                const micIcon = document.getElementById('micIcon');
                const status = document.getElementById('recordStatus');
                const btnStart = document.getElementById('btnStart');
                const btnStop = document.getElementById('btnStop');
                const btnRetry = document.getElementById('btnRetry');
                const waveform = document.getElementById('waveform');

                ring.classList.toggle('recording', state === 'recording');

                if (state === 'idle') {
                    micBtn.className = 'mic-btn';
                    micIcon.className = 'bi bi-mic-fill';
                    status.textContent = '<?= addslashes($textes['btn_ecouter']) ?>';
                    btnStart.disabled = false;
                    btnStop.disabled = true;
                    btnRetry.style.display = 'none';
                    waveform.className = 'waveform';
                    document.querySelectorAll('.wave-bar').forEach(b => b.style.height = '6px');
                } else if (state === 'recording') {
                    micBtn.className = 'mic-btn recording';
                    micIcon.className = 'bi bi-stop-fill';
                    status.textContent = '<?= addslashes($textes['ecoute']) ?>';
                    btnStart.disabled = true;
                    btnStop.disabled = false;
                    btnRetry.style.display = 'none';
                    waveform.className = 'waveform recording';
                } else if (state === 'analyzing') {
                    micBtn.className = 'mic-btn';
                    micBtn.disabled = true;
                    status.textContent = '<?= addslashes($textes['analyse']) ?>';
                    btnStart.disabled = true;
                    btnStop.disabled = true;
                    waveform.className = 'waveform';
                } else if (state === 'done') {
                    micBtn.disabled = false;
                    btnStart.disabled = false;
                    btnStop.disabled = true;
                    btnRetry.style.display = 'flex';
                    status.textContent = '<?= addslashes($textes['btn_relancer']) ?>';
                }
            }

            function escHtml(s) {
                return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
            }
        </script>
</body>

</html>