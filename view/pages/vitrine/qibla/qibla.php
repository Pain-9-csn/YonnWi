<!DOCTYPE html>
<html lang="fr" dir="<?= $textes['dir'] ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($textes['titre']) ?> — YonnWi</title>

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

  <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

  <style>
    :root {
      --accent:       #71c55d;
      --accent-dark:  #5fb04d;
      --accent-light: color-mix(in srgb, var(--accent), white 88%);
      --accent-mid:   color-mix(in srgb, var(--accent), white 70%);
      --accent-bord:  color-mix(in srgb, var(--accent), transparent 72%);
      --text-main:    #1f2937;
      --text-muted:   #6b7280;
      --bg-page:      #f7faf7;
      --bg-card:      #ffffff;
      --shadow-sm:    0 2px 14px rgba(113,197,93,.10);
      --shadow-md:    0 8px 32px rgba(113,197,93,.16);
      --radius-lg:    20px;
      --radius-md:    12px;
    }

    body { background: var(--bg-page); font-family: 'Poppins', sans-serif; color: var(--text-main); }

    /* ── HERO ── */
    .qibla-hero {
      background: linear-gradient(135deg,
        color-mix(in srgb, var(--accent), white 80%) 0%,
        color-mix(in srgb, var(--accent), white 92%) 100%);
      border-bottom: 1px solid var(--accent-bord);
      padding: 60px 0 44px;
      text-align: center;
    }
    .qibla-hero h1 {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--text-main);
    }
    .qibla-hero p { color: var(--text-muted); font-size: .95rem; margin-bottom: 0; }
    .qibla-hero .verset-arabe {
      font-family: 'Amiri', serif;
      font-size: 1.3rem;
      color: var(--accent-dark);
      margin-top: 12px;
      line-height: 1.8;
    }
    .qibla-hero .verset-ref {
      font-size: .75rem;
      color: var(--text-muted);
    }

    /* ── LAYOUT ── */
    .qibla-wrap {
      max-width: 1000px;
      margin: 40px auto 80px;
      padding: 0 20px;
    }

    /* ── GRILLE PRINCIPALE ── */
    .qibla-grid {
      display: grid;
      grid-template-columns: 1fr 380px;
      gap: 28px;
      align-items: start;
    }
    @media (max-width: 860px) {
      .qibla-grid { grid-template-columns: 1fr; }
    }

    /* ── BOUSSOLE ── */
    .compass-card {
      background: var(--bg-card);
      border: 1px solid var(--accent-bord);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-md);
      padding: 36px 24px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 24px;
    }

    .compass-wrap {
      position: relative;
      width: 280px;
      height: 280px;
    }

    /* Cadran SVG */
    .compass-svg { width: 280px; height: 280px; }

    /* Aiguille qibla */
    #qiblaArrow {
      transform-origin: 140px 140px;
      transition: transform 1.2s cubic-bezier(.34,1.56,.64,1);
    }

    /* Bouton localiser */
    .btn-localiser {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 32px;
      background: linear-gradient(135deg, var(--accent), var(--accent-dark));
      color: #fff;
      border: none;
      border-radius: 50px;
      font-size: .95rem;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 8px 24px rgba(113,197,93,.30);
      transition: transform .25s, box-shadow .25s;
      font-family: 'Poppins', sans-serif;
    }
    .btn-localiser:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(113,197,93,.38);
    }
    .btn-localiser:active { transform: scale(.97); }
    .btn-localiser:disabled {
      opacity: .65;
      cursor: not-allowed;
      transform: none;
    }

    /* Pulse autour de la boussole pendant la localisation */
    .compass-wrap.locating::before {
      content: '';
      position: absolute;
      inset: -8px;
      border-radius: 50%;
      border: 2px solid var(--accent);
      animation: pulse-ring 1.2s ease-out infinite;
    }
    @keyframes pulse-ring {
      0%   { opacity: .8; transform: scale(1); }
      100% { opacity: 0;  transform: scale(1.12); }
    }

    /* Indicateur de degré central */
    .degree-badge {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: var(--accent);
      color: #fff;
      border-radius: 50%;
      width: 64px;
      height: 64px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: .85rem;
      box-shadow: 0 4px 16px rgba(113,197,93,.4);
      line-height: 1.1;
      transition: background .3s;
    }
    .degree-badge.ready { background: var(--accent); }
    .degree-badge span { font-size: .65rem; font-weight: 400; opacity: .85; }

    /* ── INFOS PANEL ── */
    .infos-panel {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .info-card {
      background: var(--bg-card);
      border: 1px solid var(--accent-bord);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-sm);
      padding: 20px 22px;
    }
    .info-card h5 {
      font-size: .78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: var(--text-muted);
      margin-bottom: 12px;
    }
    .info-row {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 0;
      border-bottom: 1px solid var(--accent-bord);
    }
    .info-row:last-child { border-bottom: none; }
    .info-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: var(--accent-light);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent-dark);
      font-size: 1rem;
      flex-shrink: 0;
    }
    .info-label { font-size: .8rem; color: var(--text-muted); }
    .info-val   { font-size: 1.05rem; font-weight: 600; color: var(--text-main); }

    /* Stat distance + direction */
    .stat-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .stat-box {
      background: var(--accent-light);
      border: 1px solid var(--accent-bord);
      border-radius: var(--radius-md);
      padding: 18px 14px;
      text-align: center;
    }
    .stat-box .val {
      font-size: 1.7rem;
      font-weight: 700;
      color: var(--accent-dark);
      line-height: 1;
    }
    .stat-box .lab {
      font-size: .72rem;
      color: var(--text-muted);
      margin-top: 4px;
    }

    /* Message d'état */
    .etat-msg {
      border-radius: var(--radius-md);
      padding: 14px 18px;
      font-size: .88rem;
      display: none;
      align-items: center;
      gap: 10px;
    }
    .etat-msg.info    { background: var(--accent-light); color: var(--accent-dark); border: 1px solid var(--accent-bord); display: flex; }
    .etat-msg.erreur  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; display: flex; }
    .etat-msg.succes  { background: var(--accent-light); color: var(--accent-dark); border: 1px solid var(--accent-bord); display: flex; }

    /* Spinner inline */
    .spin-sm {
      width: 16px; height: 16px;
      border: 2px solid var(--accent-mid);
      border-top-color: var(--accent);
      border-radius: 50%;
      animation: spin .7s linear infinite;
      flex-shrink: 0;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* Carte conseils */
    .conseils-card {
      background: var(--bg-card);
      border: 1px solid var(--accent-bord);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-sm);
      padding: 20px 22px;
    }
    .conseils-card h5 {
      font-size: .78rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: var(--text-muted);
      margin-bottom: 12px;
    }
    .conseil-item {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      padding: 8px 0;
      font-size: .84rem;
      color: var(--text-muted);
      border-bottom: 1px solid var(--accent-bord);
    }
    .conseil-item:last-child { border-bottom: none; }
    .conseil-item i { color: var(--accent); margin-top: 2px; flex-shrink: 0; }
  </style>
</head>

<body class="index-page">

<?php require_once 'view/sections/vitrine/menu.php'; ?>

<!-- HERO -->
<section class="qibla-hero" data-aos="fade-down">
  <div class="container">
    <h1><?= htmlspecialchars($textes['titre']) ?></h1>
    <p><?= htmlspecialchars($textes['sous_titre']) ?></p>
    <div class="verset-arabe"><?= htmlspecialchars($textes['bismillah']) ?></div>
    <div class="verset-ref"><?= htmlspecialchars($textes['verset_ref']) ?></div>
  </div>
</section>

<!-- CONTENU PRINCIPAL -->
<div class="qibla-wrap">
  <div class="qibla-grid">

    <!-- ── BOUSSOLE ── -->
    <div class="compass-card" data-aos="fade-up">

      <!-- SVG Boussole -->
      <div class="compass-wrap" id="compassWrap">

        <svg class="compass-svg" viewBox="0 0 280 280" xmlns="http://www.w3.org/2000/svg">

          <!-- Cercle extérieur cadran -->
          <circle cx="140" cy="140" r="130" fill="none" stroke="#e5e7eb" stroke-width="1"/>
          <circle cx="140" cy="140" r="128" fill="color-mix(in srgb, #71c55d, white 94%)" stroke="color-mix(in srgb, #71c55d, transparent 70%)" stroke-width="1"/>

          <!-- Graduations tous les 30° -->
          <?php for ($deg = 0; $deg < 360; $deg += 10): ?>
            <?php
              $rad = deg2rad($deg - 90);
              $major = ($deg % 30 === 0);
              $r1 = $major ? 115 : 120;
              $r2 = 128;
              $x1 = 140 + $r1 * cos($rad);
              $y1 = 140 + $r1 * sin($rad);
              $x2 = 140 + $r2 * cos($rad);
              $y2 = 140 + $r2 * sin($rad);
              $sw = $major ? '2' : '1';
              $col = $major ? '#5fb04d' : '#9ca3af';
            ?>
            <line x1="<?= round($x1,1) ?>" y1="<?= round($y1,1) ?>" x2="<?= round($x2,1) ?>" y2="<?= round($y2,1) ?>" stroke="<?= $col ?>" stroke-width="<?= $sw ?>"/>
          <?php endfor; ?>

          <!-- Points cardinaux -->
          <text x="140" y="22"  text-anchor="middle" font-family="Poppins,sans-serif" font-size="13" font-weight="700" fill="#71c55d"><?= $textes['nord'] ?></text>
          <text x="258" y="145" text-anchor="middle" font-family="Poppins,sans-serif" font-size="11" font-weight="600" fill="#9ca3af">E</text>
          <text x="22"  y="145" text-anchor="middle" font-family="Poppins,sans-serif" font-size="11" font-weight="600" fill="#9ca3af">W</text>
          <text x="140" y="262" text-anchor="middle" font-family="Poppins,sans-serif" font-size="11" font-weight="600" fill="#9ca3af">S</text>

          <!-- Cercle intérieur décoratif -->
          <circle cx="140" cy="140" r="105" fill="none" stroke="color-mix(in srgb, #71c55d, transparent 80%)" stroke-width="1" stroke-dasharray="4 4"/>

          <!-- Aiguille Qibla (pointe verte = Mecque) -->
          <g id="qiblaArrow">
            <!-- Corps de l'aiguille -->
            <line x1="140" y1="50" x2="140" y2="145" stroke="#71c55d" stroke-width="4" stroke-linecap="round"/>
            <!-- Pointe triangulaire -->
            <polygon points="140,36 133,60 147,60" fill="#71c55d"/>
            <!-- Côté opposé (gris) -->
            <line x1="140" y1="145" x2="140" y2="210" stroke="#d1d5db" stroke-width="3" stroke-linecap="round"/>
            <polygon points="140,222 134,200 146,200" fill="#d1d5db"/>
            <!-- Icône Kaaba en haut de l'aiguille -->
            <rect x="135" y="22" width="10" height="10" rx="1" fill="#fff" stroke="#71c55d" stroke-width="1.5"/>
          </g>

          <!-- Centre pivot -->
          <circle cx="140" cy="140" r="8" fill="white" stroke="#71c55d" stroke-width="2.5"/>
          <circle cx="140" cy="140" r="3" fill="#71c55d"/>

        </svg>

        <!-- Badge degré central -->
        <div class="degree-badge" id="degreeBadge">
          <div id="degreeVal">—</div>
          <span><?= $textes['degres'] ?></span>
        </div>
      </div>

      <!-- Bouton -->
      <button class="btn-localiser" id="btnLocaliser" onclick="localiser()">
        <i class="bi bi-geo-alt-fill"></i>
        <?= htmlspecialchars($textes['localiser']) ?>
      </button>

      <!-- Message d'état -->
      <div class="etat-msg" id="etatMsg">
        <div class="spin-sm" id="etatSpinner" style="display:none"></div>
        <i class="bi bi-info-circle" id="etatIcon"></i>
        <span id="etatTexte"></span>
      </div>

    </div>

    <!-- ── PANEL INFOS ── -->
    <div class="infos-panel">

      <!-- Stats distance + direction -->
      <div class="stat-grid" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-box">
          <div class="val" id="distanceVal">—</div>
          <div class="lab"><?= htmlspecialchars($textes['distance']) ?> (<?= $textes['km'] ?>)</div>
        </div>
        <div class="stat-box">
          <div class="val" id="directionVal">—</div>
          <div class="lab"><?= htmlspecialchars($textes['direction'] . ' ' . $textes['degres']) ?></div>
        </div>
      </div>

      <!-- Infos position -->
      <div class="info-card" data-aos="fade-up" data-aos-delay="160">
        <h5><i class="bi bi-geo me-2" style="color:var(--accent)"></i>Ma position</h5>
        <div class="info-row">
          <div class="info-icon"><i class="bi bi-compass"></i></div>
          <div>
            <div class="info-label">Latitude</div>
            <div class="info-val" id="myLat">—</div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon"><i class="bi bi-compass"></i></div>
          <div>
            <div class="info-label">Longitude</div>
            <div class="info-val" id="myLng">—</div>
          </div>
        </div>
      </div>

      <!-- Infos Mecque -->
      <div class="info-card" data-aos="fade-up" data-aos-delay="220">
        <h5><i class="bi bi-building me-2" style="color:var(--accent)"></i><?= htmlspecialchars($textes['mecque']) ?></h5>
        <div class="info-row">
          <div class="info-icon"><i class="bi bi-pin-map-fill"></i></div>
          <div>
            <div class="info-label">Latitude</div>
            <div class="info-val"><?= $meccaLat ?></div>
          </div>
        </div>
        <div class="info-row">
          <div class="info-icon"><i class="bi bi-pin-map-fill"></i></div>
          <div>
            <div class="info-label">Longitude</div>
            <div class="info-val"><?= $meccaLng ?></div>
          </div>
        </div>
      </div>

      <!-- Conseils -->
      <div class="conseils-card" data-aos="fade-up" data-aos-delay="300">
        <h5><i class="bi bi-lightbulb me-2" style="color:var(--accent)"></i>Conseils</h5>
        <div class="conseil-item">
          <i class="bi bi-check2-circle"></i>
          <span>Éloignez-vous des objets métalliques pour éviter les interférences magnétiques.</span>
        </div>
        <div class="conseil-item">
          <i class="bi bi-check2-circle"></i>
          <span>La pointe verte de la boussole indique la direction de la Kaaba.</span>
        </div>
        <div class="conseil-item">
          <i class="bi bi-check2-circle"></i>
          <span>Activez le GPS de votre appareil pour une précision optimale.</span>
        </div>
        <div class="conseil-item">
          <i class="bi bi-check2-circle"></i>
          <span>La direction est calculée selon le grand cercle orthodromique.</span>
        </div>
      </div>

    </div>
  </div>
</div>

<?php require_once 'view/sections/vitrine/footer.php'; ?>

<script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
<script>
AOS.init({ duration: 600, once: true });

// Coordonnées fixes Mecque
const MECCA_LAT = <?= $meccaLat ?>;
const MECCA_LNG = <?= $meccaLng ?>;

// ── Calcul trigonométrique côté client (même formule que PHP) ──
function calculerQibla(lat, lng) {
  const toRad = x => x * Math.PI / 180;
  const lat1 = toRad(lat), lng1 = toRad(lng);
  const lat2 = toRad(MECCA_LAT), lng2 = toRad(MECCA_LNG);
  const dLng = lng2 - lng1;
  const y = Math.sin(dLng) * Math.cos(lat2);
  const x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dLng);
  const bearing = (Math.atan2(y, x) * 180 / Math.PI + 360) % 360;
  return Math.round(bearing * 10) / 10;
}

// ── Distance haversine ──
function calculerDistance(lat, lng) {
  const R = 6371;
  const toRad = x => x * Math.PI / 180;
  const dLat = toRad(MECCA_LAT - lat);
  const dLng = toRad(MECCA_LNG - lng);
  const a = Math.sin(dLat/2)**2 + Math.cos(toRad(lat)) * Math.cos(toRad(MECCA_LAT)) * Math.sin(dLng/2)**2;
  return Math.round(R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)));
}

// ── Afficher un message d'état ──
function setEtat(type, texte, spinner = false) {
  const el  = document.getElementById('etatMsg');
  const sp  = document.getElementById('etatSpinner');
  const ico = document.getElementById('etatIcon');
  const txt = document.getElementById('etatTexte');
  el.className = 'etat-msg ' + type;
  sp.style.display  = spinner ? 'block' : 'none';
  ico.style.display = spinner ? 'none'  : 'block';
  ico.className = type === 'erreur' ? 'bi bi-exclamation-circle' : 'bi bi-info-circle';
  txt.textContent = texte;
}

// ── Localiser ──
function localiser() {
  if (!navigator.geolocation) {
    setEtat('erreur', '<?= addslashes($textes['erreur_geo']) ?>');
    return;
  }

  const btn = document.getElementById('btnLocaliser');
  const cw  = document.getElementById('compassWrap');

  btn.disabled = true;
  cw.classList.add('locating');
  setEtat('info', '<?= addslashes($textes['en_cours']) ?>', true);

  navigator.geolocation.getCurrentPosition(
    pos => {
      const lat = pos.coords.latitude;
      const lng = pos.coords.longitude;
      const dir = calculerQibla(lat, lng);
      const dist = calculerDistance(lat, lng);

      // Mettre à jour la boussole
      document.getElementById('qiblaArrow').style.transform = `rotate(${dir}deg)`;
      document.getElementById('degreeVal').textContent = Math.round(dir);
      document.getElementById('degreeBadge').classList.add('ready');

      // Statistiques
      document.getElementById('distanceVal').textContent = dist.toLocaleString();
      document.getElementById('directionVal').textContent = Math.round(dir);
      document.getElementById('myLat').textContent = lat.toFixed(6);
      document.getElementById('myLng').textContent = lng.toFixed(6);

      btn.disabled = false;
      cw.classList.remove('locating');
      setEtat('succes', `Qibla trouvée : ${Math.round(dir)}° depuis le Nord`);

      // Envoi optionnel en DB
      fetch('?action=qiblaAjax', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `lat=${lat}&lng=${lng}`
      }).catch(() => {});
    },
    err => {
      btn.disabled = false;
      cw.classList.remove('locating');
      const msg = err.code === 1
        ? '<?= addslashes($textes['refus_geo']) ?>'
        : '<?= addslashes($textes['erreur_geo']) ?>';
      setEtat('erreur', msg);
    },
    { enableHighAccuracy: true, timeout: 10000 }
  );
}
</script>
</body>
</html>