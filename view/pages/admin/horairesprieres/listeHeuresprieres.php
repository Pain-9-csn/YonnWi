<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $t['dir'] ?>">

<head>

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $t['titre'] ?></title>

    <link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        * { font-family: 'Poppins', sans-serif; }
        #preloader { display: none !important; }

        body {
            background: #2e7d32;
            min-height: 100vh;
            color: white;
        }

        .main-title { font-size: 48px; font-weight: 700; color: #fff; }
        .sub-title { color: #c8e6c9; }

        .search-box {
            background: rgba(0,0,0,0.15);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 40px;
        }

        .search-box .form-control {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            border-radius: 10px;
        }

        .search-box .form-control::placeholder { color: rgba(255,255,255,0.5); }

        .search-box .form-control:focus {
            background: rgba(255,255,255,0.2);
            border-color: #fff;
            color: #fff;
            box-shadow: none;
        }

        .btn-search {
            background: #1b5e20 !important;
            border: none !important;
            color: #fff !important;
            font-weight: 600;
            border-radius: 10px !important;
        }

        .btn-search:hover { background: #154a19 !important; }

        .prayer-card {
            background: #fff;
            border-radius: 20px;
            padding: 28px 15px;
            text-align: center;
            border: none;
            transition: .3s;
            height: 100%;
        }

        .prayer-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .prayer-card.active-prayer {
            background: #1b5e20;
            border: 2px solid #fff;
            color: #fff;
        }

        .prayer-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e8f5e9;
        }

        .prayer-icon i { font-size: 28px; color: #2e7d32; }
        .active-prayer .prayer-icon { background: rgba(255,255,255,0.15); }
        .active-prayer .prayer-icon i { color: #71c55d; }

        .prayer-name { font-size: 0.8rem; color: #999; margin-bottom: 4px; }
        .active-prayer .prayer-name { color: #a5d6a7; }

        .prayer-label { font-size: 1rem; font-weight: 600; color: #1b5e20; margin-bottom: 8px; }
        .active-prayer .prayer-label { color: #c8e6c9; }

        .prayer-time { font-size: 2rem; font-weight: 700; color: #2e7d32; }
        .active-prayer .prayer-time { color: #fff; }

        .badge-prochaine {
            background: rgba(113,197,93,0.2);
            color: #71c55d;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 8px;
            border: 1px solid rgba(113,197,93,0.4);
        }

        .sun-card {
            background: rgba(0,0,0,0.15);
            border-radius: 16px;
            padding: 20px 40px;
            display: flex;
            justify-content: center;
            gap: 3rem;
            max-width: 380px;
            margin: 30px auto 0;
        }

        .sun-item { text-align: center; }
        .sun-item i { font-size: 1.5rem; display: block; margin-bottom: 4px; }
        .sun-item span { font-size: 0.8rem; color: rgba(255,255,255,0.6); display: block; }
        .sun-item strong { font-size: 1.1rem; color: #fff; }

        .event-date { color: #777; font-size: .85rem; display: block; margin-top: 6px; font-weight: 500; }

    </style>

</head>

<body class="index-page">

<?php require_once __DIR__ . '/../../../sections/vitrine/menu.php'; ?>

<div class="container py-5">

    <!-- TITRE -->
    <div class="text-center mb-5">
        <h1 class="main-title"><?= $t['titre'] ?></h1>
        <p class="sub-title"><?= $t['sous_titre'] ?></p>
    </div>

    <!-- DATE -->
    <div class="text-center mb-4">
        <h4 style="color:#71c55d;"><?= $dateGreg ?></h4>
        <p class="mb-0" style="color:rgba(255,255,255,0.5);"><?= $dateHijri ?></p>
    </div>

    <!-- FORM -->
    <div class="search-box mb-5">
        <form method="GET" action="index.php" class="row g-3 justify-content-center">
            <input type="hidden" name="action" value="horairesprieres">
            <div class="col-md-4">
                <input type="text" name="ville" class="form-control"
                    placeholder="<?= $t['ville'] ?>"
                    value="<?= htmlspecialchars($ville) ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="pays" class="form-control"
                    placeholder="<?= $t['pays'] ?>"
                    value="<?= htmlspecialchars($pays) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-search w-100">
                    <i class="bi bi-search"></i> <?= $t['rechercher'] ?>
                </button>
            </div>
        </form>
    </div>

    <!-- PRIERES -->
    <div class="row g-4 justify-content-center">

        <?php
        $prieres = [
            'Fajr'    => ['label' => 'Fadjr',    'icon' => 'moon-stars-fill'],
            'Dhuhr'   => ['label' => 'Tisbar',   'icon' => 'sun-fill'],
            'Asr'     => ['label' => 'Takussan', 'icon' => 'brightness-high-fill'],
            'Maghrib' => ['label' => 'Timis',    'icon' => 'sunset-fill'],
            'Isha'    => ['label' => 'Gué',      'icon' => 'stars'],
        ];

        foreach ($prieres as $key => $data):
            $heure    = $timings[$key] ?? '--:--';
            $isActive = ($key === $priereActive);
        ?>

        <div class="col-lg-2 col-md-4 col-6">
            <div class="prayer-card <?= $isActive ? 'active-prayer' : '' ?>">

                <?php if ($isActive): ?>
                    <div class="badge-prochaine">
                        ⏰ <?= $t['prochaine'] ?> &nbsp;|&nbsp; <span id="countdown"></span>
                    </div>
                <?php endif; ?>

                <div class="prayer-icon">
                    <i class="bi bi-<?= $data['icon'] ?>"></i>
                </div>
                <div class="prayer-name"><?= $key ?></div>
                <div class="prayer-label"><?= $data['label'] ?></div>
                <div class="prayer-time"><?= $heure ?></div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>

    <!-- LEVER / COUCHER -->
    <?php if (!empty($timings['Sunrise']) && !empty($timings['Sunset'])): ?>
    <div class="sun-card">
        <div class="sun-item">
            <i class="bi bi-sunrise-fill text-warning"></i>
            <span><?= $t['souba'] ?></span>
            <strong><?= htmlspecialchars($timings['Sunrise']) ?></strong>
        </div>
        <div class="vr" style="border-color:rgba(255,255,255,0.2);"></div>
        <div class="sun-item">
            <i class="bi bi-sunset-fill" style="color:#ff6b6b;"></i>
            <span><?= $t['coucher'] ?></span>
            <strong><?= htmlspecialchars($timings['Sunset']) ?></strong>
        </div>
    </div>
    <?php endif; ?>

    <!-- DATES IMPORTANTES -->
    <div class="mt-5">
        <div class="text-center mb-4">
            <h2 style="font-weight:700;"><?= $t['dates'] ?></h2>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            $events = [
                ['title'=>'Début du Ramadan',    'date_hijri'=>'1 Ramadan 1447',       'date_fr'=>'18 Février 2026', 'icon'=>'moon-stars-fill'],
                ['title'=>'Korité',              'date_hijri'=>'1 Shawwal 1447',        'date_fr'=>'20 Mars 2026',    'icon'=>'stars'],
                ['title'=>'Jour de Arafat',      'date_hijri'=>'9 Dhul Hijja 1447',     'date_fr'=>'26 Mai 2026',     'icon'=>'calendar-event-fill'],
                ['title'=>'Tabaski',             'date_hijri'=>'10 Dhul Hijja 1447',    'date_fr'=>'27 Mai 2026',     'icon'=>'sun-fill'],
                ['title'=>'Nouvel An Islamique', 'date_hijri'=>'1 Muharram 1448',       'date_fr'=>'16 Juin 2026',    'icon'=>'calendar2-week-fill'],
                ['title'=>'Tamkharit',           'date_hijri'=>'10 Muharram 1448',      'date_fr'=>'25 Juin 2026',    'icon'=>'moon-fill'],
                ['title'=>'Grand Magal de Touba','date_hijri'=>'18 Safar 1448',         'date_fr'=>'3 Août 2026',     'icon'=>'building-fill'],
                ['title'=>'Gamou',               'date_hijri'=>'12 Rabi al-Awwal 1448', 'date_fr'=>'25 Août 2026',    'icon'=>'calendar-heart-fill'],
            ];

            foreach ($events as $event):
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="prayer-card">
                    <div class="prayer-icon">
                        <i class="bi bi-<?= $event['icon'] ?>"></i>
                    </div>
                    <div class="text-center">
                        <div class="prayer-label"><?= $event['title'] ?></div>
                        <div class="prayer-name"><?= $event['date_hijri'] ?></div>
                        <small class="event-date"><?= $event['date_fr'] ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../../../sections/vitrine/footer.php'; ?>

<!-- AUDIO -->
<audio id="adhanAudio">
    <source src="https://www.islamcan.com/audio/adhan/azan1.mp3" type="audio/mpeg">
</audio>

<button id="enableAudio" style="
    position:fixed; bottom:20px; right:20px; z-index:9999;
    background:#71c55d; color:#fff; border:none;
    padding:12px 20px; border-radius:20px;
    cursor:pointer; font-weight:600;">
    <?= $t['activer'] ?>
</button>

<!-- Vendor JS -->
<script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
<script src="public/templates/templateVitrine/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="public/templates/templateVitrine/assets/js/main.js"></script>

<!-- GEOLOCALISATION -->
<script>
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function(position) {
            const latitude  = position.coords.latitude;
            const longitude = position.coords.longitude;
            const currentUrl = new URL(window.location.href);
            if (!currentUrl.searchParams.get('latitude') && !currentUrl.searchParams.get('ville')) {
                window.location.href = "index.php?action=horairesprieres"
                    + "&latitude=" + latitude
                    + "&longitude=" + longitude;
            }
        },
        function(error) { console.log("Géolocalisation refusée"); }
    );
}
</script>

<!-- SCRIPT -->
<script>

const prayerTimes = <?= json_encode(array_intersect_key(
    $timings ?? [],
    array_flip(['Fajr','Dhuhr','Asr','Maghrib','Isha'])
)) ?>;

const txtActiver   = "<?= $t['activer'] ?>";
const txtDesactiver = "<?= $t['desactiver'] ?>";

// =====================================
// ACTIVATION AUDIO
// =====================================

let audioEnabled = false;

const adhanAudio = document.getElementById('adhanAudio');
const enableBtn  = document.getElementById('enableAudio');

enableBtn.addEventListener('click', function() {
    if (!audioEnabled) {
        adhanAudio.play().then(() => {
            adhanAudio.pause();
            adhanAudio.currentTime = 0;
            audioEnabled = true;
            enableBtn.innerHTML = txtDesactiver;
            enableBtn.style.background = "#c62828";
        });
    } else {
        audioEnabled = false;
        adhanAudio.pause();
        adhanAudio.currentTime = 0;
        enableBtn.innerHTML = txtActiver;
        enableBtn.style.background = "#71c55d";
    }
});

// =====================================
// PROCHAINE PRIERE
// =====================================

function getNextPrayer() {
    const now = new Date();
    for (const prayer in prayerTimes) {
        const time = prayerTimes[prayer];
        if (!time) continue;
        const parts  = time.split(':');
        const target = new Date();
        target.setHours(parseInt(parts[0]), parseInt(parts[1]), 0, 0);
        if (target > now) return { prayer, target };
    }
    if (prayerTimes['Fajr']) {
        const fajr   = prayerTimes['Fajr'].split(':');
        const target = new Date();
        target.setDate(target.getDate() + 1);
        target.setHours(parseInt(fajr[0]), parseInt(fajr[1]), 0, 0);
        return { prayer: 'Fajr', target };
    }
    return null;
}

// =====================================
// COUNTDOWN
// =====================================

function updateCountdown() {
    const nextPrayer = getNextPrayer();
    if (!nextPrayer) return;
    const now  = new Date();
    const diff = Math.floor((nextPrayer.target - now) / 1000);
    const h    = Math.floor(diff / 3600);
    const m    = Math.floor((diff % 3600) / 60);
    const s    = diff % 60;
    const el   = document.getElementById('countdown');
    if (!el) return;
    el.innerHTML = "<strong>" + nextPrayer.prayer + "</strong> dans "
        + (h > 0 ? h + 'h ' : '')
        + (m > 0 ? m + 'min ' : '')
        + s + 's';
}

// =====================================
// NOTIFICATION PRIERE
// =====================================

let lastNotification = '';

function checkPrayerNotification() {
    const now = new Date();
    const currentTime = now.getHours().toString().padStart(2,'0')
        + ':' + now.getMinutes().toString().padStart(2,'0');
    for (const prayer in prayerTimes) {
        if (currentTime === prayerTimes[prayer] && lastNotification !== prayer) {
            lastNotification = prayer;
            if (Notification.permission === "granted") {
                new Notification("🕌 Heure de prière", { body: "C'est l'heure de " + prayer });
            }
            if (adhanAudio && audioEnabled) {
                adhanAudio.play().catch(e => console.log("Erreur audio"));
            }
        }
    }
}

// =====================================
// EXECUTION
// =====================================

updateCountdown();
checkPrayerNotification();
setInterval(updateCountdown, 1000);
setInterval(checkPrayerNotification, 30000);

</script>

</body>
</html>