<?php
/**
 * @var string $lang
 * @var array $traduction
 */
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= $traduction['dir'] ?>">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $traduction['titre'] ?></title>    <link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <style>

        *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Poppins',sans-serif;
        }

        body{
        background:
        linear-gradient(
        rgba(7,22,18,.85),
        rgba(7,22,18,.92)
        ),
        url('https://images.unsplash.com/photo-1564769625905-50e93615e769?auto=format&fit=crop&w=1600&q=80');

        background-size:cover;
        background-position:center;
        background-attachment:fixed;

        color:white;
        min-height:100vh;
        }

        #preloader{
        display:none!important;
        }

        /* HERO */

        .page-hero{

        padding:90px 0 70px;

        text-align:center;

        background:
        linear-gradient(
        135deg,
        rgba(71,255,160,.18),
        rgba(255,255,255,.08)
        );

        backdrop-filter:blur(20px);

        border-bottom:
        1px solid rgba(255,255,255,.15);

        box-shadow:
        0 5px 25px rgba(0,0,0,.18);

        }

        .page-hero h1{

        color:#ffffff;

        text-shadow:
        0 2px 12px rgba(0,0,0,.35);

        }

        .page-hero p{

        color:
        rgba(255,255,255,.92);

        font-size:1.05rem;

        }

        /* FILTERS */

        .filter-btns{

        display:flex;

        justify-content:center;

        flex-wrap:wrap;

        gap:12px;

        margin:40px 0;

        }

        .filter-btn{

        padding:10px 22px;

        border:none;

        border-radius:35px;

        background:
        rgba(255,255,255,.08);

        color:white;

        backdrop-filter:blur(10px);

        border:
        1px solid rgba(255,255,255,.12);

        transition:.3s;

        font-weight:500;

        }

        .filter-btn:hover{

        transform:translateY(-2px);

        background:
        rgba(255,255,255,.15);

        }

        .filter-btn.active{

        background:
        rgba(71,255,160,.18);

        border:
        1px solid rgba(71,255,160,.45);

        box-shadow:
        0 0 20px rgba(71,255,160,.25);

        }

        /* COUNTER */

        .compteur{

        text-align:center;

        margin-bottom:30px;

        font-size:1rem;

        font-weight:500;

        color:rgba(255,255,255,.8);

        }

        /* CARDS */

        .doua-card{

        height:100%;

        padding:1.6rem;

        border-radius:24px;

        background:
        rgba(255,255,255,.08);

        backdrop-filter:blur(18px);

        border:
        1px solid rgba(255,255,255,.1);

        box-shadow:
        0 8px 32px rgba(0,0,0,.3);

        transition:.35s;

        overflow:hidden;

        position:relative;

        }

        .doua-card:hover{

        transform:
        translateY(-8px)
        scale(1.02);

        border-color:
        rgba(71,255,160,.35);

        box-shadow:
        0 15px 40px rgba(0,0,0,.45);

        }

        /* ICON */

        .doua-icon{
        width:60px;
        height:60px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:15px;
        background:rgba(71,255,160,.12);
        box-shadow:0 0 20px rgba(71,255,160,.15);
        }

        .doua-icon i{
        font-size:1.55rem;
        color:#baffdf;
        text-shadow:0 0 15px rgba(155,255,212,.35);
        }

        /* CATEGORY */

        .doua-category{

        display:inline-block;

        padding:5px 14px;

        border-radius:30px;

        font-size:.75rem;

        margin-bottom:12px;

        background:
        rgba(255,255,255,.08);

        color:#baffdf;

        border:
        1px solid rgba(255,255,255,.08);

        }

        /* TITLE */

        .doua-title{

        font-size:1.08rem;

        font-weight:600;

        margin-bottom:12px;

        color:white;

        }

        /* ARABIC */

        .doua-arabic{

        background:
        rgba(255,255,255,.06);

        padding:18px;

        border-radius:15px;

        font-size:1.55rem;

        direction:rtl;

        text-align:right;

        line-height:2.2;

        font-family:'Amiri',serif;

        margin-bottom:15px;

        border:
        1px solid rgba(255,255,255,.08);

        }

        /* TRANSLATION */

        .doua-translation{

        font-size:.92rem;

        line-height:1.7;

        color:rgba(255,255,255,.88);

        }

        /* SOURCE */

        .doua-source{

        margin-top:12px;

        font-size:.8rem;

        opacity:.75;

        }

        /* MOBILE */

        @media(max-width:768px){

        .page-hero{

        padding:70px 20px;

        }

        .page-hero h1{

        font-size:2rem;

        }

        .doua-arabic{

        font-size:1.3rem;

        }

        .filter-btn{

        padding:8px 18px;

        font-size:.85rem;

        }

        }

    </style>
</head>

<body class="index-page">

<?php require_once __DIR__ . '/../../../sections/vitrine/menu.php'; ?>

<!-- HERO -->
<div class="page-hero">
    <div class="container">
        <h1><i class="bi bi-heart-fill"></i> <?= $traduction['titre'] ?></h1>
        <p><?= $traduction['sous_titre'] ?></p>
    </div>
</div>

<div class="container py-5">

    <!-- FILTRES -->
    <div class="filter-btns">
        <button class="filter-btn active" onclick="filtrer('tous', this)"><?= $traduction['tous'] ?></button>
        <button class="filter-btn" onclick="filtrer('matin', this)"><?= $traduction['matin'] ?></button>
        <button class="filter-btn" onclick="filtrer('soir', this)"><?= $traduction['soir'] ?></button>
        <button class="filter-btn" onclick="filtrer('priere', this)"><?= $traduction['priere'] ?></button>
        <button class="filter-btn" onclick="filtrer('quotidien', this)"><?= $traduction['quotidien'] ?></button>
        <button class="filter-btn" onclick="filtrer('protection', this)"><?= $traduction['protection'] ?></button>
    </div>

    <!-- COMPTEUR -->
    <p class="compteur" id="compteur">21 douas</p>

    <!-- DOUAS -->
    <div class="row g-4" id="douas-container">

        <?php
            $douas = [
                [
                    'titre'      => 'Doua du matin',
                    'categorie'  => 'matin',
                    'cat_label'  => '🌅 Matin',
                    'icon'       => 'sunrise-fill',
                    'arabe'      => 'أَصْبَحْنَا وَأَصْبَحَ الْمُلْكُ لِلَّهِ، وَالْحَمْدُ لِلَّهِ، لَا إِلَهَ إِلَّا اللَّهُ وَحْدَهُ لَا شَرِيكَ لَهُ',
                    'traduction' => 'Nous voici au matin, et au matin la royauté appartient à Allah. La louange est à Allah. Il n\'y a de divinité qu\'Allah, Seul, sans associé.',
                    'source'     => 'Abou Dawoud',
                ],
                [
                    'titre'      => 'Doua du soir',
                    'categorie'  => 'soir',
                    'cat_label'  => '🌙 Soir',
                    'icon'       => 'moon-stars-fill',
                    'arabe'      => 'أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلَّهِ، وَالْحَمْدُ لِلَّهِ، لَا إِلَهَ إِلَّا اللَّهُ وَحْدَهُ لَا شَرِيكَ لَهُ',
                    'traduction' => 'Nous voici au soir, et au soir la royauté appartient à Allah. La louange est à Allah. Il n\'y a de divinité qu\'Allah, Seul, sans associé.',
                    'source'     => 'Abou Dawoud',
                ],
                [
                    'titre'      => 'Istighfar (demande de pardon)',
                    'categorie'  => 'quotidien',
                    'cat_label'  => '📅 Quotidien',
                    'icon'       => 'arrow-repeat',
                    'arabe'      => 'أَسْتَغْفِرُ اللَّهَ الْعَظِيمَ الَّذِي لَا إِلَهَ إِلَّا هُوَ الْحَيُّ الْقَيُّومُ وَأَتُوبُ إِلَيْهِ',
                    'traduction' => 'Je demande pardon à Allah le Tout-Puissant, en dehors de qui il n\'y a pas de divinité, le Vivant, le Subsistant, et je me repens auprès de Lui.',
                    'source'     => 'Tirmidhi',
                ],
                [
                    'titre'      => 'Tasbih après la prière',
                    'categorie'  => 'priere',
                    'cat_label'  => '🕌 Après la prière',
                    'icon'       => 'stars',
                    'arabe'      => 'سُبْحَانَ اللَّهِ، وَالْحَمْدُ لِلَّهِ، وَلَا إِلَهَ إِلَّا اللَّهُ، وَاللَّهُ أَكْبَرُ',
                    'traduction' => 'Gloire à Allah, la louange est à Allah, il n\'y a de divinité qu\'Allah, Allah est le Plus Grand.',
                    'source'     => 'Muslim',
                ],
                [
                    'titre'      => 'Doua avant de dormir',
                    'categorie'  => 'soir',
                    'cat_label'  => '🌙 Soir',
                    'icon'       => 'moon-fill',
                    'arabe'      => 'بِاسْمِكَ اللَّهُمَّ أَمُوتُ وَأَحْيَا',
                    'traduction' => 'En Ton nom ô Allah, je meurs et je vis.',
                    'source'     => 'Boukhari',
                ],
                [
                    'titre'      => 'Doua au réveil',
                    'categorie'  => 'matin',
                    'cat_label'  => '🌅 Matin',
                    'icon'       => 'brightness-alt-high-fill',
                    'arabe'      => 'الْحَمْدُ لِلَّهِ الَّذِي أَحْيَانَا بَعْدَ مَا أَمَاتَنَا وَإِلَيْهِ النُّشُورُ',
                    'traduction' => 'Louange à Allah qui nous a redonné vie après nous avoir fait mourir, et c\'est vers Lui que se fera la résurrection.',
                    'source'     => 'Boukhari',
                ],
                [
                    'titre'      => 'Tasbih (glorification)',
                    'categorie'  => 'quotidien',
                    'cat_label'  => '📅 Quotidien',
                    'icon'       => 'star',
                    'arabe'      => 'سُبْحَانَ اللَّهِ وَبِحَمْدِهِ، سُبْحَانَ اللَّهِ الْعَظِيمِ',
                    'traduction' => 'Gloire à Allah et à Sa louange, Gloire à Allah le Très Grand.',
                    'source'     => 'Boukhari et Muslim',
                ],
                [
                    'titre'      => 'Doua pour la protection',
                    'categorie'  => 'protection',
                    'cat_label'  => '🛡️ Protection',
                    'icon'       => 'shield-fill-check',
                    'arabe'      => 'بِسْمِ اللَّهِ الَّذِي لَا يَضُرُّ مَعَ اسْمِهِ شَيْءٌ فِي الْأَرْضِ وَلَا فِي السَّمَاءِ وَهُوَ السَّمِيعُ الْعَلِيمُ',
                    'traduction' => 'Au nom d\'Allah, avec Lequel rien ne peut nuire, ni sur terre ni dans le ciel, et Il est Celui qui entend tout, Celui qui sait tout.',
                    'source'     => 'Abou Dawoud, Tirmidhi',
                ],
                [
                    'titre'      => 'Doua en entrant à la mosquée',
                    'categorie'  => 'priere',
                    'cat_label'  => '🕌 Après la prière',
                    'icon'       => 'journal-richtext',
                    'arabe'      => 'اللَّهُمَّ افْتَحْ لِي أَبْوَابَ رَحْمَتِكَ',
                    'traduction' => 'Ô Allah, ouvre-moi les portes de Ta miséricorde.',
                    'source'     => 'Muslim',
                ],
                [
                    'titre'      => 'Doua en sortant de la mosquée',
                    'categorie'  => 'priere',
                    'cat_label'  => '🕌 Après la prière',
                    'icon'       => 'bank2',
                    'arabe'      => 'اللَّهُمَّ إِنِّي أَسْأَلُكَ مِنْ فَضْلِكَ',
                    'traduction' => 'Ô Allah, je Te demande de Ta grâce.',
                    'source'     => 'Muslim',
                ],
                [
                    'titre'      => 'Doua avant de manger',
                    'categorie'  => 'quotidien',
                    'cat_label'  => '📅 Quotidien',
                    'icon'       => 'cup-hot',
                    'arabe'      => 'بِسْمِ اللَّهِ وَعَلَى بَرَكَةِ اللَّهِ',
                    'traduction' => 'Au nom d\'Allah et avec la bénédiction d\'Allah.',
                    'source'     => 'Abou Dawoud',
                ],
                [
                    'titre'      => 'Doua après avoir mangé',
                    'categorie'  => 'quotidien',
                    'cat_label'  => '📅 Quotidien',
                    'icon'       => 'check-circle',
                    'arabe'      => 'الْحَمْدُ لِلَّهِ الَّذِي أَطْعَمَنِي هَذَا وَرَزَقَنِيهِ مِنْ غَيْرِ حَوْلٍ مِنِّي وَلَا قُوَّةٍ',
                    'traduction' => 'Louange à Allah qui m\'a nourri de ceci et me l\'a accordé sans force ni puissance de ma part.',
                    'source'     => 'Abou Dawoud, Tirmidhi',
                ],
                [
                    'titre'      => 'Doua en quittant la maison',
                    'categorie'  => 'protection',
                    'cat_label'  => '🛡️ Protection',
                    'icon'       => 'house-door',
                    'arabe'      => 'بِسْمِ اللَّهِ، تَوَكَّلْتُ عَلَى اللَّهِ، وَلَا حَوْلَ وَلَا قُوَّةَ إِلَّا بِاللَّهِ',
                    'traduction' => 'Au nom d\'Allah, je me confie à Allah, il n\'y a de force ni de puissance qu\'en Allah.',
                    'source'     => 'Abou Dawoud, Tirmidhi',
                ],
                [
                    'titre'      => 'Doua en entrant à la maison',
                    'categorie'  => 'protection',
                    'cat_label'  => '🛡️ Protection',
                    'icon'       => 'house-check',
                    'arabe'      => 'اللَّهُمَّ إِنِّي أَسْأَلُكَ خَيْرَ الْمَوْلِجِ وَخَيْرَ الْمَخْرَجِ، بِسْمِ اللَّهِ وَلَجْنَا، وَبِسْمِ اللَّهِ خَرَجْنَا، وَعَلَى اللَّهِ رَبِّنَا تَوَكَّلْنَا',
                    'traduction' => 'Ô Allah, je Te demande le bien de l\'entrée et le bien de la sortie. Au nom d\'Allah nous entrons, au nom d\'Allah nous sortons, et sur Allah notre Seigneur nous nous confions.',
                    'source'     => 'Abou Dawoud',
                ],
                [
                    'titre'      => 'Doua pour les parents',
                    'categorie'  => 'quotidien',
                    'cat_label'  => '📅 Quotidien',
                    'icon'       => 'people',
                    'arabe'      => 'رَبِّ اغْفِرْ لِي وَلِوَالِدَيَّ وَارْحَمْهُمَا كَمَا رَبَّيَانِي صَغِيرًا',
                    'traduction' => 'Seigneur, pardonne-moi et pardonne à mes parents, et fais-leur miséricorde comme ils m\'ont élevé lorsque j\'étais enfant.',
                    'source'     => 'Coran 17:24',
                ],
                [
                    'titre'      => 'Doua contre l\'anxiété',
                    'categorie'  => 'protection',
                    'cat_label'  => '🛡️ Protection',
                    'icon'       => 'heart-pulse-fill',
                    'arabe'      => 'اللَّهُمَّ إِنِّي أَعُوذُ بِكَ مِنَ الْهَمِّ وَالْحَزَنِ، وَالْعَجْزِ وَالْكَسَلِ',
                    'traduction' => 'Ô Allah, je cherche refuge auprès de Toi contre l\'inquiétude et la tristesse, l\'incapacité et la paresse.',
                    'source'     => 'Boukhari',
                ],
                [
                    'titre'      => 'Doua du matin (Sayyidul Istighfar)',
                    'categorie'  => 'matin',
                    'cat_label'  => '🌅 Matin',
                    'icon'       => 'sun-fill',
                    'arabe'      => 'اللَّهُمَّ أَنْتَ رَبِّي لَا إِلَهَ إِلَّا أَنْتَ، خَلَقْتَنِي وَأَنَا عَبْدُكَ، وَأَنَا عَلَى عَهْدِكَ وَوَعْدِكَ مَا اسْتَطَعْتُ',
                    'traduction' => 'Ô Allah, Tu es mon Seigneur, il n\'y a de divinité que Toi. Tu m\'as créé et je suis Ton serviteur. Je m\'en tiens à mon pacte envers Toi autant que je le peux.',
                    'source'     => 'Boukhari',
                ],
                [
                    'titre'      => 'Doua pour le savoir',
                    'categorie'  => 'quotidien',
                    'cat_label'  => '📅 Quotidien',
                    'icon'       => 'book',
                    'arabe'      => 'رَبِّ زِدْنِي عِلْمًا',
                    'traduction' => 'Seigneur, augmente mon savoir.',
                    'source'     => 'Coran 20:114',
                ],
                [
                    'titre'      => 'Doua pour l\'endettement',
                    'categorie'  => 'protection',
                    'cat_label'  => '🛡️ Protection',
                    'icon'       => 'cash-coin',
                    'arabe'      => 'اللَّهُمَّ اكْفِنِي بِحَلَالِكَ عَنْ حَرَامِكَ، وَأَغْنِنِي بِفَضْلِكَ عَمَّنْ سِوَاكَ',
                    'traduction' => 'Ô Allah, suffis-moi avec ce que Tu as permis au lieu de ce que Tu as interdit, et enrichis-moi par Ta grâce de manière à ce que je n\'aie besoin de personne d\'autre que Toi.',
                    'source'     => 'Tirmidhi',
                ],
                [
                    'titre'      => 'Doua du soir (protection)',
                    'categorie'  => 'soir',
                    'cat_label'  => '🌙 Soir',
                    'icon'       => 'cloud-moon-fill',
                    'arabe'      => 'أَمْسَيْنَا وَأَمْسَى الْمُلْكُ لِلَّهِ، اللَّهُمَّ إِنِّي أَسْأَلُكَ خَيْرَ هَذِهِ اللَّيْلَةِ وَخَيْرَ مَا فِيهَا',
                    'traduction' => 'Nous voici au soir et la royauté appartient à Allah. Ô Allah, je Te demande le bien de cette nuit et le bien de ce qu\'elle contient.',
                    'source'     => 'Muslim',
                ],
                [
                    'titre'      => 'Ayat al-Kursi (Verset du Trône)',
                    'categorie'  => 'priere',
                    'cat_label'  => '🕌 Après la prière',
                    'icon'       => 'stars',
                    'arabe'      => 'اللَّهُ لَا إِلَٰهَ إِلَّا هُوَ الْحَيُّ الْقَيُّومُ ۚ لَا تَأْخُذُهُ سِنَةٌ وَلَا نَوْمٌ ۚ لَّهُ مَا فِي السَّمَاوَاتِ وَمَا فِي الْأَرْضِ ۗ مَن ذَا الَّذِي يَشْفَعُ عِندَهُ إِلَّا بِإِذْنِهِ ۚ يَعْلَمُ مَا بَيْنَ أَيْدِيهِمْ وَمَا خَلْفَهُمْ ۖ وَلَا يُحِيطُونَ بِشَيْءٍ مِّنْ عِلْمِهِ إِلَّا بِمَا شَاءَ ۚ وَسِعَ كُرْسِيُّهُ السَّمَاوَاتِ وَالْأَرْضَ ۖ وَلَا يَئُودُهُ حِفْظُهُمَا ۚ وَهُوَ الْعَلِيُّ الْعَظِيمُ',
                    'traduction' => 'Allah ! Point de divinité à part Lui, le Vivant, Celui qui subsiste par Lui-même. Ni somnolence ni sommeil ne Le saisissent. À Lui appartient tout ce qui est dans les cieux et sur la terre. Qui peut intercéder auprès de Lui sans Sa permission ? Il sait ce qui est devant eux et ce qui est derrière eux, tandis qu\'ils n\'embrassent de Sa science que ce qu\'Il veut. Son Trône déborde les cieux et la terre, dont la garde ne Lui coûte aucune peine. Et Il est le Très Haut, le Très Grand.',
                    'source'     => 'Coran 2:255',
                ],
            ];

            // Trier du plus court au plus long
            usort($douas, function($a, $b) {
                return mb_strlen($a['arabe']) - mb_strlen($b['arabe']);
            });
        ?>

        <?php foreach ($douas as $i => $doua): ?>
        <div class="col-lg-4 col-md-6 doua-item" data-categorie="<?= $doua['categorie'] ?>">
            <div class="doua-card">
                <div class="doua-icon">
                    <i class="bi bi-<?= $doua['icon'] ?>"></i>
                </div>
                <span class="doua-category"><?= $doua['cat_label'] ?></span>
                <div class="doua-title"><?= $doua['titre'] ?></div>
                <div class="doua-arabic"><?= $doua['arabe'] ?></div>
                <div class="doua-translation"><?= $doua['traduction'] ?></div>
                <div class="doua-source">📖 <?= $traduction['source'] ?> : <?= $doua['source'] ?></div>            </div>
        </div>
        <?php endforeach; ?>

    </div>

</div>

<?php require_once __DIR__ . '/../../../sections/vitrine/footer.php'; ?>

<script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
<script src="public/templates/templateVitrine/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="public/templates/templateVitrine/assets/js/main.js"></script>

<script>
function filtrer(categorie, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    let count = 0;
    document.querySelectorAll('.doua-item').forEach(item => {
        if (categorie === 'tous' || item.dataset.categorie === categorie) {
            item.style.display = 'block';
            count++;
        } else {
            item.style.display = 'none';
        }
    });

    document.getElementById('compteur').textContent = count + ' doua' + (count > 1 ? 's' : '');
}
</script>

</body>
</html>