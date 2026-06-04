<?php
// Vérification session admin (à adapter selon ton système d'auth)
// if (!isset($_SESSION['user'])) { header('Location: /login'); exit; }
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coran — YoonWi</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    /* ========== VARIABLES ========== */
    :root {
      --green:        #71c55d;
      --green-dark:   #5fb04d;
      --green-light:  color-mix(in srgb, #71c55d, white 88%);
      --green-mid:    color-mix(in srgb, #71c55d, white 60%);
      --dark:         #1f2937;
      --dark-2:       #2d3748;
      --sidebar-bg:   #191c24;
      --text-muted:   #6b7280;
      --border:       #e5e7eb;
      --bg:           #f7faf7;
      --white:        #ffffff;
      --gold:         #d4a017;
      --font:         'Nunito', sans-serif;
      --font-ar:      'Amiri', serif;
      --radius:       16px;
      --radius-sm:    10px;
      --shadow:       0 4px 24px rgba(113,197,93,.10), 0 1px 4px rgba(0,0,0,.06);
      --shadow-sm:    0 2px 8px rgba(0,0,0,.07);
    }

    /* ========== RESET ========== */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: var(--font);
      background: var(--bg);
      color: var(--dark);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ========== LAYOUT PRINCIPAL ========== */
    .app-layout {
      display: grid;
      grid-template-columns: 320px 1fr;
      grid-template-rows: 64px 1fr;
      min-height: 100vh;
    }

    /* ========== TOPBAR ========== */
    .topbar {
      grid-column: 1 / -1;
      background: var(--white);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      padding: 0 24px;
      gap: 16px;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .topbar-brand {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 800;
      font-size: 20px;
      color: var(--dark);
      text-decoration: none;
    }
    .topbar-brand .brand-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--green), var(--green-dark));
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: white;
    }
    .topbar-breadcrumb {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      color: var(--text-muted);
      margin-left: 8px;
    }
    .topbar-breadcrumb .sep { opacity: .4; }
    .topbar-breadcrumb .current { color: var(--dark); font-weight: 600; }
    .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 10px; }
    .lang-btns { display: flex; gap: 4px; }
    .lang-btn {
      padding: 4px 10px;
      border-radius: 20px;
      border: 1px solid var(--border);
      background: transparent;
      font-size: 12px;
      font-family: var(--font);
      font-weight: 600;
      cursor: pointer;
      color: var(--text-muted);
      transition: .2s;
    }
    .lang-btn.active, .lang-btn:hover {
      background: var(--green);
      border-color: var(--green);
      color: white;
    }

    /* ========== PANNEAU GAUCHE — LISTE SOURATES ========== */
    .surah-panel {
      background: var(--white);
      border-right: 1px solid var(--border);
      display: flex;
      flex-direction: column;
      overflow: hidden;
      position: sticky;
      top: 64px;
      height: calc(100vh - 64px);
    }
    .panel-header {
      padding: 20px 20px 12px;
      border-bottom: 1px solid var(--border);
      flex-shrink: 0;
    }
    .panel-header h2 {
      font-size: 15px;
      font-weight: 700;
      color: var(--dark);
      margin-bottom: 10px;
    }
    .search-wrap {
      position: relative;
    }
    .search-wrap i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted);
      font-size: 14px;
    }
    .search-input {
      width: 100%;
      padding: 9px 12px 9px 34px;
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      font-family: var(--font);
      font-size: 13px;
      color: var(--dark);
      background: var(--bg);
      outline: none;
      transition: .2s;
    }
    .search-input:focus {
      border-color: var(--green);
      background: white;
      box-shadow: 0 0 0 3px color-mix(in srgb, var(--green), transparent 80%);
    }

    /* Filtres type */
    .type-filters {
      display: flex;
      gap: 6px;
      padding: 10px 20px;
      border-bottom: 1px solid var(--border);
      flex-shrink: 0;
    }
    .type-btn {
      padding: 5px 12px;
      border-radius: 20px;
      border: 1px solid var(--border);
      background: transparent;
      font-family: var(--font);
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      color: var(--text-muted);
      transition: .2s;
      white-space: nowrap;
    }
    .type-btn.active {
      background: var(--green-light);
      border-color: var(--green-mid);
      color: var(--green-dark);
    }
    .type-btn:hover:not(.active) {
      border-color: var(--green-mid);
      color: var(--dark);
    }

    /* Liste sourates */
    .surah-list {
      overflow-y: auto;
      flex: 1;
      padding: 8px 0;
    }
    .surah-list::-webkit-scrollbar { width: 4px; }
    .surah-list::-webkit-scrollbar-track { background: transparent; }
    .surah-list::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

    .surah-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background .15s;
      border-left: 3px solid transparent;
    }
    .surah-item:hover { background: var(--green-light); }
    .surah-item.active {
      background: var(--green-light);
      border-left-color: var(--green);
    }
    .surah-num {
      width: 32px;
      height: 32px;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
      color: var(--text-muted);
      flex-shrink: 0;
      transition: .2s;
    }
    .surah-item.active .surah-num,
    .surah-item:hover .surah-num {
      background: var(--green);
      border-color: var(--green);
      color: white;
    }
    .surah-info { flex: 1; min-width: 0; }
    .surah-name-fr {
      font-size: 13px;
      font-weight: 700;
      color: var(--dark);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .surah-meta {
      font-size: 11px;
      color: var(--text-muted);
      margin-top: 1px;
    }
    .surah-name-ar {
      font-family: var(--font-ar);
      font-size: 15px;
      color: var(--green-dark);
      flex-shrink: 0;
    }

    /* ========== PANNEAU DROIT — LECTEUR ========== */
    .reader-panel {
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    /* Header sourate */
    .surah-header {
      background: var(--white);
      border-bottom: 1px solid var(--border);
      padding: 28px 36px 24px;
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 20px;
      flex-wrap: wrap;
    }
    .surah-header-left {}
    .surah-number-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--green-light);
      color: var(--green-dark);
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .surah-title-fr {
      font-size: 26px;
      font-weight: 800;
      color: var(--dark);
      line-height: 1.2;
    }
    .surah-title-sub {
      font-size: 14px;
      color: var(--text-muted);
      margin-top: 4px;
    }
    .surah-header-right { text-align: right; }
    .surah-title-ar {
      font-family: var(--font-ar);
      font-size: 34px;
      color: var(--dark);
      line-height: 1.4;
    }
    .surah-revelation {
      font-size: 12px;
      color: var(--text-muted);
      margin-top: 4px;
    }
    .revelation-badge {
      display: inline-block;
      padding: 3px 10px;
      border-radius: 12px;
      font-size: 11px;
      font-weight: 700;
    }
    .revelation-mecque {
      background: #fef3c7;
      color: #92400e;
    }
    .revelation-medine {
      background: #dbeafe;
      color: #1e40af;
    }

    /* Lecteur audio global */
    .audio-player {
      background: var(--dark);
      margin: 20px 36px;
      border-radius: var(--radius);
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 16px;
      flex-wrap: wrap;
    }
    .audio-player-info { flex: 1; min-width: 0; }
    .audio-player-title {
      font-size: 12px;
      color: #9ca3af;
      margin-bottom: 2px;
    }
    .audio-player-verse {
      font-size: 14px;
      font-weight: 700;
      color: white;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .audio-controls { display: flex; align-items: center; gap: 8px; }
    .audio-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      transition: .2s;
    }
    .audio-btn-main {
      background: var(--green);
      color: white;
      width: 42px;
      height: 42px;
      font-size: 16px;
    }
    .audio-btn-main:hover { background: var(--green-dark); transform: scale(1.05); }
    .audio-btn-secondary { background: rgba(255,255,255,.1); color: white; }
    .audio-btn-secondary:hover { background: rgba(255,255,255,.2); }
    .audio-progress-wrap { flex: 1; min-width: 200px; }
    .audio-time {
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      color: #6b7280;
      margin-bottom: 4px;
    }
    .audio-progress {
      width: 100%;
      height: 4px;
      background: rgba(255,255,255,.15);
      border-radius: 4px;
      overflow: hidden;
      cursor: pointer;
    }
    .audio-progress-bar {
      height: 100%;
      background: var(--green);
      border-radius: 4px;
      width: 0%;
      transition: width .3s linear;
    }
    .audio-volume {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #9ca3af;
      font-size: 14px;
    }
    .volume-slider {
      width: 70px;
      accent-color: var(--green);
    }

    /* Bismillah */
    .bismillah {
      text-align: center;
      padding: 24px 36px;
      border-bottom: 1px solid var(--border);
    }
    .bismillah-text {
      font-family: var(--font-ar);
      font-size: 28px;
      color: var(--dark);
      line-height: 1.8;
    }
    .bismillah-translation {
      font-size: 13px;
      color: var(--text-muted);
      margin-top: 6px;
      font-style: italic;
    }

    /* Versets */
    .verses-container {
      padding: 16px 36px 40px;
    }

    /* Loading spinner */
    .loading-state {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 80px 20px;
      gap: 16px;
      color: var(--text-muted);
    }
    .spinner {
      width: 36px;
      height: 36px;
      border: 3px solid var(--border);
      border-top-color: var(--green);
      border-radius: 50%;
      animation: spin .8s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* Carte verset */
    .verse-card {
      display: grid;
      grid-template-columns: 48px 1fr;
      gap: 0;
      padding: 20px 0;
      border-bottom: 1px solid var(--border);
      transition: background .15s;
      border-radius: var(--radius-sm);
      animation: fadeUp .3s ease both;
    }
    .verse-card:last-child { border-bottom: none; }
    .verse-card.playing {
      background: var(--green-light);
      padding: 20px 16px;
      margin: 0 -16px;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .verse-number-col {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      padding-top: 4px;
    }
    .verse-num-badge {
      width: 36px;
      height: 36px;
      background: var(--bg);
      border: 1px solid var(--border);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
      color: var(--text-muted);
      flex-shrink: 0;
      transition: .2s;
    }
    .verse-card.playing .verse-num-badge {
      background: var(--green);
      border-color: var(--green);
      color: white;
    }
    .verse-play-btn {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      border: 1px solid var(--border);
      background: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      color: var(--text-muted);
      transition: .2s;
      opacity: 0;
    }
    .verse-card:hover .verse-play-btn { opacity: 1; }
    .verse-card.playing .verse-play-btn {
      opacity: 1;
      background: var(--green);
      border-color: var(--green);
      color: white;
    }
    .verse-play-btn:hover {
      background: var(--green);
      border-color: var(--green);
      color: white;
    }

    .verse-content-col {}
    .verse-arabic {
      font-family: var(--font-ar);
      font-size: 26px;
      color: var(--dark);
      line-height: 2;
      text-align: right;
      direction: rtl;
      margin-bottom: 10px;
      word-spacing: 4px;
    }
    .verse-card.playing .verse-arabic { color: var(--green-dark); }

    .verse-translation {
      font-size: 14px;
      color: var(--text-muted);
      line-height: 1.7;
      font-style: italic;
      padding: 10px 14px;
      background: var(--bg);
      border-left: 3px solid var(--green-mid);
      border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
      display: none;
    }
    .verse-translation.visible { display: block; }

    .verse-actions {
      display: flex;
      gap: 8px;
      margin-top: 10px;
      flex-wrap: wrap;
    }
    .verse-action-btn {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      border-radius: 16px;
      border: 1px solid var(--border);
      background: white;
      font-family: var(--font);
      font-size: 11px;
      color: var(--text-muted);
      cursor: pointer;
      transition: .2s;
    }
    .verse-action-btn:hover {
      border-color: var(--green-mid);
      color: var(--green-dark);
      background: var(--green-light);
    }
    .verse-action-btn.active {
      background: var(--green-light);
      border-color: var(--green-mid);
      color: var(--green-dark);
    }

    /* Options toolbar */
    .reader-toolbar {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 14px 36px;
      border-bottom: 1px solid var(--border);
      background: var(--white);
      flex-wrap: wrap;
    }
    .toolbar-group {
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .toolbar-label {
      font-size: 12px;
      color: var(--text-muted);
      font-weight: 600;
    }
    .toolbar-select {
      padding: 5px 10px;
      border: 1px solid var(--border);
      border-radius: var(--radius-sm);
      font-family: var(--font);
      font-size: 12px;
      color: var(--dark);
      background: white;
      outline: none;
      cursor: pointer;
      transition: .2s;
    }
    .toolbar-select:focus { border-color: var(--green); }
    .toolbar-toggle {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      color: var(--text-muted);
      cursor: pointer;
      font-weight: 600;
    }
    .toolbar-toggle input { accent-color: var(--green); width: 14px; height: 14px; }
    .toolbar-toggle input:checked ~ span { color: var(--green-dark); }
    .sep-v {
      width: 1px;
      height: 20px;
      background: var(--border);
    }

    /* État vide / welcome */
    .welcome-state {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      flex: 1;
      padding: 60px 36px;
      text-align: center;
      gap: 16px;
    }
    .welcome-icon {
      width: 80px;
      height: 80px;
      background: var(--green-light);
      border-radius: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      color: var(--green);
    }
    .welcome-title {
      font-size: 22px;
      font-weight: 800;
      color: var(--dark);
    }
    .welcome-sub {
      font-size: 14px;
      color: var(--text-muted);
      max-width: 300px;
      line-height: 1.6;
    }

    /* Stats sourate */
    .surah-stats {
      display: flex;
      gap: 8px;
      padding: 0 36px 16px;
    }
    .stat-chip {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 5px 12px;
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 20px;
      font-size: 12px;
      color: var(--text-muted);
    }
    .stat-chip i { color: var(--green); }

    /* Responsivité */
    @media (max-width: 768px) {
      .app-layout { grid-template-columns: 1fr; grid-template-rows: 64px auto 1fr; }
      .surah-panel { position: relative; top: 0; height: 300px; grid-column: 1; }
      .reader-panel { grid-column: 1; }
      .surah-header, .reader-toolbar, .audio-player,
      .verses-container, .bismillah, .surah-stats { padding-left: 16px; padding-right: 16px; }
      .audio-player { margin: 16px; }
    }

    /* Scrollbar fine globale */
    .reader-panel::-webkit-scrollbar { width: 4px; }
    .reader-panel::-webkit-scrollbar-thumb { background: var(--border); border-radius: 4px; }

    /* Animation stagger versets */
    .verse-card:nth-child(1) { animation-delay: .03s; }
    .verse-card:nth-child(2) { animation-delay: .06s; }
    .verse-card:nth-child(3) { animation-delay: .09s; }
    .verse-card:nth-child(4) { animation-delay: .12s; }
    .verse-card:nth-child(5) { animation-delay: .15s; }
    .verse-card:nth-child(6) { animation-delay: .18s; }
    .verse-card:nth-child(7) { animation-delay: .21s; }
    .verse-card:nth-child(8) { animation-delay: .24s; }
    .verse-card:nth-child(9) { animation-delay: .27s; }
    .verse-card:nth-child(10) { animation-delay: .30s; }
  </style>
</head>
<body>

<div class="app-layout">

  <!-- ===== TOPBAR ===== -->
  <header class="topbar">
    <a href="index.php" class="topbar-brand">
      <div class="brand-icon">☪</div>
      YoonWi
    </a>
    <div class="topbar-breadcrumb">
      <span>Admin</span>
      <span class="sep"><i class="bi bi-chevron-right"></i></span>
      <span class="current">Coran</span>
    </div>
    <div class="topbar-actions">
      <div class="lang-btns">
        <button class="lang-btn active" onclick="setLang('fr', this)">FR</button>
        <button class="lang-btn" onclick="setLang('en', this)">EN</button>
        <button class="lang-btn" onclick="setLang('wo', this)">WO</button>
      </div>
    </div>
  </header>

  <!-- ===== PANNEAU SOURATES ===== -->
  <aside class="surah-panel">
    <div class="panel-header">
      <h2><i class="bi bi-book"></i> Sourates</h2>
      <div class="search-wrap">
        <i class="bi bi-search"></i>
        <input
          type="text"
          class="search-input"
          id="searchInput"
          placeholder="Rechercher une sourate…"
          oninput="filterSurahs(this.value)"
        >
      </div>
    </div>
    <div class="type-filters">
      <button class="type-btn active" onclick="filterByType('all', this)">Toutes</button>
      <button class="type-btn" onclick="filterByType('mecquoise', this)">Mecquoises</button>
      <button class="type-btn" onclick="filterByType('medinoise', this)">Médinoises</button>
    </div>
    <div class="surah-list" id="surahList">
      <!-- Rempli dynamiquement par JS -->
      <div class="loading-state">
        <div class="spinner"></div>
        <span>Chargement des sourates…</span>
      </div>
    </div>
  </aside>

  <!-- ===== PANNEAU LECTEUR ===== -->
  <main class="reader-panel" id="readerPanel">

    <!-- État par défaut (aucune sourate sélectionnée) -->
    <div class="welcome-state" id="welcomeState">
      <div class="welcome-icon">📖</div>
      <h2 class="welcome-title">بِسْمِ اللَّهِ</h2>
      <p class="welcome-sub">Sélectionne une sourate dans la liste pour commencer la lecture</p>
    </div>

    <!-- Contenu sourate (caché par défaut) -->
    <div id="surahContent" style="display:none; flex-direction:column; min-height:100%;">

      <!-- Header -->
      <div class="surah-header" id="surahHeader"></div>

      <!-- Player audio global -->
      <div class="audio-player" id="audioPlayer">
        <div class="audio-player-info">
          <div class="audio-player-title">En cours de lecture</div>
          <div class="audio-player-verse" id="nowPlayingLabel">—</div>
        </div>
        <div class="audio-controls">
          <button class="audio-btn audio-btn-secondary" onclick="prevVerse()" title="Verset précédent">
            <i class="bi bi-skip-start-fill"></i>
          </button>
          <button class="audio-btn audio-btn-main" id="mainPlayBtn" onclick="togglePlay()">
            <i class="bi bi-play-fill" id="mainPlayIcon"></i>
          </button>
          <button class="audio-btn audio-btn-secondary" onclick="nextVerse()" title="Verset suivant">
            <i class="bi bi-skip-end-fill"></i>
          </button>
          <button class="audio-btn audio-btn-secondary" id="loopBtn" onclick="toggleLoop()" title="Répétition">
            <i class="bi bi-arrow-repeat"></i>
          </button>
        </div>
        <div class="audio-progress-wrap">
          <div class="audio-time">
            <span id="timeElapsed">0:00</span>
            <span id="timeDuration">0:00</span>
          </div>
          <div class="audio-progress" onclick="seekAudio(event)">
            <div class="audio-progress-bar" id="progressBar"></div>
          </div>
        </div>
        <div class="audio-volume">
          <i class="bi bi-volume-up"></i>
          <input type="range" class="volume-slider" id="volumeSlider"
                 min="0" max="1" step="0.1" value="1"
                 oninput="setVolume(this.value)">
        </div>
      </div>

      <!-- Toolbar options lecture -->
      <div class="reader-toolbar">
        <div class="toolbar-group">
          <span class="toolbar-label">Récitateur</span>
          <select class="toolbar-select" id="recitersSelect" onchange="changeReciter()">
            <option value="ar.alafasy">Mishary Alafasy</option>
            <option value="ar.abdurrahmaansudais">Abdurrahman Al-Sudais</option>
            <option value="ar.minshawi">Mohamed Siddiq El-Minshawi</option>
            <option value="ar.husary">Mahmoud Khalil Al-Husary</option>
          </select>
        </div>
        <div class="sep-v"></div>
        <div class="toolbar-group">
          <span class="toolbar-label">Taille</span>
          <select class="toolbar-select" id="fontSizeSelect" onchange="changeFontSize()">
            <option value="22">Petite</option>
            <option value="26" selected>Normale</option>
            <option value="32">Grande</option>
            <option value="40">Très grande</option>
          </select>
        </div>
        <div class="sep-v"></div>
        <label class="toolbar-toggle">
          <input type="checkbox" id="showTranslation" checked onchange="toggleTranslations()">
          <span>Traduction</span>
        </label>
        <label class="toolbar-toggle">
          <input type="checkbox" id="autoPlay" onchange="">
          <span>Lecture auto</span>
        </label>
      </div>

      <!-- Stats -->
      <div class="surah-stats" id="surahStats" style="padding-top:16px;"></div>

      <!-- Bismillah (sauf Fatiha et Tawba) -->
      <div class="bismillah" id="bismillahBlock">
        <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
        <div class="bismillah-translation">Au nom d'Allah, le Tout Miséricordieux, le Très Miséricordieux</div>
      </div>

      <!-- Versets -->
      <div class="verses-container" id="versesContainer">
        <div class="loading-state" id="versesLoading">
          <div class="spinner"></div>
          <span>Chargement des versets…</span>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- Audio HTML5 caché -->
<audio id="audioEl" preload="none"></audio>

<script>
// ======================================================
// CONFIG & ÉTAT
// ======================================================
const API_BASE    = 'https://api.alquran.cloud/v1';
const AUDIO_BASE  = 'https://cdn.islamic.network/quran/audio/128/';
const IMG_BASE    = 'https://cdn.islamic.network/quran/images/';

let allSurahs       = [];
let currentSurahNum = null;
let currentVerses   = [];
let currentVerseIdx = 0;
let isPlaying       = false;
let isLooping       = false;
let currentLang     = 'fr';
let currentType     = 'all';
let currentReciter  = 'ar.alafasy';
let translations    = {};

const audioEl = document.getElementById('audioEl');

const langEditions = {
  fr: 'fr.hamidullah',
  en: 'en.sahih',
  wo: 'fr.hamidullah' // fallback wolof → français
};

// ======================================================
// DONNÉES SOURATES (liste complète 114)
// ======================================================
const SURAHS_DATA = [
  {n:1,  arName:"الفاتحة",    frName:"L'Ouverture",     enName:"The Opening",       verses:7,   rev:"mecquoise"},
  {n:2,  arName:"البقرة",     frName:"La Vache",          enName:"The Cow",           verses:286, rev:"medinoise"},
  {n:3,  arName:"آل عمران",   frName:"La Famille d'Imran",enName:"Family of Imran",  verses:200, rev:"medinoise"},
  {n:4,  arName:"النساء",     frName:"Les Femmes",        enName:"The Women",         verses:176, rev:"medinoise"},
  {n:5,  arName:"المائدة",    frName:"La Table Servie",   enName:"The Table Spread",  verses:120, rev:"medinoise"},
  {n:6,  arName:"الأنعام",    frName:"Les Bestiaux",      enName:"The Cattle",        verses:165, rev:"mecquoise"},
  {n:7,  arName:"الأعراف",    frName:"Les Murailles",     enName:"The Heights",       verses:206, rev:"mecquoise"},
  {n:8,  arName:"الأنفال",    frName:"Le Butin",          enName:"The Spoils of War", verses:75,  rev:"medinoise"},
  {n:9,  arName:"التوبة",     frName:"Le Repentir",       enName:"The Repentance",    verses:129, rev:"medinoise"},
  {n:10, arName:"يونس",       frName:"Yunus",             enName:"Jonah",             verses:109, rev:"mecquoise"},
  {n:11, arName:"هود",        frName:"Hud",               enName:"Hud",               verses:123, rev:"mecquoise"},
  {n:12, arName:"يوسف",       frName:"Yusuf",             enName:"Joseph",            verses:111, rev:"mecquoise"},
  {n:13, arName:"الرعد",      frName:"Le Tonnerre",       enName:"The Thunder",       verses:43,  rev:"medinoise"},
  {n:14, arName:"إبراهيم",    frName:"Ibrahim",           enName:"Abraham",           verses:52,  rev:"mecquoise"},
  {n:15, arName:"الحجر",      frName:"Al-Hijr",           enName:"The Rocky Tract",   verses:99,  rev:"mecquoise"},
  {n:16, arName:"النحل",      frName:"Les Abeilles",      enName:"The Bee",           verses:128, rev:"mecquoise"},
  {n:17, arName:"الإسراء",    frName:"Le Voyage Nocturne",enName:"The Night Journey", verses:111, rev:"mecquoise"},
  {n:18, arName:"الكهف",      frName:"La Caverne",        enName:"The Cave",          verses:110, rev:"mecquoise"},
  {n:19, arName:"مريم",       frName:"Marie",             enName:"Mary",              verses:98,  rev:"mecquoise"},
  {n:20, arName:"طه",         frName:"Taha",              enName:"Ta-Ha",             verses:135, rev:"mecquoise"},
  {n:21, arName:"الأنبياء",   frName:"Les Prophètes",     enName:"The Prophets",      verses:112, rev:"mecquoise"},
  {n:22, arName:"الحج",       frName:"Le Pèlerinage",     enName:"The Pilgrimage",    verses:78,  rev:"medinoise"},
  {n:23, arName:"المؤمنون",   frName:"Les Croyants",      enName:"The Believers",     verses:118, rev:"mecquoise"},
  {n:24, arName:"النور",      frName:"La Lumière",        enName:"The Light",         verses:64,  rev:"medinoise"},
  {n:25, arName:"الفرقان",    frName:"Le Critère",        enName:"The Criterion",     verses:77,  rev:"mecquoise"},
  {n:26, arName:"الشعراء",    frName:"Les Poètes",        enName:"The Poets",         verses:227, rev:"mecquoise"},
  {n:27, arName:"النمل",      frName:"La Fourmi",         enName:"The Ant",           verses:93,  rev:"mecquoise"},
  {n:28, arName:"القصص",      frName:"Le Récit",          enName:"The Stories",       verses:88,  rev:"mecquoise"},
  {n:29, arName:"العنكبوت",   frName:"L'Araignée",        enName:"The Spider",        verses:69,  rev:"mecquoise"},
  {n:30, arName:"الروم",      frName:"Les Romains",       enName:"The Romans",        verses:60,  rev:"mecquoise"},
  {n:31, arName:"لقمان",      frName:"Luqman",            enName:"Luqman",            verses:34,  rev:"mecquoise"},
  {n:32, arName:"السجدة",     frName:"La Prosternation",  enName:"The Prostration",   verses:30,  rev:"mecquoise"},
  {n:33, arName:"الأحزاب",    frName:"Les Coalisés",      enName:"The Combined Forces",verses:73, rev:"medinoise"},
  {n:34, arName:"سبأ",        frName:"Saba",              enName:"Sheba",             verses:54,  rev:"mecquoise"},
  {n:35, arName:"فاطر",       frName:"Le Créateur",       enName:"Originator",        verses:45,  rev:"mecquoise"},
  {n:36, arName:"يس",         frName:"Ya-Sin",            enName:"Ya-Sin",            verses:83,  rev:"mecquoise"},
  {n:37, arName:"الصافات",    frName:"Ceux en rangs",     enName:"Those Ranged in Rows",verses:182,rev:"mecquoise"},
  {n:38, arName:"ص",          frName:"Sad",               enName:"The Letter Sad",    verses:88,  rev:"mecquoise"},
  {n:39, arName:"الزمر",      frName:"Les Groupes",       enName:"The Troops",        verses:75,  rev:"mecquoise"},
  {n:40, arName:"غافر",       frName:"Le Pardonneur",     enName:"The Forgiver",      verses:85,  rev:"mecquoise"},
  {n:41, arName:"فصلت",       frName:"Détaillés",         enName:"Explained in Detail",verses:54, rev:"mecquoise"},
  {n:42, arName:"الشورى",     frName:"La Consultation",   enName:"The Consultation",  verses:53,  rev:"mecquoise"},
  {n:43, arName:"الزخرف",     frName:"L'Ornement",        enName:"The Gold Adornments",verses:89, rev:"mecquoise"},
  {n:44, arName:"الدخان",     frName:"La Fumée",          enName:"The Smoke",         verses:59,  rev:"mecquoise"},
  {n:45, arName:"الجاثية",    frName:"L'Agenouillée",     enName:"The Crouching",     verses:37,  rev:"mecquoise"},
  {n:46, arName:"الأحقاف",    frName:"Les Dunes",         enName:"The Wind-Curved Sandhills",verses:35,rev:"mecquoise"},
  {n:47, arName:"محمد",       frName:"Muhammad",          enName:"Muhammad",          verses:38,  rev:"medinoise"},
  {n:48, arName:"الفتح",      frName:"La Victoire",       enName:"The Victory",       verses:29,  rev:"medinoise"},
  {n:49, arName:"الحجرات",    frName:"Les Appartements",  enName:"The Rooms",         verses:18,  rev:"medinoise"},
  {n:50, arName:"ق",          frName:"Qaf",               enName:"The Letter Qaf",    verses:45,  rev:"mecquoise"},
  {n:51, arName:"الذاريات",   frName:"Les Vents dispersants",enName:"The Winnowing Winds",verses:60,rev:"mecquoise"},
  {n:52, arName:"الطور",      frName:"La Montagne",       enName:"The Mount",         verses:49,  rev:"mecquoise"},
  {n:53, arName:"النجم",      frName:"L'Étoile",          enName:"The Star",          verses:62,  rev:"mecquoise"},
  {n:54, arName:"القمر",      frName:"La Lune",           enName:"The Moon",          verses:55,  rev:"mecquoise"},
  {n:55, arName:"الرحمن",     frName:"Le Tout Miséricordieux",enName:"The Beneficent",verses:78, rev:"medinoise"},
  {n:56, arName:"الواقعة",    frName:"L'Événement",       enName:"The Inevitable",    verses:96,  rev:"mecquoise"},
  {n:57, arName:"الحديد",     frName:"Le Fer",            enName:"The Iron",          verses:29,  rev:"medinoise"},
  {n:58, arName:"المجادلة",   frName:"La Disputante",     enName:"The Pleading Woman",verses:22,  rev:"medinoise"},
  {n:59, arName:"الحشر",      frName:"Le Rassemblement",  enName:"The Exile",         verses:24,  rev:"medinoise"},
  {n:60, arName:"الممتحنة",   frName:"L'Éprouvée",        enName:"She that is to be Examined",verses:13,rev:"medinoise"},
  {n:61, arName:"الصف",       frName:"Le Rang",           enName:"The Ranks",         verses:14,  rev:"medinoise"},
  {n:62, arName:"الجمعة",     frName:"Le Vendredi",       enName:"Friday",            verses:11,  rev:"medinoise"},
  {n:63, arName:"المنافقون",  frName:"Les Hypocrites",    enName:"The Hypocrites",    verses:11,  rev:"medinoise"},
  {n:64, arName:"التغابن",    frName:"La Tricherie",      enName:"Mutual Disillusion",verses:18,  rev:"medinoise"},
  {n:65, arName:"الطلاق",     frName:"Le Divorce",        enName:"The Divorce",       verses:12,  rev:"medinoise"},
  {n:66, arName:"التحريم",    frName:"L'Interdiction",    enName:"The Prohibition",   verses:12,  rev:"medinoise"},
  {n:67, arName:"الملك",      frName:"Le Royaume",        enName:"The Sovereignty",   verses:30,  rev:"mecquoise"},
  {n:68, arName:"القلم",      frName:"La Plume",          enName:"The Pen",           verses:52,  rev:"mecquoise"},
  {n:69, arName:"الحاقة",     frName:"L'Inéluctable",     enName:"The Reality",       verses:52,  rev:"mecquoise"},
  {n:70, arName:"المعارج",    frName:"Les Voies d'accès", enName:"The Ascending Stairways",verses:44,rev:"mecquoise"},
  {n:71, arName:"نوح",        frName:"Noé",               enName:"Noah",              verses:28,  rev:"mecquoise"},
  {n:72, arName:"الجن",       frName:"Les Djinns",        enName:"The Jinn",          verses:28,  rev:"mecquoise"},
  {n:73, arName:"المزمل",     frName:"L'Enveloppé",       enName:"The Enshrouded One",verses:20,  rev:"mecquoise"},
  {n:74, arName:"المدثر",     frName:"Le Revêtu",         enName:"The Cloaked One",   verses:56,  rev:"mecquoise"},
  {n:75, arName:"القيامة",    frName:"La Résurrection",   enName:"The Resurrection",  verses:40,  rev:"mecquoise"},
  {n:76, arName:"الإنسان",    frName:"L'Homme",           enName:"The Man",           verses:31,  rev:"medinoise"},
  {n:77, arName:"المرسلات",   frName:"Les Envoyés",       enName:"The Emissaries",    verses:50,  rev:"mecquoise"},
  {n:78, arName:"النبأ",      frName:"La Nouvelle",       enName:"The Tidings",       verses:40,  rev:"mecquoise"},
  {n:79, arName:"النازعات",   frName:"Ceux qui arrachent",enName:"Those who drag forth",verses:46,rev:"mecquoise"},
  {n:80, arName:"عبس",        frName:"Il a froncé",       enName:"He Frowned",        verses:42,  rev:"mecquoise"},
  {n:81, arName:"التكوير",    frName:"L'Enroulement",     enName:"The Overthrowing",  verses:29,  rev:"mecquoise"},
  {n:82, arName:"الانفطار",   frName:"La Déchirure",      enName:"The Cleaving",      verses:19,  rev:"mecquoise"},
  {n:83, arName:"المطففين",   frName:"Les Fraudeurs",     enName:"The Defrauding",    verses:36,  rev:"mecquoise"},
  {n:84, arName:"الانشقاق",   frName:"La Fissure",        enName:"The Sundering",     verses:25,  rev:"mecquoise"},
  {n:85, arName:"البروج",     frName:"Les Constellations",enName:"The Mansions of the Stars",verses:22,rev:"mecquoise"},
  {n:86, arName:"الطارق",     frName:"L'Astre nocturne",  enName:"The Morning Star",  verses:17,  rev:"mecquoise"},
  {n:87, arName:"الأعلى",     frName:"Le Très Haut",      enName:"The Most High",     verses:19,  rev:"mecquoise"},
  {n:88, arName:"الغاشية",    frName:"L'Envahissante",    enName:"The Overwhelming",  verses:26,  rev:"mecquoise"},
  {n:89, arName:"الفجر",      frName:"L'Aurore",          enName:"The Dawn",          verses:30,  rev:"mecquoise"},
  {n:90, arName:"البلد",      frName:"La Cité",           enName:"The City",          verses:20,  rev:"mecquoise"},
  {n:91, arName:"الشمس",      frName:"Le Soleil",         enName:"The Sun",           verses:15,  rev:"mecquoise"},
  {n:92, arName:"الليل",      frName:"La Nuit",           enName:"The Night",         verses:21,  rev:"mecquoise"},
  {n:93, arName:"الضحى",      frName:"Le Matin",          enName:"The Morning Hours", verses:11,  rev:"mecquoise"},
  {n:94, arName:"الشرح",      frName:"L'Ouverture",       enName:"The Relief",        verses:8,   rev:"mecquoise"},
  {n:95, arName:"التين",      frName:"Le Figuier",        enName:"The Fig",           verses:8,   rev:"mecquoise"},
  {n:96, arName:"العلق",      frName:"Le Caillot",        enName:"The Clot",          verses:19,  rev:"mecquoise"},
  {n:97, arName:"القدر",      frName:"La Nuit du Destin", enName:"The Power",         verses:5,   rev:"mecquoise"},
  {n:98, arName:"البينة",     frName:"La Preuve",         enName:"The Clear Proof",   verses:8,   rev:"medinoise"},
  {n:99, arName:"الزلزلة",    frName:"Le Séisme",         enName:"The Earthquake",    verses:8,   rev:"medinoise"},
  {n:100,arName:"العاديات",   frName:"Les Coureurs",      enName:"The Courser",       verses:11,  rev:"mecquoise"},
  {n:101,arName:"القارعة",    frName:"Le Fracas",         enName:"The Calamity",      verses:11,  rev:"mecquoise"},
  {n:102,arName:"التكاثر",    frName:"L'Accumulation",    enName:"The Rivalry in World Increase",verses:8,rev:"mecquoise"},
  {n:103,arName:"العصر",      frName:"Le Temps",          enName:"The Declining Day", verses:3,   rev:"mecquoise"},
  {n:104,arName:"الهمزة",     frName:"Le Médisant",       enName:"The Traducer",      verses:9,   rev:"mecquoise"},
  {n:105,arName:"الفيل",      frName:"L'Éléphant",        enName:"The Elephant",      verses:5,   rev:"mecquoise"},
  {n:106,arName:"قريش",       frName:"Quraysh",           enName:"Quraysh",           verses:4,   rev:"mecquoise"},
  {n:107,arName:"الماعون",    frName:"L'Ustensile",       enName:"The Small Kindnesses",verses:7, rev:"mecquoise"},
  {n:108,arName:"الكوثر",     frName:"L'Abondance",       enName:"The Abundance",     verses:3,   rev:"mecquoise"},
  {n:109,arName:"الكافرون",   frName:"Les Mécréants",     enName:"The Disbelievers",  verses:6,   rev:"mecquoise"},
  {n:110,arName:"النصر",      frName:"Le Secours",        enName:"The Divine Support",verses:3,   rev:"medinoise"},
  {n:111,arName:"المسد",      frName:"Les Fibres",        enName:"The Palm Fibre",    verses:5,   rev:"mecquoise"},
  {n:112,arName:"الإخلاص",    frName:"Le Monothéisme pur",enName:"The Sincerity",     verses:4,   rev:"mecquoise"},
  {n:113,arName:"الفلق",      frName:"L'Aube naissante",  enName:"The Daybreak",      verses:5,   rev:"mecquoise"},
  {n:114,arName:"الناس",      frName:"Les Hommes",        enName:"Mankind",           verses:6,   rev:"mecquoise"}
];

// ======================================================
// INIT
// ======================================================
document.addEventListener('DOMContentLoaded', () => {
  allSurahs = SURAHS_DATA;
  renderSurahList(allSurahs);
});

// ======================================================
// RENDU LISTE SOURATES
// ======================================================
function renderSurahList(surahs) {
  const list = document.getElementById('surahList');
  if (!surahs.length) {
    list.innerHTML = `<div class="loading-state"><i class="bi bi-search" style="font-size:24px;color:var(--text-muted)"></i><span>Aucune sourate trouvée</span></div>`;
    return;
  }
  list.innerHTML = surahs.map(s => {
    const name = currentLang === 'en' ? s.enName : s.frName;
    const badge = s.rev === 'mecquoise'
      ? '<span class="revelation-badge revelation-mecque">Mecque</span>'
      : '<span class="revelation-badge revelation-medine">Médine</span>';
    return `
      <div class="surah-item ${currentSurahNum === s.n ? 'active' : ''}"
           onclick="loadSurah(${s.n})" id="item-${s.n}">
        <div class="surah-num">${s.n}</div>
        <div class="surah-info">
          <div class="surah-name-fr">${name}</div>
          <div class="surah-meta">${s.verses} versets &nbsp;·&nbsp; ${badge}</div>
        </div>
        <div class="surah-name-ar">${s.arName}</div>
      </div>`;
  }).join('');
}

// ======================================================
// FILTRES
// ======================================================
function filterSurahs(q) {
  const term = q.toLowerCase().trim();
  const filtered = allSurahs.filter(s => {
    const name = (currentLang === 'en' ? s.enName : s.frName).toLowerCase();
    const matchType = currentType === 'all' || s.rev === currentType;
    return matchType && (name.includes(term) || s.arName.includes(term) || String(s.n) === term);
  });
  renderSurahList(filtered);
}

function filterByType(type, btn) {
  currentType = type;
  document.querySelectorAll('.type-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  filterSurahs(document.getElementById('searchInput').value);
}

// ======================================================
// CHARGEMENT SOURATE VIA API
// ======================================================
async function loadSurah(num) {
  currentSurahNum = num;
  currentVerseIdx = 0;
  stopAudio();

  // UI : état actif dans la liste
  document.querySelectorAll('.surah-item').forEach(el => el.classList.remove('active'));
  const el = document.getElementById(`item-${num}`);
  if (el) { el.classList.add('active'); el.scrollIntoView({ block: 'nearest' }); }

  // Afficher le panneau
  document.getElementById('welcomeState').style.display = 'none';
  const content = document.getElementById('surahContent');
  content.style.display = 'flex';

  // Afficher le loading
  document.getElementById('versesContainer').innerHTML =
    `<div class="loading-state"><div class="spinner"></div><span>Chargement…</span></div>`;

  const surah = SURAHS_DATA.find(s => s.n === num);
  const edition = langEditions[currentLang];

  // Header
  renderHeader(surah);

  // Bismillah : cacher pour Fatiha (1) et Tawba (9)
  document.getElementById('bismillahBlock').style.display =
    (num === 1 || num === 9) ? 'none' : 'block';

  // Stats
  renderStats(surah);

  // Charger versets arabe + traduction en parallèle
  try {
    const [arRes, trRes] = await Promise.all([
      fetch(`${API_BASE}/surah/${num}`).then(r => r.json()),
      fetch(`${API_BASE}/surah/${num}/${edition}`).then(r => r.json())
    ]);

    if (arRes.code !== 200 || trRes.code !== 200) throw new Error('API error');

    currentVerses = arRes.data.ayahs.map((v, i) => ({
      num: v.numberInSurah,
      arabic: v.text,
      translation: trRes.data.ayahs[i]?.text || '',
      audioKey: `${currentReciter}/${v.number}.mp3`
    }));

    renderVerses();

  } catch(e) {
    document.getElementById('versesContainer').innerHTML =
      `<div class="loading-state" style="color:#f96868">
        <i class="bi bi-exclamation-circle" style="font-size:28px"></i>
        <span>Erreur de chargement. Vérifiez votre connexion.</span>
       </div>`;
  }
}

// ======================================================
// RENDU HEADER SOURATE
// ======================================================
function renderHeader(s) {
  const name = currentLang === 'en' ? s.enName : s.frName;
  const badge = s.rev === 'mecquoise'
    ? `<span class="revelation-badge revelation-mecque"><i class="bi bi-geo-alt"></i> Mecquoise</span>`
    : `<span class="revelation-badge revelation-medine"><i class="bi bi-geo-alt"></i> Médinoise</span>`;

  document.getElementById('surahHeader').innerHTML = `
    <div class="surah-header-left">
      <div class="surah-number-badge">
        <i class="bi bi-book"></i> Sourate ${s.n}
      </div>
      <div class="surah-title-fr">${name}</div>
      <div class="surah-title-sub">${s.verses} versets · ${badge}</div>
    </div>
    <div class="surah-header-right">
      <div class="surah-title-ar">${s.arName}</div>
      <div class="surah-revelation" style="margin-top:4px;font-size:12px;color:var(--text-muted)">
        <i class="bi bi-headphones"></i>
        <span id="recitersLabel">Mishary Alafasy</span>
      </div>
    </div>`;
}

function renderStats(s) {
  const name = currentLang === 'en' ? s.enName : s.frName;
  document.getElementById('surahStats').innerHTML = `
    <div class="stat-chip"><i class="bi bi-hash"></i> Sourate ${s.n}/114</div>
    <div class="stat-chip"><i class="bi bi-layers"></i> ${s.verses} versets</div>
    <div class="stat-chip"><i class="bi bi-translate"></i> ${name}</div>
    <div class="stat-chip"><i class="bi bi-globe"></i> ${s.rev === 'mecquoise' ? 'Révélée à la Mecque' : 'Révélée à Médine'}</div>
  `;
}

// ======================================================
// RENDU VERSETS
// ======================================================
function renderVerses() {
  const showTr = document.getElementById('showTranslation').checked;
  const fontSize = document.getElementById('fontSizeSelect').value;

  const html = currentVerses.map((v, i) => `
    <div class="verse-card ${currentVerseIdx === i && isPlaying ? 'playing' : ''}"
         id="verse-card-${i}">
      <div class="verse-number-col">
        <div class="verse-num-badge">${v.num}</div>
        <button class="verse-play-btn" onclick="playVerse(${i})" title="Lire ce verset">
          <i class="bi bi-play-fill" id="vbtn-icon-${i}"></i>
        </button>
      </div>
      <div class="verse-content-col">
        <div class="verse-arabic" style="font-size:${fontSize}px">${v.arabic}</div>
        <div class="verse-translation ${showTr ? 'visible' : ''}" id="tr-${i}">
          ${v.translation}
        </div>
        <div class="verse-actions">
          <button class="verse-action-btn" onclick="playVerse(${i})">
            <i class="bi bi-play-circle"></i> Écouter
          </button>
          <button class="verse-action-btn" onclick="toggleVerseTranslation(${i})">
            <i class="bi bi-translate"></i> Traduction
          </button>
          <button class="verse-action-btn" onclick="copyVerse(${i})">
            <i class="bi bi-clipboard"></i> Copier
          </button>
          <button class="verse-action-btn" onclick="shareVerse(${i})">
            <i class="bi bi-share"></i> Partager
          </button>
        </div>
      </div>
    </div>`).join('');

  document.getElementById('versesContainer').innerHTML = html;
}

// ======================================================
// LECTEUR AUDIO
// ======================================================
function playVerse(idx) {
  const wasPlaying = isPlaying && currentVerseIdx === idx;
  stopAudio();
  if (wasPlaying) return;

  currentVerseIdx = idx;
  const verse = currentVerses[idx];
  const url = `${AUDIO_BASE}${verse.audioKey}`;

  audioEl.src = url;
  audioEl.load();
  audioEl.play().then(() => {
    isPlaying = true;
    updatePlayerUI();
  }).catch(e => console.warn('Audio error:', e));
}

function stopAudio() {
  audioEl.pause();
  audioEl.src = '';
  isPlaying = false;
  updatePlayerUI();
}

function togglePlay() {
  if (!currentVerses.length) return;
  if (isPlaying) {
    audioEl.pause();
    isPlaying = false;
  } else {
    if (!audioEl.src) playVerse(currentVerseIdx);
    else audioEl.play().then(() => { isPlaying = true; updatePlayerUI(); });
  }
  updatePlayerUI();
}

function prevVerse() {
  if (currentVerseIdx > 0) playVerse(currentVerseIdx - 1);
}

function nextVerse() {
  if (currentVerseIdx < currentVerses.length - 1) playVerse(currentVerseIdx + 1);
}

function toggleLoop() {
  isLooping = !isLooping;
  audioEl.loop = isLooping;
  document.getElementById('loopBtn').style.color = isLooping ? 'var(--green)' : '';
}

function setVolume(v) {
  audioEl.volume = parseFloat(v);
}

function seekAudio(e) {
  if (!audioEl.duration) return;
  const rect = e.currentTarget.getBoundingClientRect();
  const ratio = (e.clientX - rect.left) / rect.width;
  audioEl.currentTime = ratio * audioEl.duration;
}

function updatePlayerUI() {
  const playIcon = document.getElementById('mainPlayIcon');
  playIcon.className = isPlaying ? 'bi bi-pause-fill' : 'bi bi-play-fill';

  // Mise à jour cartes versets
  document.querySelectorAll('.verse-card').forEach((card, i) => {
    card.classList.toggle('playing', isPlaying && i === currentVerseIdx);
    const icon = document.getElementById(`vbtn-icon-${i}`);
    if (icon) icon.className = (isPlaying && i === currentVerseIdx) ? 'bi bi-pause-fill' : 'bi bi-play-fill';
  });

  // Scroll vers le verset actif
  const activeCard = document.getElementById(`verse-card-${currentVerseIdx}`);
  if (activeCard && isPlaying) activeCard.scrollIntoView({ behavior: 'smooth', block: 'center' });

  // Label now playing
  if (currentVerses[currentVerseIdx]) {
    document.getElementById('nowPlayingLabel').textContent =
      `Sourate ${currentSurahNum} · Verset ${currentVerses[currentVerseIdx].num}`;
  }
}

// Barre de progression
audioEl.addEventListener('timeupdate', () => {
  if (!audioEl.duration) return;
  const pct = (audioEl.currentTime / audioEl.duration) * 100;
  document.getElementById('progressBar').style.width = pct + '%';
  document.getElementById('timeElapsed').textContent = formatTime(audioEl.currentTime);
  document.getElementById('timeDuration').textContent = formatTime(audioEl.duration);
});

audioEl.addEventListener('ended', () => {
  if (document.getElementById('autoPlay').checked) {
    nextVerse();
  } else {
    isPlaying = false;
    updatePlayerUI();
  }
});

function formatTime(sec) {
  const m = Math.floor(sec / 60);
  const s = Math.floor(sec % 60);
  return `${m}:${s.toString().padStart(2, '0')}`;
}

// ======================================================
// OPTIONS LECTURE
// ======================================================
function changeReciter() {
  currentReciter = document.getElementById('recitersSelect').value;
  const label = document.getElementById('recitersLabel');
  if (label) label.textContent = document.getElementById('recitersSelect').selectedOptions[0].text;
  stopAudio();
  // Mettre à jour les URLs audio des versets
  currentVerses = currentVerses.map((v, i) => ({
    ...v,
    audioKey: `${currentReciter}/${SURAHS_DATA.find(s => s.n === currentSurahNum) ? getGlobalVerseNum(currentSurahNum, i+1) : v.num}.mp3`
  }));
}

function getGlobalVerseNum(surahNum, verseInSurah) {
  // Calcul du numéro global du verset (approximatif, pour l'API audio)
  const prev = SURAHS_DATA.filter(s => s.n < surahNum).reduce((acc, s) => acc + s.verses, 0);
  return prev + verseInSurah;
}

function changeFontSize() {
  const size = document.getElementById('fontSizeSelect').value;
  document.querySelectorAll('.verse-arabic').forEach(el => {
    el.style.fontSize = size + 'px';
  });
}

function toggleTranslations() {
  const show = document.getElementById('showTranslation').checked;
  document.querySelectorAll('.verse-translation').forEach(el => {
    el.classList.toggle('visible', show);
  });
}

function toggleVerseTranslation(idx) {
  const el = document.getElementById(`tr-${idx}`);
  if (el) el.classList.toggle('visible');
}

function copyVerse(idx) {
  const v = currentVerses[idx];
  const text = `${v.arabic}\n\n${v.translation}\n\n(Sourate ${currentSurahNum}, Verset ${v.num})`;
  navigator.clipboard.writeText(text).then(() => {
    showToast('Verset copié !');
  });
}

function shareVerse(idx) {
  const v = currentVerses[idx];
  if (navigator.share) {
    navigator.share({
      title: `Sourate ${currentSurahNum}, Verset ${v.num}`,
      text: `${v.arabic}\n\n${v.translation}`
    });
  } else {
    copyVerse(idx);
  }
}

// ======================================================
// LANGUE
// ======================================================
function setLang(lang, btn) {
  currentLang = lang;
  document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  renderSurahList(allSurahs);
  if (currentSurahNum) loadSurah(currentSurahNum);
}

// ======================================================
// TOAST
// ======================================================
function showToast(msg) {
  const t = document.createElement('div');
  t.textContent = msg;
  t.style.cssText = `
    position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%);
    background: var(--dark); color: white; padding: 10px 20px;
    border-radius: 20px; font-size: 13px; font-family: var(--font);
    z-index: 9999; animation: fadeUp .3s ease;
    box-shadow: 0 4px 16px rgba(0,0,0,.2);
  `;
  document.body.appendChild(t);
  setTimeout(() => t.remove(), 2000);
}
</script>

</body>
</html>