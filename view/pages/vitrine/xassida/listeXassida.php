<?php
/**
 * @var array $khassidas
 * @var string $lang
 * @var array $traduction
 */
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $traduction['titre_khassida'] ?? 'Khassidas PDF' ?></title>


<link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">

<link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

<link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

<style>

    :root {
        --gold:        #c9a84c;
        --gold-light:  #f0d080;
        --gold-glow:   rgba(201,168,76,.25);
        --green:       #1db87a;
        --green-dark:  #0e8a56;
        --green-glow:  rgba(29,184,122,.20);
        --blue:        #3a9bd5;
        --blue-glow:   rgba(58,155,213,.20);
        --bg-deep:     #030a0f;
        --bg-card:     rgba(255,255,255,.05);
        --border:      rgba(201,168,76,.18);
        --border-hover:rgba(201,168,76,.5);
        --text:        #f0ede6;
        --text-muted:  rgba(240,237,230,.55);
    }

    *, *::before, *::after {
        margin:0; padding:0;
        box-sizing:border-box;
        font-family:'Poppins', sans-serif;
    }

    /* ═══════════════ BODY ═══════════════ */
    body {
        background:
            linear-gradient(
                135deg,
                rgba(5,10,20,.93),
                rgba(8,18,18,.90),
                rgba(8,8,8,.95)
            ),
            url("https://6a23c995d003a5030e07d8c6.imgix.net/Touba.jfif?auto=format&fit=crop&w=1800&q=80");

        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* grain overlay */
    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        background-repeat: repeat;
        background-size: 180px;
        pointer-events: none;
        z-index: 0;
        opacity: .5;
    }

    /* ═══════════════ HERO ═══════════════ */
    .page-hero {
        position: relative;
        padding: 100px 0 70px;
        text-align: center;
        border-bottom: 1px solid var(--border);
        overflow: hidden;
    }

    .page-hero::before {
        content: "";
        position: absolute;
        top: -60px; left: 50%;
        transform: translateX(-50%);
        width: 700px; height: 300px;
        background: radial-gradient(ellipse, rgba(201,168,76,.12) 0%, transparent 70%);
        pointer-events: none;
    }

    /* decorative arabic calligraphy line */
    .page-hero::after {
        content: "بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ";
        font-family: 'Amiri', serif;
        font-size: 1.3rem;
        color: var(--gold);
        opacity: .25;
        display: block;
        margin-bottom: 24px;
        letter-spacing: .05em;
    }

    .hero-ornament {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .hero-ornament span {
        display: block;
        height: 1px;
        width: 80px;
        background: linear-gradient(90deg, transparent, var(--gold));
    }

    .hero-ornament span:last-child {
        background: linear-gradient(90deg, var(--gold), transparent);
    }

    .hero-ornament i {
        color: var(--gold);
        font-size: 1.6rem;
    }

    .page-hero h1 {
        font-size: 3.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #fff 30%, var(--gold-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        letter-spacing: -.5px;
        line-height: 1.15;
        margin-bottom: 14px;
    }

    .page-hero p {
        color: var(--text-muted);
        font-size: 1.05rem;
        letter-spacing: .02em;
    }

    /* ═══════════════ SEARCH ═══════════════ */
    .search-wrap {
        max-width: 580px;
        margin: 32px auto 0;
        position: relative;
        display: flex;
        align-items: center;
        background: rgba(0,0,0,.55);
        border: 1px solid var(--border);
        border-radius: 50px;
        backdrop-filter: blur(20px);
        box-shadow: 0 8px 32px rgba(0,0,0,.4), 0 0 0 1px rgba(255,255,255,.05) inset;
        transition: .3s;
    }

    .search-wrap:focus-within {
        border-color: var(--gold);
        box-shadow: 0 8px 32px rgba(0,0,0,.4), 0 0 0 4px var(--gold-glow);
    }

    .search-wrap .form-control {
        flex: 1;
        background: transparent;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        color: #fff;
        padding: 15px 16px 15px 24px;
        font-size: .97rem;
        border-radius: 50px;
        caret-color: var(--gold);
    }

    .search-wrap .form-control::placeholder {
        color: rgba(255,255,255,.45);
    }

    .btn-search {
        flex-shrink: 0;
        margin: 6px 6px 6px 0;
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        color: #1a1200;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .3s;
    }

    .btn-search:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 20px var(--gold-glow);
    }

    /* ═══════════════ CARDS ═══════════════ */
    .khassida-card {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: linear-gradient(160deg, rgba(255,255,255,.07) 0%, rgba(255,255,255,.03) 100%);
        border: 1px solid var(--border);
        border-radius: 24px;
        overflow: hidden;
        transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
        box-shadow:
            0 1px 0 rgba(255,255,255,.06) inset,
            0 20px 40px rgba(0,0,0,.4);
        position: relative;
    }

    /* shimmer line at top */
    .khassida-card::before {
        content: "";
        position: absolute;
        top: 0; left: 10%; right: 10%;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--gold-light), transparent);
        opacity: .4;
    }

    .khassida-card:hover {
        transform: translateY(-12px) scale(1.01);
        border-color: var(--border-hover);
        box-shadow:
            0 1px 0 rgba(255,255,255,.08) inset,
            0 30px 60px rgba(0,0,0,.5),
            0 0 40px var(--gold-glow);
    }

    .khassida-card-header {
        padding: 24px 24px 20px;
        background: linear-gradient(135deg, rgba(14,100,65,.55), rgba(10,60,50,.35));
        border-bottom: 1px solid rgba(255,255,255,.07);
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }

    /* arabic decorative pattern in header bg */
    .khassida-card-header::after {
        content: "✦";
        position: absolute;
        right: 20px; top: 50%;
        transform: translateY(-50%);
        font-size: 3.5rem;
        opacity: .07;
        color: var(--gold);
        line-height: 1;
    }

    .khassida-card-header h5 {
        margin: 0 0 4px;
        font-weight: 700;
        font-size: 1.05rem;
        color: #fff;
    }

    .khassida-card-header span {
        font-size: .8rem;
        color: var(--gold-light);
        opacity: .8;
        font-weight: 500;
        letter-spacing: .04em;
    }

    /* card body */
    .khassida-card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        padding: 20px 22px 22px;
    }

    /* arabic excerpt */
    .khassida-arabic {
        font-family: 'Amiri', serif;
        direction: rtl;
        text-align: right;
        line-height: 2;
        padding: 14px 16px;
        border-radius: 14px;
        background: rgba(201,168,76,.07);
        border: 1px solid rgba(201,168,76,.12);
        color: rgba(255,255,255,.85);
        font-size: 1.05rem;
    }

    /* badge */
    .badge-pdf {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 30px;
        background: rgba(220,50,50,.12);
        border: 1px solid rgba(220,50,50,.25);
        font-size: .78rem;
        font-weight: 600;
        color: #ff9090;
        letter-spacing: .04em;
    }

    /* ═══════════════ BUTTON GROUP ═══════════════ */
    .button-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: auto;
        padding-top: 20px;
    }

    .glass-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 10px 18px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 600;
        font-size: .87rem;
        cursor: pointer;
        transition: all .3s ease;
        border: none;
        letter-spacing: .02em;
        white-space: nowrap;
    }

    .glass-btn i { font-size: .95rem; }

    /* Voir — gold */
    .green-btn {
        background: linear-gradient(135deg, var(--gold), var(--gold-light));
        color: #1a1200;
        box-shadow: 0 6px 18px var(--gold-glow);
    }

    .green-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(201,168,76,.4);
        color: #1a1200;
    }

    /* Lire — glass */
    .outline-btn {
        background: rgba(255,255,255,.07);
        border: 1px solid rgba(255,255,255,.15);
        color: white;
        backdrop-filter: blur(10px);
    }

    .outline-btn:hover {
        background: rgba(255,255,255,.13);
        transform: translateY(-3px);
        color: white;
    }

    /* Télécharger — green */
    .download-btn {
        background: linear-gradient(135deg, var(--green-dark), var(--green));
        color: white;
        box-shadow: 0 6px 18px var(--green-glow);
    }

    .download-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px rgba(29,184,122,.35);
        color: white;
    }

    /* ═══════════════ MODAL ═══════════════ */
    .modal-content {
        background: rgba(4,12,16,.97);
        border: 1px solid var(--border);
        border-radius: 24px;
        color: var(--text);
        overflow: hidden;
    }

    .modal-header-custom {
        background: linear-gradient(135deg, rgba(14,100,65,.6), rgba(10,55,45,.4));
        border-bottom: 1px solid rgba(255,255,255,.07);
        padding: 20px 24px;
    }

    .modal-header-custom h5 {
        font-weight: 700;
        margin-bottom: 2px;
        font-size: 1.1rem;
    }

    .modal-header-custom small {
        color: var(--gold-light);
        font-size: .82rem;
        opacity: .85;
    }

    .section-label {
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .12em;
        margin-bottom: 10px;
        color: var(--gold);
    }

    .transcription-box {
        padding: 14px 18px;
        border-left: 3px solid var(--gold);
        background: rgba(201,168,76,.06);
        border-radius: 0 10px 10px 0;
        font-size: .93rem;
        line-height: 1.75;
    }

    /* modal footer btns */
    .btn-success {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        border: none !important;
        border-radius: 30px;
        background: linear-gradient(135deg, var(--gold), var(--gold-light)) !important;
        color: #1a1200 !important;
        font-weight: 700;
        font-size: .88rem;
        transition: .3s;
        text-decoration: none;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px var(--gold-glow);
    }

    /* ═══════════════ SECTION TITLE ═══════════════ */
    .section-title-row {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 36px;
    }

    .section-title-row h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--gold-light);
        white-space: nowrap;
    }

    .section-title-row .line {
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--border), transparent);
    }

</style>

</head>

<body>

<?php require_once __DIR__ . '/../../../sections/vitrine/menu.php'; ?>

<div class="page-hero">
    <div class="container">

        <div class="hero-ornament">
            <span></span>
            <i class="bi bi-stars"></i>
            <span></span>
        </div>

        <h1><?= $traduction['titre_khassida'] ?? 'Khassidas' ?></h1>

        <p><?= $traduction['sous_titre_khassida'] ?? 'Consultez et téléchargez vos khassidas' ?></p>

        <div class="search-wrap mt-4">
            <input
                type="text"
                id="searchInput"
                class="form-control"
                placeholder="<?= $traduction['recherche'] ?? 'Rechercher une khassida...' ?>"
                autocomplete="off"
            >
            <button class="btn-search" onclick="rechercher()" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>

    </div>
</div>

<div class="container py-5">

    <div class="section-title-row">
        <h2><i class="bi bi-book-half me-2"></i>Bibliothèque</h2>
        <div class="line"></div>
    </div>

    <div class="row g-4" id="khassidas-container">

        <?php foreach($khassidas as $k): ?>

        <div class="col-lg-4 col-md-6 khassida-item d-flex"
                data-search="<?= strtolower(htmlspecialchars($k['nom'].' '.$k['auteur'])) ?>">

            <div class="khassida-card w-100">

                <div class="khassida-card-header">
                    <h5><?= htmlspecialchars($k['nom']) ?></h5>
                    <span><?= htmlspecialchars($k['auteur'] ?? '') ?></span>
                </div>

                <div class="khassida-card-body">

                    <?php if(!empty($k['texte'])): ?>
                    <div class="khassida-arabic mb-3">
                        <?= htmlspecialchars(mb_substr($k['texte'],0,120)) ?>...
                    </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <span class="badge-pdf">
                            <i class="bi bi-file-earmark-pdf"></i>
                            PDF disponible
                        </span>
                    </div>

                    <div class="button-group">

                        <button
                            class="glass-btn green-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-<?= $k['id'] ?>"
                        >
                            <i class="bi bi-eye-fill"></i>
                            Voir
                        </button>

                        <?php if(!empty($k['chemin_pdf'])): ?>

                        <a
                            href="public/uploads/khassidas/<?= urlencode($k['chemin_pdf']) ?>"
                            target="_blank"
                            class="glass-btn outline-btn"
                        >
                            <i class="bi bi-file-earmark-pdf"></i>
                            Lire
                        </a>

                        <a
                            href="public/uploads/khassidas/<?= urlencode($k['chemin_pdf']) ?>"
                            download
                            class="glass-btn download-btn"
                        >
                            <i class="bi bi-download"></i>
                            Télécharger
                        </a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>

<?php foreach($khassidas as $k): ?>

<div class="modal fade" id="modal-<?= $k['id'] ?>" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content">

            <div class="modal-header modal-header-custom">
                <div>
                    <h5><?= htmlspecialchars($k['nom']) ?></h5>
                    <small><?= htmlspecialchars($k['auteur'] ?? '') ?></small>
                </div>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">

                <?php if(!empty($k['chemin_pdf'])): ?>
                <!-- PDF affiché directement dans le modal -->
                <iframe
                    src="public/uploads/khassidas/<?= urlencode($k['chemin_pdf']) ?>"
                    width="100%"
                    height="520px"
                    style="border:none; display:block;"
                ></iframe>
                <?php endif; ?>

                <?php if(!empty($k['texte']) || !empty($k['traduction']) || !empty($k['transcription'])): ?>
                <div class="p-4">

                    <?php if(!empty($k['texte'])): ?>
                    <div class="section-label">Texte arabe</div>
                    <div class="khassida-arabic mb-4">
                        <?= nl2br(htmlspecialchars($k['texte'])) ?>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($k['traduction'])): ?>
                    <div class="section-label">Traduction</div>
                    <p class="mb-4"><?= nl2br(htmlspecialchars($k['traduction'])) ?></p>
                    <?php endif; ?>

                    <?php if(!empty($k['transcription'])): ?>
                    <div class="section-label">Transcription</div>
                    <div class="transcription-box">
                        <?= nl2br(htmlspecialchars($k['transcription'])) ?>
                    </div>
                    <?php endif; ?>

                </div>
                <?php endif; ?>

                <?php if(empty($k['chemin_pdf']) && empty($k['texte'])): ?>
                <div class="text-center p-5 opacity-50">
                    <i class="bi bi-file-earmark-x" style="font-size:3rem;"></i>
                    <p class="mt-3">Aucun contenu disponible pour cette khassida.</p>
                </div>
                <?php endif; ?>

            </div>

            <div class="modal-footer">

                <a
                    href="public/uploads/khassidas/<?= urlencode($k['chemin_pdf']) ?>"
                    target="_blank"
                    class="btn btn-success btn-sm"
                >
                    Lire PDF
                </a>

                <a
                    href="public/uploads/khassidas/<?= urlencode($k['chemin_pdf']) ?>"
                    download
                    class="btn btn-outline-light btn-sm"
                >
                    Télécharger
                </a>

                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                    Fermer
                </button>

            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>

<?php require_once __DIR__ . '/../../../sections/vitrine/footer.php'; ?>

<script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>

document.getElementById('searchInput').addEventListener('input', filtrer);

function filtrer() {

    const q = document.getElementById('searchInput')
        .value
        .trim()
        .toLowerCase();

    let countVisible = 0;

    document.querySelectorAll('.khassida-item').forEach(el => {

        const data = el.getAttribute('data-search') || '';

        const match = data.includes(q);

        if (q === '' || match) {
            el.classList.remove('d-none');
            countVisible++;
        } else {
            el.classList.add('d-none');
        }
    });

    let msg = document.getElementById('no-result');

    if (q !== '' && countVisible === 0) {

        if (!msg) {
            msg = document.createElement('div');
            msg.id = 'no-result';
            msg.style.cssText =
                "width:100%;text-align:center;padding:60px;color:rgba(255,255,255,.6);";

            msg.innerHTML =
                "<i class='bi bi-search' style='font-size:2rem;display:block;margin-bottom:10px;color:var(--gold);'></i>" +
                "Aucune khassida trouvée";

            document.getElementById('khassidas-container').appendChild(msg);
        }

    } else if (msg) {
        msg.remove();
    }
}

function rechercher() {
    filtrer();
}

</script>

</body>

</html>