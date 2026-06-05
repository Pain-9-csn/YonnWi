<!DOCTYPE html>
<html lang="<?= htmlspecialchars($traduction['dir'] === 'rtl' ? 'ar' : 'fr') ?>" dir="<?= $traduction['dir'] ?>">
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
  --gold: #c9a84c;
  --gold-light: #e8c97a;
  --green: #2d7a4f;
  --green-light: #3da066;
  --bg-dark: #0d1117;
  --bg-card: #161b22;
  --bg-card2: #1c2330;
  --text: #e6edf3;
  --text-muted: #8b949e;
  --border: rgba(201,168,76,0.2);
}
* { margin:0; padding:0; box-sizing:border-box; }
body {
  font-family:'Outfit',sans-serif;
  background:var(--bg-dark);
  color:var(--text);
  min-height:100vh;
}
.page-wrapper { padding-top:80px; min-height:100vh; }

/* Hero banner */
.qibla-hero {
  background: linear-gradient(135deg, #0d1117 0%, #1a2332 50%, #0d1117 100%);
  border-bottom: 1px solid var(--border);
  padding: 3rem 0 2rem;
  text-align:center;
}
.qibla-hero .bismillah {
  font-family:'Amiri',serif;
  font-size:1.5rem;
  color:var(--gold-light);
  margin-bottom:0.3rem;
  direction:rtl;
}
.qibla-hero .verset-ref {
  font-size:0.8rem;
  color:var(--text-muted);
  margin-bottom:1.5rem;
}
.qibla-hero h1 {
  font-size:2.5rem;
  font-weight:700;
  background:linear-gradient(135deg,var(--gold),var(--gold-light));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:0.5rem;
}
.qibla-hero p {
  color:var(--text-muted);
  font-size:1rem;
}

/* Main layout */
.qibla-main {
  max-width:900px;
  margin:0 auto;
  padding:2.5rem 1rem 4rem;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:2rem;
  align-items:start;
}
@media(max-width:700px){ .qibla-main{ grid-template-columns:1fr; } }

/* Compass */
.compass-card {
  background:var(--bg-card);
  border:1px solid var(--border);
  border-radius:20px;
  padding:2rem;
  display:flex;
  flex-direction:column;
  align-items:center;
  gap:1.5rem;
}
.compass-wrap {
  position:relative;
  width:240px;
  height:240px;
}
.compass-ring {
  width:240px;
  height:240px;
  border-radius:50%;
  background: conic-gradient(from 0deg, #1c2330, #2a3342, #1c2330);
  border:2px solid var(--border);
  position:relative;
  display:flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 0 30px rgba(201,168,76,0.08), inset 0 0 20px rgba(0,0,0,0.4);
  transition:transform 0.6s cubic-bezier(0.34,1.56,0.64,1);
}
.compass-ring::before {
  content:'';
  position:absolute;
  inset:8px;
  border-radius:50%;
  border:1px solid rgba(201,168,76,0.15);
}
/* Cardinal points */
.cardinal {
  position:absolute;
  font-size:0.75rem;
  font-weight:600;
  color:var(--text-muted);
  letter-spacing:0.05em;
}
.cardinal.n { top:12px; left:50%; transform:translateX(-50%); color:var(--gold); }
.cardinal.s { bottom:12px; left:50%; transform:translateX(-50%); }
.cardinal.e { right:12px; top:50%; transform:translateY(-50%); }
.cardinal.w { left:12px; top:50%; transform:translateY(-50%); }

/* Kaaba arrow */
.kaaba-arrow {
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%) rotate(0deg);
  transition:transform 1s cubic-bezier(0.34,1.56,0.64,1);
  display:flex;
  flex-direction:column;
  align-items:center;
  width:8px;
}
.arrow-body {
  width:4px;
  height:70px;
  background:linear-gradient(to top,var(--gold),var(--gold-light));
  border-radius:4px 4px 0 0;
  margin-bottom:-1px;
}
.arrow-head {
  width:0;
  height:0;
  border-left:10px solid transparent;
  border-right:10px solid transparent;
  border-bottom:18px solid var(--gold-light);
}
.arrow-tail {
  width:4px;
  height:40px;
  background:rgba(201,168,76,0.3);
  border-radius:0 0 4px 4px;
}
/* Center dot */
.center-dot {
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  width:14px;
  height:14px;
  border-radius:50%;
  background:var(--gold);
  box-shadow:0 0 10px var(--gold);
  z-index:2;
}

/* Kaaba icon in center */
.compass-kaaba-icon {
  position:absolute;
  width:34px;
  height:34px;
  background:var(--bg-dark);
  border:2px solid var(--gold);
  border-radius:6px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:1.1rem;
  z-index:3;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
  box-shadow:0 0 12px rgba(201,168,76,0.3);
}

/* Stats row */
.compass-stats {
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:1rem;
  width:100%;
}
.stat-chip {
  background:var(--bg-card2);
  border:1px solid var(--border);
  border-radius:12px;
  padding:0.9rem 1rem;
  text-align:center;
}
.stat-chip .label { font-size:0.7rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.06em; }
.stat-chip .value { font-size:1.4rem; font-weight:700; color:var(--gold-light); }
.stat-chip .unit  { font-size:0.75rem; color:var(--text-muted); }

/* Right panel */
.info-card {
  background:var(--bg-card);
  border:1px solid var(--border);
  border-radius:20px;
  padding:1.8rem;
  display:flex;
  flex-direction:column;
  gap:1.5rem;
}
.locate-btn {
  width:100%;
  padding:0.9rem;
  background:linear-gradient(135deg,var(--green),var(--green-light));
  border:none;
  border-radius:14px;
  color:#fff;
  font-family:'Outfit',sans-serif;
  font-size:1rem;
  font-weight:600;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.6rem;
  transition:all 0.25s;
  box-shadow:0 4px 16px rgba(45,122,79,0.3);
}
.locate-btn:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(45,122,79,0.4); }
.locate-btn:disabled { opacity:0.6; cursor:wait; }

.status-box {
  padding:1rem;
  border-radius:12px;
  border:1px solid var(--border);
  background:var(--bg-card2);
  font-size:0.85rem;
  color:var(--text-muted);
  text-align:center;
  min-height:48px;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:0.5rem;
}
.status-box.success { border-color:rgba(61,160,102,0.4); color:#3da066; background:rgba(45,122,79,0.1); }
.status-box.error   { border-color:rgba(240,80,80,0.4);  color:#f05050; background:rgba(240,80,80,0.08); }

.coords-block { font-size:0.8rem; color:var(--text-muted); }
.coords-block span { color:var(--text); font-weight:500; }

.tips-title { font-size:0.75rem; text-transform:uppercase; letter-spacing:0.07em; color:var(--text-muted); }
.tips-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.6rem; }
.tips-list li {
  display:flex;
  align-items:flex-start;
  gap:0.6rem;
  font-size:0.82rem;
  color:var(--text-muted);
  padding:0.55rem 0.75rem;
  background:var(--bg-card2);
  border-radius:10px;
  border-left:2px solid var(--gold);
}
.tips-list li i { color:var(--gold); flex-shrink:0; margin-top:2px; }

/* Spinner */
@keyframes spin{to{transform:rotate(360deg)}}
.spin { animation:spin 1s linear infinite; display:inline-block; }

/* Pulse animation for active state */
@keyframes pulse-gold {
  0%,100% { box-shadow:0 0 20px rgba(201,168,76,0.1); }
  50%      { box-shadow:0 0 40px rgba(201,168,76,0.3); }
}
.compass-active .compass-ring { animation:pulse-gold 2s ease-in-out infinite; }
</style>
</head>
<body>
<div class="page-wrapper">

<?php if (file_exists(__DIR__ . '/../../../../view/sections/vitrine/menu.php')) {
    require_once __DIR__ . '/../../../../view/sections/vitrine/menu.php';
} ?>

<!-- Hero -->
<section class="qibla-hero">
  <div class="bismillah"><?= htmlspecialchars($textes['bismillah']) ?></div>
  <div class="verset-ref"><?= htmlspecialchars($textes['verset_ref']) ?></div>
  <h1><?= htmlspecialchars($textes['titre']) ?></h1>
  <p><?= htmlspecialchars($textes['sous_titre']) ?></p>
</section>

<!-- Main -->
<div class="qibla-main">

  <!-- Compass -->
  <div class="compass-card" id="compassCard">
    <div class="compass-wrap">
      <div class="compass-ring" id="compassRing">
        <span class="cardinal n"><?= $textes['nord'] ?></span>
        <span class="cardinal s">S</span>
        <span class="cardinal e">E</span>
        <span class="cardinal w">O</span>
        <div class="kaaba-arrow" id="qiblaArrow">
          <div class="arrow-head"></div>
          <div class="arrow-body"></div>
          <div class="arrow-tail"></div>
        </div>
        <div class="kaaba-icon" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:28px;height:28px;background:var(--bg-dark);border:2px solid var(--gold);border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:1rem;z-index:3;box-shadow:0 0 10px rgba(201,168,76,0.3);">🕋</div>
      </div>
    </div>

    <div class="compass-stats">
      <div class="stat-chip">
        <div class="label"><?= htmlspecialchars($textes['direction']) ?></div>
        <div class="value" id="statDir">—</div>
        <div class="unit"><?= $textes['degres'] ?></div>
      </div>
      <div class="stat-chip">
        <div class="label"><?= htmlspecialchars($textes['distance']) ?></div>
        <div class="value" id="statDist">—</div>
        <div class="unit"><?= $textes['km'] ?></div>
      </div>
    </div>
  </div>

  <!-- Info panel -->
  <div class="info-card">
    <button class="locate-btn" id="locateBtn" onclick="localiserQibla()">
      <i class="bi bi-geo-alt-fill"></i>
      <span id="locateBtnText"><?= htmlspecialchars($textes['localiser']) ?></span>
    </button>

    <div class="status-box" id="statusBox">
      <i class="bi bi-info-circle"></i>
      <?= htmlspecialchars($textes['en_cours']) ?>
    </div>

    <div class="coords-block" id="coordsBlock" style="display:none">
      <div>Lat : <span id="dispLat">—</span> &nbsp; Lng : <span id="dispLng">—</span></div>
    </div>

    <div>
      <div class="tips-title mb-2">Conseils</div>
      <ul class="tips-list">
        <li><i class="bi bi-compass"></i> Tenez l'appareil à plat, à l'horizontale</li>
        <li><i class="bi bi-telephone"></i> Éloignez-vous des objets métalliques</li>
        <li><i class="bi bi-arrow-repeat"></i> Recalibrez en dessinant un 8 avec l'appareil</li>
        <li><i class="bi bi-shield-check"></i> La géolocalisation reste sur votre appareil</li>
      </ul>
    </div>
  </div>

</div><!-- end qibla-main -->

</div><!-- end page-wrapper -->

<?php if (file_exists(__DIR__ . '/../../../../view/sections/vitrine/footer.php')) {
    require_once __DIR__ . '/../../../../view/sections/vitrine/footer.php';
} ?>

<script>
const AJAX_URL = '../../../../index.php?action=ajax_qibla';

function localiserQibla() {
  const btn     = document.getElementById('locateBtn');
  const btnText = document.getElementById('locateBtnText');
  const status  = document.getElementById('statusBox');
  const arrow   = document.getElementById('qiblaArrow');
  const card    = document.getElementById('compassCard');

  if (!navigator.geolocation) {
    setStatus('error', '<?= addslashes($textes['erreur_geo']) ?>');
    return;
  }

  btn.disabled = true;
  btnText.innerHTML = '<span class="spin"><i class="bi bi-arrow-repeat"></i></span> <?= addslashes($textes['en_cours']) ?>';
  setStatus('info', '<span class="spin"><i class="bi bi-arrow-repeat"></i></span> Localisation en cours…');

  navigator.geolocation.getCurrentPosition(
    (pos) => {
      const lat = pos.coords.latitude;
      const lng = pos.coords.longitude;

      document.getElementById('dispLat').textContent = lat.toFixed(5);
      document.getElementById('dispLng').textContent = lng.toFixed(5);
      document.getElementById('coordsBlock').style.display = 'block';

      fetch(AJAX_URL, {
        method : 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body   : `lat=${encodeURIComponent(lat)}&lng=${encodeURIComponent(lng)}`
      })
      .then(r => r.json())
      .then(data => {
        if (data.success) {
          const deg  = parseFloat(data.direction);
          const dist = Math.round(data.distance);

          document.getElementById('statDir').textContent  = deg.toFixed(1);
          document.getElementById('statDist').textContent = dist.toLocaleString();

          arrow.style.transform = `translate(-50%,-50%) rotate(${deg}deg)`;
          card.classList.add('compass-active');

          setStatus('success', `🕋 Direction : ${deg.toFixed(1)}° — Distance : ${dist.toLocaleString()} km`);
        } else {
          setStatus('error', data.erreur || 'Erreur serveur');
        }
        btn.disabled = false;
        btnText.innerHTML = '<i class="bi bi-geo-alt-fill"></i> <?= addslashes($textes['localiser']) ?>';
      })
      .catch(() => {
        setStatus('error', 'Erreur réseau');
        btn.disabled = false;
        btnText.innerHTML = '<i class="bi bi-geo-alt-fill"></i> <?= addslashes($textes['localiser']) ?>';
      });
    },
    (err) => {
      const msg = err.code === 1 ? '<?= addslashes($textes['refus_geo']) ?>' : '<?= addslashes($textes['erreur_geo']) ?>';
      setStatus('error', msg);
      btn.disabled = false;
      btnText.innerHTML = '<i class="bi bi-geo-alt-fill"></i> <?= addslashes($textes['localiser']) ?>';
    },
    { enableHighAccuracy:true, timeout:10000 }
  );
}

function setStatus(type, msg) {
  const box = document.getElementById('statusBox');
  box.className = 'status-box ' + (type === 'info' ? '' : type);
  box.innerHTML = msg;
}

/* Optional: device orientation compass */
if (window.DeviceOrientationEvent) {
  window.addEventListener('deviceorientation', (e) => {
    if (!e.alpha) return;
    const heading  = e.webkitCompassHeading || (360 - e.alpha);
    const arrow    = document.getElementById('qiblaArrow');
    const current  = parseFloat(arrow.dataset.qibla || 0);
    arrow.style.transform = `translate(-50%,-50%) rotate(${current - heading}deg)`;
  });
}
</script>
</body>
</html>