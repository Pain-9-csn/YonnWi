<?php
// Variables injectées par CaptureAudioController::index()
$textes   = $textes   ?? [];
$xassidas = $xassidas ?? [];
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
<title><?= htmlspecialchars($textes['titre'] ?? 'Dictaphone') ?> — YoonWi</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="<?= $root ?>public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= $root ?>public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?= $root ?>public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
<style>
:root {
  --tl:  #1a8a8a;
  --tll: #26b5b5;
  --gd:  #c9a84c;
  --bg:  #080e14;
  --c1:  #0f1923;
  --c2:  #15222e;
  --txt: #dce8f0;
  --mt:  #7a94a8;
  --br:  rgba(26,138,138,.25);
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Outfit', sans-serif; background: var(--bg); color: var(--txt); min-height: 100vh; }
.yw-shell { display: flex; flex-direction: column; min-height: 100vh; padding-top: 70px; }
.yw-main  { flex: 1; }

/* hero */
.hero {
  padding: 2.5rem 1rem 2rem; text-align: center;
  background: linear-gradient(180deg, #0d1c2b 0%, var(--bg) 100%);
  border-bottom: 1px solid var(--br);
}
.hero h1 {
  font-size: 2rem; font-weight: 700;
  background: linear-gradient(135deg, var(--tll), #7ee8e8);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
  margin-bottom: .3rem;
}
.hero p { font-size: .85rem; color: var(--mt); }

/* main */
.voc-main { max-width: 920px; margin: 0 auto; padding: 2rem 1rem 3rem; }

/* ---- record block ---- */
.rec-block {
  background: var(--c1); border: 1px solid var(--br); border-radius: 20px;
  padding: 2rem 1.5rem; text-align: center; margin-bottom: 1.5rem;
  position: relative; overflow: hidden;
}
.rec-block::before {
  content: ''; position: absolute; inset: 0;
  background: radial-gradient(circle at 50% 0%, rgba(26,138,138,.06), transparent 70%);
  pointer-events: none;
}

/* ring */
.mic-ring {
  width: 160px; height: 160px; border-radius: 50%;
  background: var(--c2); border: 2px solid var(--br);
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 1.2rem;
  transition: border-color .3s, box-shadow .3s;
  position: relative;
}
.mic-ring.recording {
  border-color: var(--tll);
  animation: ring-pulse 1.2s ease-in-out infinite;
}
@keyframes ring-pulse {
  0%,100% { box-shadow: 0 0 0 0 rgba(26,138,138,.5); }
  50%      { box-shadow: 0 0 0 18px rgba(26,138,138,0); }
}
.mic-btn {
  width: 72px; height: 72px; border-radius: 50%; border: none;
  background: linear-gradient(135deg, var(--tl), var(--tll));
  color: #fff; font-size: 1.7rem; cursor: pointer;
  transition: all .25s; box-shadow: 0 4px 18px rgba(26,138,138,.4);
  display: flex; align-items: center; justify-content: center;
}
.mic-btn:hover   { transform: scale(1.06); }
.mic-btn.rec-on  { background: linear-gradient(135deg, #c0392b, #e74c3c); box-shadow: 0 4px 18px rgba(192,57,43,.5); }
.mic-btn:disabled { opacity: .5; cursor: wait; transform: none; }

/* waveform */
.wavef {
  display: flex; align-items: center; justify-content: center; gap: 3px;
  height: 36px; margin-bottom: 1rem;
}
.wbar { width: 4px; border-radius: 3px; background: var(--tl); height: 5px; transition: height .08s; }
.recording .wbar { animation: wwave .5s ease-in-out infinite alternate; }
.wbar:nth-child(2)  { animation-delay: .05s; }
.wbar:nth-child(3)  { animation-delay: .10s; }
.wbar:nth-child(4)  { animation-delay: .15s; }
.wbar:nth-child(5)  { animation-delay: .20s; }
.wbar:nth-child(6)  { animation-delay: .25s; }
.wbar:nth-child(7)  { animation-delay: .30s; }
.wbar:nth-child(8)  { animation-delay: .35s; }
.wbar:nth-child(9)  { animation-delay: .40s; }
.wbar:nth-child(10) { animation-delay: .45s; }
@keyframes wwave { from { height: 4px; } to { height: 28px; } }

.rec-timer  { font-size: 1.8rem; font-weight: 700; color: var(--tll); font-variant-numeric: tabular-nums; margin-bottom: .6rem; }
.rec-status { font-size: .85rem; color: var(--mt); min-height: 22px; margin-bottom: .9rem; }

/* action buttons */
.rec-actions { display: flex; gap: .75rem; justify-content: center; flex-wrap: wrap; }
.rbtn {
  padding: .6rem 1.3rem; border-radius: 11px; border: none;
  font-family: 'Outfit', sans-serif; font-size: .85rem; font-weight: 600;
  cursor: pointer; transition: all .2s;
  display: flex; align-items: center; gap: .45rem;
}
.rbtn-start { background: linear-gradient(135deg, var(--tl), var(--tll)); color: #fff; box-shadow: 0 3px 12px rgba(26,138,138,.35); }
.rbtn-stop  { background: rgba(192,57,43,.12); color: #e74c3c; border: 1px solid rgba(192,57,43,.28); }
.rbtn-retry { background: var(--c2); color: var(--txt); border: 1px solid var(--br); }
.rbtn:hover:not(:disabled) { transform: translateY(-1px); }
.rbtn:disabled { opacity: .4; cursor: not-allowed; transform: none; }

/* result */
.result-box {
  background: var(--c1); border: 1px solid var(--br); border-radius: 16px;
  padding: 1.4rem; margin-bottom: 1.5rem;
  display: none;
}
.result-box.show { display: block; animation: fadeup .3s ease; }
@keyframes fadeup { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

.result-found {
  display: flex; gap: 1rem; align-items: center;
  background: var(--c2); border-radius: 12px; padding: 1rem;
}
.result-thumb {
  width: 64px; height: 64px; border-radius: 10px; flex-shrink: 0;
  background: var(--c1); border: 1px solid var(--br);
  display: flex; align-items: center; justify-content: center; font-size: 1.8rem; overflow: hidden;
}
.result-thumb img { width: 100%; height: 100%; object-fit: cover; border-radius: 10px; }
.result-info h4 { font-size: 1rem; font-weight: 600; margin-bottom: .15rem; }
.result-info p  { font-size: .78rem; color: var(--mt); }
.result-playbtn {
  margin-left: auto; flex-shrink: 0;
  width: 38px; height: 38px; border-radius: 50%;
  background: linear-gradient(135deg, var(--tl), var(--tll));
  border: none; color: #fff; font-size: 1rem;
  cursor: pointer; display: flex; align-items: center; justify-content: center;
}
.result-nope { text-align: center; padding: .5rem; color: var(--mt); }
.result-nope i { font-size: 1.8rem; display: block; color: var(--gd); margin-bottom: .4rem; }

/* tips */
.tips-grid {
  display: grid; grid-template-columns: repeat(2, 1fr); gap: .85rem; margin-bottom: 1.75rem;
}
@media (max-width: 560px) { .tips-grid { grid-template-columns: 1fr; } }
.tip {
  background: var(--c1); border: 1px solid var(--br); border-radius: 12px;
  padding: .9rem; display: flex; align-items: flex-start; gap: .65rem;
}
.tip i  { color: var(--tll); font-size: 1.1rem; flex-shrink: 0; margin-top: 2px; }
.tip p  { font-size: .79rem; color: var(--mt); margin: 0; }

/* section title */
.sec-title {
  font-size: .92rem; font-weight: 600; margin-bottom: 1rem;
  display: flex; align-items: center; gap: .5rem; color: var(--txt);
}
.sec-title::after { content: ''; flex: 1; height: 1px; background: var(--br); }

/* popular grid */
.pop-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(185px,1fr)); gap: .85rem; }
.pop-card {
  background: var(--c1); border: 1px solid var(--br); border-radius: 13px;
  padding: .9rem; cursor: pointer; transition: all .2s;
  display: flex; flex-direction: column; gap: .5rem;
}
.pop-card:hover { border-color: var(--tl); transform: translateY(-2px); box-shadow: 0 5px 18px rgba(26,138,138,.14); }
.pop-thumb {
  width: 100%; height: 72px; border-radius: 9px;
  background: var(--c2); overflow: hidden;
  display: flex; align-items: center; justify-content: center; font-size: 1.7rem;
}
.pop-thumb img { width: 100%; height: 100%; object-fit: cover; }
.pop-card h5 { font-size: .84rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0; }
.pop-card p  { font-size: .73rem; color: var(--mt); margin: 0; }
.pop-ecoutes { font-size: .7rem; color: var(--tll); }
</style>
</head>
<body>
<div class="yw-shell">

<?php
$menuPath = __DIR__ . '/../../../../view/sections/vitrine/menu.php';
if (file_exists($menuPath)) require_once $menuPath;
?>

<main class="yw-main">

  <!-- hero -->
  <section class="hero">
    <h1><?= htmlspecialchars($textes['titre'] ?? 'Reconnaissance Vocale') ?></h1>
    <p><?= htmlspecialchars($textes['sous_titre'] ?? 'Fredonnez un Xassida pour l\'identifier') ?></p>
  </section>

  <div class="voc-main">

    <!-- ====== BLOC ENREGISTREMENT ====== -->
    <div class="rec-block" id="recBlock">

      <div class="mic-ring" id="micRing">
        <button class="mic-btn" id="micBtn" onclick="toggleRec()">
          <i class="bi bi-mic-fill" id="micIcon"></i>
        </button>
      </div>

      <div class="wavef" id="wavef">
        <?php for ($i = 0; $i < 12; $i++): ?><div class="wbar"></div><?php endfor; ?>
      </div>

      <div class="rec-timer"  id="recTimer">0:00</div>
      <div class="rec-status" id="recStatus"><?= htmlspecialchars($textes['btn_ecouter'] ?? 'Commencer') ?></div>

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

    <!-- ====== RÉSULTAT ====== -->
    <div class="result-box" id="resultBox">
      <div id="resultInner"></div>
    </div>

    <!-- ====== CONSEILS ====== -->
    <div class="tips-grid">
      <div class="tip"><i class="bi bi-music-note-beamed"></i><p><?= htmlspecialchars($textes['conseil1'] ?? 'Fredonnez clairement au moins 5 secondes') ?></p></div>
      <div class="tip"><i class="bi bi-volume-mute"></i>      <p><?= htmlspecialchars($textes['conseil2'] ?? 'Réduisez les bruits de fond') ?></p></div>
      <div class="tip"><i class="bi bi-phone"></i>            <p><?= htmlspecialchars($textes['conseil3'] ?? 'Tenez l\'appareil près de la source') ?></p></div>
      <div class="tip"><i class="bi bi-speedometer2"></i>     <p><?= htmlspecialchars($textes['conseil4'] ?? 'Les récitations lentes sont mieux reconnues') ?></p></div>
    </div>

    <!-- ====== POPULAIRES ====== -->
    <div class="sec-title">
      <i class="bi bi-fire"></i>
      <?= htmlspecialchars($textes['populaires'] ?? 'Xassidas populaires') ?>
    </div>

    <div class="pop-grid">
      <?php if (!empty($xassidas)): ?>
        <?php foreach ($xassidas as $x): ?>
        <div class="pop-card" onclick="lireAudio('<?= htmlspecialchars($x['audio_url'] ?? '', ENT_QUOTES) ?>')">
          <div class="pop-thumb">
            <?php if (!empty($x['image_url'])): ?>
              <img src="<?= htmlspecialchars($x['image_url']) ?>" alt="<?= htmlspecialchars($x['titre'] ?? '') ?>">
            <?php else: ?>
              🎵
            <?php endif; ?>
          </div>
          <h5><?= htmlspecialchars($x['titre'] ?? 'Xassida') ?></h5>
          <p><?= htmlspecialchars($x['auteur'] ?? '') ?></p>
          <span class="pop-ecoutes">
            <i class="bi bi-ear"></i>
            <?= (int)($x['nb_ecoutes'] ?? 0) ?>
            <?= htmlspecialchars($textes['ecouter'] ?? 'écoutes') ?>
          </span>
        </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="grid-column:1/-1;text-align:center;padding:2rem;color:var(--mt);font-size:.85rem;">
          Aucun Xassida disponible pour l'instant.
        </p>
      <?php endif; ?>
    </div>

  </div><!-- end voc-main -->
</main>

<?php
$footerPath = __DIR__ . '/../../../../view/sections/vitrine/footer.php';
if (file_exists($footerPath)) require_once $footerPath;
?>

</div><!-- end yw-shell -->

<audio id="bgAudio" preload="none"></audio>

<script>
/* ============================================================
   ÉTAT
   ============================================================ */
const AJAX_URL    = '<?= $root ?>index.php?action=ajax_identifier';
let mediaRecorder = null;
let audioChunks   = [];
let timerInt      = null;
let seconds       = 0;
let isRec         = false;
let audioCtx      = null;
let analyser      = null;
let animId        = null;

/* ============================================================
   TOGGLE
   ============================================================ */
function toggleRec() {
  isRec ? arreter() : demarrer();
}

/* ============================================================
   DÉMARRER
   ============================================================ */
function demarrer() {
  if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
    alert('Microphone non disponible sur ce navigateur.');
    return;
  }
  navigator.mediaDevices.getUserMedia({ audio: true })
    .then(stream => {
      audioCtx = new (window.AudioContext || window.webkitAudioContext)();
      analyser = audioCtx.createAnalyser();
      analyser.fftSize = 64;
      audioCtx.createMediaStreamSource(stream).connect(analyser);

      mediaRecorder = new MediaRecorder(stream);
      audioChunks   = [];
      mediaRecorder.ondataavailable = e => { if (e.data.size > 0) audioChunks.push(e.data); };
      mediaRecorder.onstop = analyserAudio;
      mediaRecorder.start(100);

      isRec   = true;
      seconds = 0;
      setUI('rec');
      timerInt = setInterval(() => {
        seconds++;
        const m = Math.floor(seconds / 60);
        const s = seconds % 60;
        document.getElementById('recTimer').textContent = m + ':' + String(s).padStart(2, '0');
      }, 1000);
      animerVagues();
    })
    .catch(() => alert('Accès au microphone refusé ou indisponible.'));
}

/* ============================================================
   ARRÊTER
   ============================================================ */
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

/* ============================================================
   RÉINIT
   ============================================================ */
function reinit() {
  setUI('idle');
  document.getElementById('recTimer').textContent = '0:00';
  document.getElementById('resultBox').classList.remove('show');
  seconds = 0;
}

/* ============================================================
   ANIMATION VAGUES
   ============================================================ */
function animerVagues() {
  if (!analyser) return;
  const bars = document.querySelectorAll('.wbar');
  const data = new Uint8Array(analyser.frequencyBinCount);
  function draw() {
    animId = requestAnimationFrame(draw);
    analyser.getByteFrequencyData(data);
    bars.forEach((bar, i) => {
      const v = data[i * 2] || 0;
      bar.style.height = Math.max(4, v * 0.22) + 'px';
    });
  }
  draw();
}

/* ============================================================
   ANALYSER AUDIO + REQUÊTE AJAX
   ============================================================ */
function analyserAudio() {
  if (!audioChunks.length) { reinit(); return; }

  const blob   = new Blob(audioChunks, { type: 'audio/webm' });
  const reader = new FileReader();

  reader.onload = () => {
    const b64 = reader.result.split(',')[1] || '';
    const fp  = genFingerprint(b64, seconds);

    const fd = new FormData();
    fd.append('fingerprint', fp);
    fd.append('duree', seconds);

    fetch(AJAX_URL, { method: 'POST', body: fd })
      .then(r => r.json())
      .then(data => { afficherResultat(data); setUI('done'); })
      .catch(() => { afficherResultat({ success: false }); setUI('done'); });
  };
  reader.readAsDataURL(blob);
}

/* ============================================================
   FINGERPRINT SIMPLE (côté client)
   ============================================================ */
function genFingerprint(b64, dur) {
  let h = 5381;
  const sample = b64.substring(0, 512);
  for (let i = 0; i < sample.length; i++) {
    h = ((h << 5) + h) ^ sample.charCodeAt(i);
    h = h >>> 0;
  }
  return h.toString(16).padStart(8, '0') + '_' + b64.length + '_' + dur;
}

/* ============================================================
   AFFICHER RÉSULTAT
   ============================================================ */
function afficherResultat(data) {
  const box   = document.getElementById('resultBox');
  const inner = document.getElementById('resultInner');

  if (data.success && data.trouve && data.xassida) {
    const x = data.xassida;
    const img = x.image_url
      ? '<img src="' + esc(x.image_url) + '" alt="">'
      : '🎵';
    const playBtn = x.audio_url
      ? '<button class="result-playbtn" onclick="lireAudio(\'' + esc(x.audio_url) + '\')"><i class="bi bi-play-fill"></i></button>'
      : '';
    inner.innerHTML =
      '<div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.07em;color:var(--tll);margin-bottom:.7rem">✅ <?= addslashes($textes['trouve'] ?? 'Xassida identifié') ?></div>' +
      '<div class="result-found">' +
        '<div class="result-thumb">' + img + '</div>' +
        '<div class="result-info">' +
          '<h4>' + esc(x.titre || '') + '</h4>' +
          '<p>' + esc(x.auteur || '') + '</p>' +
        '</div>' +
        playBtn +
      '</div>';
  } else {
    inner.innerHTML =
      '<div class="result-nope">' +
        '<i class="bi bi-question-circle"></i>' +
        '<?= addslashes($textes['non_trouve'] ?? 'Non reconnu') ?><br>' +
        '<small style="font-size:.77rem">' + esc(data.message || 'Réessayez en fredonnant plus longtemps.') + '</small>' +
      '</div>';
  }
  box.classList.add('show');
}

/* ============================================================
   LECTURE AUDIO POPULAIRE
   ============================================================ */
function lireAudio(url) {
  if (!url) return;
  const a = document.getElementById('bgAudio');
  a.src = url;
  a.play().catch(() => {});
}

/* ============================================================
   GESTION UI
   ============================================================ */
function setUI(state) {
  const ring     = document.getElementById('micRing');
  const btn      = document.getElementById('micBtn');
  const icon     = document.getElementById('micIcon');
  const status   = document.getElementById('recStatus');
  const wavef    = document.getElementById('wavef');
  const btnStart = document.getElementById('btnStart');
  const btnStop  = document.getElementById('btnStop');
  const btnRetry = document.getElementById('btnRetry');
  const bars     = document.querySelectorAll('.wbar');

  ring.classList.toggle('recording', state === 'rec');
  wavef.classList.toggle('recording', state === 'rec');

  if (state === 'idle') {
    btn.className    = 'mic-btn';
    btn.disabled     = false;
    icon.className   = 'bi bi-mic-fill';
    status.textContent = '<?= addslashes($textes['btn_ecouter'] ?? 'Commencer') ?>';
    btnStart.disabled  = false;
    btnStop.disabled   = true;
    btnRetry.style.display = 'none';
    bars.forEach(b => b.style.height = '5px');
  } else if (state === 'rec') {
    btn.className    = 'mic-btn rec-on';
    icon.className   = 'bi bi-stop-fill';
    status.textContent = '<?= addslashes($textes['ecoute'] ?? 'Écoute en cours…') ?>';
    btnStart.disabled  = true;
    btnStop.disabled   = false;
    btnRetry.style.display = 'none';
  } else if (state === 'analyse') {
    btn.className    = 'mic-btn';
    btn.disabled     = true;
    icon.className   = 'bi bi-hourglass-split';
    status.textContent = '<?= addslashes($textes['analyse'] ?? 'Analyse…') ?>';
    btnStart.disabled  = true;
    btnStop.disabled   = true;
  } else if (state === 'done') {
    btn.disabled     = false;
    icon.className   = 'bi bi-mic-fill';
    status.textContent = '';
    btnStart.disabled  = false;
    btnStop.disabled   = true;
    btnRetry.style.display = 'flex';
  }
}

/* Escape HTML */
function esc(s) {
  return String(s || '')
    .replace(/&/g,'&amp;').replace(/</g,'&lt;')
    .replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}
</script>
</body>
</html>