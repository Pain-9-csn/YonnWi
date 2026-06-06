<?php
/**
 * @var string $lang
 * @var array $traduction
 * @var string $dateGreg
 * @var string $dateHijri
 * @var string $ville
 * @var string $pays
 * @var array $timings
 * @var string $priereActive
 */
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $traduction['dir'] ?>">

<head>

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $traduction['titre'] ?></title>

    <link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
        font-family:'Poppins',sans-serif;
        }

        #preloader{
        display:none!important;
        }

        body{

        background:
        linear-gradient(
        135deg,
        #032b1f 0%,
        #0b5d39 40%,
        #0f7a45 100%
        );

        min-height:100vh;
        color:white;

        }

        .main-title{

        font-size:56px;
        font-weight:700;
        color:#fff;

        }

        .sub-title{

        color:#d7f2dd;
        font-size:1.15rem;

        }

        .search-box{

        background:rgba(255,255,255,.08);

        backdrop-filter:blur(12px);

        border:1px solid rgba(255,255,255,.12);

        border-radius:28px;

        padding:30px;

        box-shadow:
        0 10px 40px rgba(0,0,0,.20);

        }

        .search-box .form-control{

        background:rgba(255,255,255,.10);

        border:1px solid rgba(255,255,255,.12);

        color:#fff;

        height:54px;

        border-radius:18px;

        }

        .search-box .form-control::placeholder{

        color:rgba(255,255,255,.55);

        }

        .search-box .form-control:focus{

        background:rgba(255,255,255,.15);

        border-color:#8fd694;

        box-shadow:none;

        color:white;

        }

        .btn-search{

        background:#167a43!important;

        border:none!important;

        height:54px;

        border-radius:18px!important;

        font-weight:600;

        }

        .btn-search:hover{

        background:#0f6135!important;

        }

        .prayer-card{

        background:#ffffff;

        border-radius:28px;

        padding:30px 18px;

        text-align:center;

        transition:.35s;

        height:100%;

        box-shadow:

        0 8px 25px rgba(0,0,0,.10);

        }

        .prayer-card:hover{

        transform:translateY(-8px);

        }

        .prayer-card.active-prayer{

        background:

        linear-gradient(
        180deg,
        #12653c,
        #0b4d2d
        );

        color:white;

        border:1px solid rgba(255,255,255,.15);

        }

        .prayer-icon{

        width:78px;
        height:78px;

        border-radius:50%;

        display:flex;

        justify-content:center;

        align-items:center;

        margin:auto auto 18px;

        background:#edf6ef;

        }

        .prayer-icon i{

        font-size:30px;

        color:#0f6a3d;

        }

        .active-prayer .prayer-icon{

        background:rgba(255,255,255,.12);

        }

        .active-prayer .prayer-icon i{

        color:#c4f0c9;

        }

        .prayer-label{

        font-weight:700;

        font-size:1.1rem;

        color:#0d5d35;

        }

        .prayer-time{

        font-size:2.4rem;

        font-weight:700;

        color:#0f6a3d;

        }

        .active-prayer .prayer-time{

        color:white;

        }

        .badge-prochaine{

        background:rgba(255,255,255,.12);

        padding:8px 14px;

        border-radius:20px;

        font-size:.8rem;

        margin-bottom:15px;

        display:inline-block;

        }

        .sun-card{

        background:rgba(255,255,255,.08);

        border:1px solid rgba(255,255,255,.10);

        backdrop-filter:blur(12px);

        border-radius:24px;

        padding:25px 35px;

        display:flex;

        justify-content:center;

        align-items:center;

        gap:50px;

        width:fit-content;

        min-width:420px;

        margin:70px auto 80px auto;

        box-shadow:
        0 8px 25px rgba(0,0,0,.15);

        }

        .sun-item{

        text-align:center;

        min-width:120px;

        }

        .sun-item i{

        font-size:1.7rem;

        margin-bottom:8px;

        display:block;

        }

        .sun-item span{

        display:block;

        font-size:.95rem;

        opacity:.85;

        margin-bottom:6px;

        }

        .sun-item strong{

        font-size:1.4rem;

        font-weight:700;

        color:white;

        }

        .sun-card .vr{

        height:60px;

        border-color:
        rgba(255,255,255,.18)!important;

        }
        .prayer-name {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 4px;
            display: block !important;
        }

        .event-date {
            color: #777;
            font-size: .85rem;
            display: block !important;
            margin-top: 6px;
            font-weight: 500;
        }

    </style>

</head>

<body class="index-page">

<?php require_once __DIR__ . '/../../../sections/vitrine/menu.php'; ?>

<div class="container py-5">

    <!-- TITRE -->
    <div class="text-center mb-5">
        <h1 class="main-title"><?= $traduction['titre'] ?></h1>
        <p class="sub-title"><?= $traduction['sous_titre'] ?></p>
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
                    placeholder="<?= $traduction['ville'] ?>"
                    value="<?= htmlspecialchars($ville) ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="pays" class="form-control"
                    placeholder="<?= $traduction['pays'] ?>"
                    value="<?= htmlspecialchars($pays) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-search w-100">
                    <i class="bi bi-search"></i> <?= $traduction['rechercher'] ?>
                </button>
            </div>
        </form>
    </div>

    <!-- PRIERES -->
    <div class="row g-4 justify-content-center">

        <?php
        $prieres = [

        'Fajr' => [
        'label' => $traduction['prieres']['Fajr'],
        'icon' => 'moon-stars-fill'
        ],

        'Dhuhr' => [
        'label' => $traduction['prieres']['Dhuhr'],
        'icon' => 'sun-fill'
        ],

        'Asr' => [
        'label' => $traduction['prieres']['Asr'],
        'icon' => 'brightness-high-fill'
        ],

        'Maghrib' => [
        'label' => $traduction['prieres']['Maghrib'],
        'icon' => 'sunset-fill'
        ],

        'Isha' => [
        'label' => $traduction['prieres']['Isha'],
        'icon' => 'stars'
        ]

        ];

        foreach ($prieres as $key => $data):
            $heure    = $timings[$key] ?? '--:--';
            $isActive = ($key === $priereActive);
        ?>

        <div class="col-lg-2 col-md-4 col-6">
            <div class="prayer-card <?= $isActive ? 'active-prayer' : '' ?>">

                <?php if ($isActive): ?>
                    <div class="badge-prochaine">
                        ⏰ <?= $traduction['prochaine'] ?> &nbsp;|&nbsp; <span id="countdown"></span>
                    </div>
                <?php endif; ?>

                <div class="prayer-icon">
                    <i class="bi bi-<?= $data['icon'] ?>"></i>
                </div>
                <div class="prayer-name">
                    <?= $traduction['prieres'][$key] ?>
                </div>

                <div class="prayer-label">
                    <?= $data['label'] ?>
                </div>
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
            <span><?= $traduction['souba'] ?></span>
            <strong><?= htmlspecialchars($timings['Sunrise']) ?></strong>
        </div>
        <div class="vr" style="border-color:rgba(255,255,255,0.2);"></div>
        <div class="sun-item">
            <i class="bi bi-sunset-fill" style="color:#ff6b6b;"></i>
            <span><?= $traduction['coucher'] ?></span>
            <strong><?= htmlspecialchars($timings['Sunset']) ?></strong>
        </div>
    </div>
    <?php endif; ?>

    <!-- DATES IMPORTANTES -->
    <div class="mt-5">
        <div class="text-center mb-4">
            <h2 style="font-weight:700;"><?= $traduction['dates'] ?></h2>
        </div>

        <div class="row g-4 justify-content-center">
            <?php
            $events = [
    [
        'title' => $lang=='ar' ? 'بداية رمضان' : ($lang=='en' ? 'Beginning of Ramadan' : ($lang=='wo' ? 'Tambali Weeru Koor' : 'Début du Ramadan')),
        'date_hijri' => '1 Ramadan 1447',
        'date_fr' => '18 Février 2026',
        'icon' => 'moon-stars-fill'
    ],
    [
        'title' => $lang=='ar' ? 'عيد الفطر' : ($lang=='en' ? 'Eid al-Fitr' : ($lang=='wo' ? 'Korite' : 'Korité')),
        'date_hijri' => '1 Shawwal 1447',
        'date_fr' => '21 Mars 2026',
        'icon' => 'stars'
    ],
    [
        'title' => $lang=='ar' ? 'يوم عرفة' : ($lang=='en' ? 'Day of Arafat' : ($lang=='wo' ? 'Bésu Arafat' : 'Jour de Arafat')),
        'date_hijri' => '9 Dhul Hijja 1447',
        'date_fr' => '26 Mai 2026',
        'icon' => 'calendar-event-fill'
    ],
    [
        'title' => $lang=='ar' ? 'عيد الأضحى' : ($lang=='en' ? 'Eid al-Adha' : ($lang=='wo' ? 'Tabaski' : 'Tabaski')),
        'date_hijri' => '10 Dhul Hijja 1447',
        'date_fr' => '27 Mai 2026',
        'icon' => 'sun-fill'
    ],
    [
        'title' => $lang=='ar' ? 'رأس السنة الهجرية' : ($lang=='en' ? 'Islamic New Year' : ($lang=='wo' ? 'Ñu Hitaale Islamik' : 'Nouvel An Islamique')),
        'date_hijri' => '1 Muharram 1448',
        'date_fr' => '16 Juin 2026',
        'icon' => 'calendar2-week-fill'
    ],
    [
        'title' => $lang=='ar' ? 'عاشوراء' : ($lang=='en' ? 'Tamkharit' : ($lang=='wo' ? 'Tamkharit' : 'Tamkharit')),
        'date_hijri' => '10 Muharram 1448',
        'date_fr' => '25 Juin 2026',
        'icon' => 'moon-fill'
    ],
    [
        'title' => $lang=='ar' ? 'ماغال طوبى' : ($lang=='en' ? 'Grand Magal de Touba' : ($lang=='wo' ? 'Màggal Tuubaa' : 'Grand Magal de Touba')),
        'date_hijri' => '18 Safar 1448',
        'date_fr' => '3 Août 2026',
        'icon' => 'building-fill'
    ],
    [
        'title' => $lang=='ar' ? 'المولد النبوي' : ($lang=='en' ? 'Gamou' : ($lang=='wo' ? 'Gammu' : 'Gamou')),
        'date_hijri' => '12 Rabi al-Awwal 1448',
        'date_fr' => '25 Août 2026',
        'icon' => 'calendar-heart-fill'
    ],
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
    <?= $traduction['activer'] ?>
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

    const txtActiver   = "<?= $traduction['activer'] ?>";
    const txtDesactiver = "<?= $traduction['desactiver'] ?>";

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
        const txtDans = "<?= $traduction['dans'] ?>";

        const prayerNames = <?= json_encode($traduction['prieres']) ?>;

        el.innerHTML = "<strong>" + (prayerNames[nextPrayer.prayer] || nextPrayer.prayer) + "</strong> " + txtDans + " "
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