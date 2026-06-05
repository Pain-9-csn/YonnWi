<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coran — YoonWi</title>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Scheherazade+New:wght@400;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="../../../../public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../../public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../../../../public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
<style>
:root{
  --emerald:#1a6b50;--emerald-l:#25957a;
  --gold:#c9a84c;--gold-l:#e8c97a;
  --bg:#07100e;--card:#0d1f1a;--card2:#122b24;
  --text:#d8ede8;--muted:#6a9a8a;--border:rgba(26,107,80,0.3);
}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Outfit',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
.page-wrapper{padding-top:80px}

/* Hero */
.coran-hero{
  padding:2.5rem 0 2rem;
  background:linear-gradient(180deg,#0b1f18 0%,var(--bg) 100%);
  border-bottom:1px solid var(--border);
  text-align:center;
}
.coran-hero .bismillah{
  font-family:'Scheherazade New',serif;
  font-size:2rem;color:var(--gold-l);
  direction:rtl;margin-bottom:0.3rem;
}
.coran-hero h1{
  font-size:2.2rem;font-weight:600;
  background:linear-gradient(135deg,var(--emerald-l),#8de8c8);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
  margin-bottom:0.3rem;
}
.coran-hero p{color:var(--muted);font-size:0.92rem;}

/* Layout */
.coran-layout{
  max-width:1100px;margin:0 auto;
  padding:2rem 1rem 4rem;
  display:grid;
  grid-template-columns:300px 1fr;
  gap:1.5rem;
  align-items:start;
}
@media(max-width:768px){.coran-layout{grid-template-columns:1fr;}}

/* Sidebar */
.sourates-panel{
  background:var(--card);border:1px solid var(--border);border-radius:18px;
  overflow:hidden;position:sticky;top:90px;max-height:calc(100vh - 110px);
  display:flex;flex-direction:column;
}
.sourates-search{
  padding:1rem;border-bottom:1px solid var(--border);
}
.sourates-search input{
  width:100%;background:var(--card2);border:1px solid var(--border);
  color:var(--text);border-radius:10px;padding:0.55rem 0.9rem;
  font-family:'Outfit',sans-serif;font-size:0.85rem;outline:none;
}
.sourates-search input:focus{border-color:var(--emerald-l);}
.sourates-search input::placeholder{color:var(--muted);}
.sourates-list{overflow-y:auto;flex:1;}
.sourate-item{
  display:flex;align-items:center;gap:0.75rem;
  padding:0.7rem 1rem;cursor:pointer;
  border-bottom:1px solid rgba(26,107,80,0.1);
  transition:background 0.15s;
}
.sourate-item:hover{background:var(--card2);}
.sourate-item.active{background:rgba(26,107,80,0.2);border-left:3px solid var(--emerald-l);}
.sourate-num{
  width:30px;height:30px;border-radius:8px;
  background:var(--card2);border:1px solid var(--border);
  display:flex;align-items:center;justify-content:center;
  font-size:0.72rem;font-weight:600;color:var(--emerald-l);flex-shrink:0;
}
.sourate-item.active .sourate-num{background:var(--emerald);border-color:var(--emerald-l);color:#fff;}
.sourate-name-ar{font-family:'Amiri',serif;font-size:1rem;color:var(--gold-l);direction:rtl;}
.sourate-name-en{font-size:0.75rem;color:var(--muted);}
.sourate-ayahs{font-size:0.7rem;color:var(--muted);margin-left:auto;flex-shrink:0;}

/* Reader */
.reader-panel{
  background:var(--card);border:1px solid var(--border);border-radius:18px;
  overflow:hidden;
}
.reader-header{
  padding:1.2rem 1.5rem;border-bottom:1px solid var(--border);
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.8rem;
}
.reader-header-left h2{font-family:'Amiri',serif;font-size:1.6rem;color:var(--gold-l);direction:rtl;}
.reader-header-left p{font-size:0.8rem;color:var(--muted);}
.reader-controls{display:flex;gap:0.5rem;}
.ctrl-btn{
  width:36px;height:36px;border-radius:10px;
  border:1px solid var(--border);background:var(--card2);
  color:var(--text);cursor:pointer;font-size:1rem;
  display:flex;align-items:center;justify-content:center;
  transition:all 0.2s;
}
.ctrl-btn:hover{background:var(--emerald);border-color:var(--emerald-l);}
.ctrl-btn.active{background:var(--emerald);border-color:var(--emerald-l);color:#fff;}

/* Loading / empty */
.reader-loading{
  padding:4rem;text-align:center;color:var(--muted);
}
@keyframes spin{to{transform:rotate(360deg)}}
.loader-spin{
  width:36px;height:36px;border:3px solid var(--border);
  border-top-color:var(--emerald-l);border-radius:50%;
  animation:spin 0.8s linear infinite;margin:0 auto 1rem;
}

/* Versets */
.versets-body{padding:1.5rem;display:flex;flex-direction:column;gap:1.2rem;}
.verset-item{
  background:var(--card2);border:1px solid var(--border);border-radius:14px;
  overflow:hidden;transition:border-color 0.2s;
}
.verset-item:hover{border-color:rgba(26,107,80,0.5);}
.verset-item.playing{border-color:var(--emerald-l);box-shadow:0 0 12px rgba(26,107,80,0.2);}
.verset-header{
  display:flex;align-items:center;justify-content:space-between;
  padding:0.6rem 1rem;border-bottom:1px solid rgba(26,107,80,0.1);
}
.verset-num{
  width:28px;height:28px;border-radius:50%;
  background:var(--emerald);color:#fff;
  font-size:0.72rem;font-weight:700;
  display:flex;align-items:center;justify-content:center;
}
.verset-play-btn{
  background:none;border:none;cursor:pointer;
  color:var(--muted);font-size:1rem;padding:0.2rem 0.5rem;
  border-radius:6px;transition:all 0.2s;
}
.verset-play-btn:hover{color:var(--emerald-l);background:rgba(26,107,80,0.1);}
.verset-ar{
  font-family:'Scheherazade New',serif;
  font-size:1.6rem;line-height:2.2;
  text-align:right;direction:rtl;
  color:var(--text);
  padding:1rem 1.2rem 0.6rem;
}
.verset-fr{
  font-size:0.85rem;color:var(--muted);
  padding:0.3rem 1.2rem 1rem;
  line-height:1.6;
  border-top:1px solid rgba(26,107,80,0.08);
}
.show-fr .verset-fr{display:block;}
.hide-fr .verset-fr{display:none;}

/* Progression bar */
.progress-banner{
  padding:0.75rem 1.5rem;background:rgba(201,168,76,0.07);
  border-top:1px solid var(--border);
  display:flex;align-items:center;gap:0.75rem;font-size:0.8rem;color:var(--muted);
}
.progress-banner i{color:var(--gold);}
</style>
</head>
<body>
<div class="page-wrapper">

<?php if (file_exists(__DIR__ . '/../../../../view/sections/vitrine/menu.php')) {
    require_once __DIR__ . '/../../../../view/sections/vitrine/menu.php';
} ?>

<!-- Hero -->
<section class="coran-hero">
  <div class="bismillah">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</div>
  <h1>القرآن الكريم</h1>
  <p>Lecture du Saint Coran avec traduction</p>
</section>

<!-- Layout -->
<div class="coran-layout">

  <!-- Sidebar sourates -->
  <aside class="sourates-panel">
    <div class="sourates-search">
      <input type="text" id="searchSourate" placeholder="Rechercher une sourate…" oninput="filterSourates()">
    </div>
    <div class="sourates-list" id="souratesList">
      <?php if (!empty($listeSourates)): foreach ($listeSourates as $s): ?>
      <div class="sourate-item <?= (int)($s['number']??0)===1?'active':'' ?>"
           data-num="<?= (int)($s['number']??0) ?>"
           data-name="<?= htmlspecialchars(strtolower(($s['englishName']??'').' '.($s['name']??''))) ?>"
           onclick="chargerSourate(<?= (int)($s['number']??0) ?>, this)">
        <div class="sourate-num"><?= (int)($s['number']??0) ?></div>
        <div>
          <div class="sourate-name-ar"><?= htmlspecialchars($s['name'] ?? '') ?></div>
          <div class="sourate-name-en"><?= htmlspecialchars($s['englishName'] ?? '') ?></div>
        </div>
        <div class="sourate-ayahs"><?= (int)($s['numberOfAyahs']??0) ?>v</div>
      </div>
      <?php endforeach; else: ?>
      <p style="color:var(--muted);padding:2rem;text-align:center;">Liste indisponible</p>
      <?php endif; ?>
    </div>
  </aside>

  <!-- Reader -->
  <section class="reader-panel">
    <div class="reader-header">
      <div class="reader-header-left">
        <h2 id="headerAr">الفاتحة</h2>
        <p id="headerEn">Al-Fatiha · 7 versets</p>
      </div>
      <div class="reader-controls">
        <button class="ctrl-btn active" id="btnFr" onclick="toggleTrad()" title="Traduction">fr</button>
        <button class="ctrl-btn" id="btnAutoplay" onclick="toggleAutoplay()" title="Lecture auto"><i class="bi bi-skip-end"></i></button>
      </div>
    </div>

    <div id="readerContent">
      <div class="reader-loading">
        <div class="loader-spin"></div>
        Chargement…
      </div>
    </div>

    <div class="progress-banner" id="progressBanner" style="display:none">
      <i class="bi bi-bookmark-check"></i>
      <span id="progressText"></span>
    </div>
  </section>

</div><!-- end layout -->

<?php if (file_exists(__DIR__ . '/../../../../view/sections/vitrine/footer.php')) {
    require_once __DIR__ . '/../../../../view/sections/vitrine/footer.php';
} ?>

<audio id="audioPlayer" style="display:none"></audio>

<script>
const BASE      = '../../../../index.php';
let showTrad    = true;
let autoplay    = false;
let currentSura = 1;
let versetsList = [];
let playingIdx  = -1;

<?php if (!empty($progression)): ?>
const savedSura = <?= (int)($progression['sourate_num']??1) ?>;
const savedVers = <?= (int)($progression['verset_num']??1) ?>;
<?php else: ?>
const savedSura = 1, savedVers = 1;
<?php endif; ?>

/* ---- Init ---- */
document.addEventListener('DOMContentLoaded', () => {
  chargerSourate(savedSura, document.querySelector(`[data-num="${savedSura}"]`));
  if (savedVers > 1) {
    setTimeout(() => {
      const el = document.querySelector(`[data-verset="${savedVers}"]`);
      if (el) el.scrollIntoView({behavior:'smooth',block:'center'});
    }, 1200);
  }
});

/* ---- Charger une sourate ---- */
function chargerSourate(num, el) {
  currentSura = num;
  document.querySelectorAll('.sourate-item').forEach(i => i.classList.remove('active'));
  if (el) el.classList.add('active');

  document.getElementById('readerContent').innerHTML =
    `<div class="reader-loading"><div class="loader-spin"></div>Chargement…</div>`;

  fetch(`${BASE}?action=ajax_versets&sourate=${num}`)
    .then(r => r.json())
    .then(data => {
      if (data.success && data.versets) {
        versetsList = data.versets;
        renderVersets(data.versets, data.meta || {});
        saveProgress(num, 1);
      } else {
        document.getElementById('readerContent').innerHTML =
          `<div class="reader-loading">Erreur de chargement.</div>`;
      }
    })
    .catch(() => {
      document.getElementById('readerContent').innerHTML =
        `<div class="reader-loading">Erreur réseau.</div>`;
    });
}

function renderVersets(versets, meta) {
  document.getElementById('headerAr').textContent = meta.nameAr || '';
  document.getElementById('headerEn').textContent =
    `${meta.nameEn || ''} · ${versets.length} versets`;

  const trad = showTrad ? 'show-fr' : 'hide-fr';
  const html = versets.map((v,i) => `
    <div class="verset-item ${trad}" data-verset="${v.number}" data-audio="${v.audio||''}">
      <div class="verset-header">
        <div class="verset-num">${v.number}</div>
        <button class="verset-play-btn" onclick="playVerset(${i})">
          <i class="bi bi-play-circle" id="playIcon${i}"></i>
        </button>
      </div>
      <div class="verset-ar">${v.texteAr || ''}</div>
      <div class="verset-fr">${v.texteFr || ''}</div>
    </div>`).join('');

  document.getElementById('readerContent').innerHTML =
    `<div class="versets-body">${html}</div>`;
}

/* ---- Lecture audio ---- */
const player = document.getElementById('audioPlayer');

function playVerset(idx) {
  const v = versetsList[idx];
  if (!v || !v.audio) return;

  if (playingIdx === idx) {
    player.paused ? player.play() : player.pause();
    return;
  }

  if (playingIdx >= 0) {
    const old = document.getElementById(`playIcon${playingIdx}`);
    if (old) old.className = 'bi bi-play-circle';
    document.querySelector(`[data-verset="${versetsList[playingIdx].number}"]`)
      ?.classList.remove('playing');
  }

  playingIdx = idx;
  player.src = v.audio;
  player.play().catch(()=>{});
  document.getElementById(`playIcon${idx}`).className = 'bi bi-pause-circle';
  document.querySelector(`[data-verset="${v.number}"]`).classList.add('playing');
  saveProgress(currentSura, v.number);

  player.onended = () => {
    document.getElementById(`playIcon${idx}`).className = 'bi bi-play-circle';
    document.querySelector(`[data-verset="${v.number}"]`)?.classList.remove('playing');
    playingIdx = -1;
    if (autoplay && idx + 1 < versetsList.length) playVerset(idx + 1);
  };
}

/* ---- Toggles ---- */
function toggleTrad() {
  showTrad = !showTrad;
  document.getElementById('btnFr').classList.toggle('active', showTrad);
  document.querySelectorAll('.verset-item').forEach(el => {
    el.classList.toggle('show-fr', showTrad);
    el.classList.toggle('hide-fr', !showTrad);
  });
}

function toggleAutoplay() {
  autoplay = !autoplay;
  document.getElementById('btnAutoplay').classList.toggle('active', autoplay);
}

/* ---- Progression ---- */
function saveProgress(sura, verset) {
  <?php if (!empty($userId)): ?>
  fetch(`${BASE}?action=ajax_progression_coran`, {
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:`sourate=${sura}&verset=${verset}`
  });
  const banner = document.getElementById('progressBanner');
  document.getElementById('progressText').textContent =
    `Progression sauvegardée : Sourate ${sura}, verset ${verset}`;
  banner.style.display = 'flex';
  setTimeout(()=>banner.style.display='none', 2500);
  <?php endif; ?>
}

/* ---- Recherche sourates ---- */
function filterSourates() {
  const q = document.getElementById('searchSourate').value.toLowerCase();
  document.querySelectorAll('.sourate-item').forEach(el => {
    el.style.display = el.dataset.name?.includes(q) ? '' : 'none';
  });
}
</script>
</body>
</html>