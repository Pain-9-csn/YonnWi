<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ======================================================
// SESSION — optionnelle, jamais bloquante
// L'utilisateur peut tout utiliser sans être connecté.
// S'il est connecté, son historique est enregistré.
// ======================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Marquer la session comme active (évite la destruction au rechargement)
if (!isset($_SESSION['actif'])) {
    $_SESSION['actif'] = true;
}

// ======================================================
// DÉCONNEXION
// ======================================================

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

// ======================================================
// CHANGEMENT DE LANGUE
// ======================================================

if (isset($_GET['action']) && $_GET['action'] === 'langue') {
    $langues_valides = ['fr', 'wo', 'ar', 'en'];
    $lang = $_GET['lang'] ?? 'fr';
    if (in_array($lang, $langues_valides)) {
        $_SESSION['lang'] = $lang;
    }
    $retour = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header('Location: ' . $retour);
    exit;
}

// ======================================================
// ROUTEUR PRINCIPAL
// ======================================================

$action = $_GET['action'] ?? 'accueil';

switch ($action) {

    // --------------------------------------------------
    // HORAIRES DE PRIÈRES — accès libre
    // --------------------------------------------------
    case 'horairesprieres':
        require_once __DIR__ . '/controller/horairePrieresController.php';
        $controller = new HorairePrieresController();
        $controller->index();
        break;

    // --------------------------------------------------
    // XASSIDA / KHASSIDA — accès libre
    // --------------------------------------------------
    case 'khassidapdf':
        require_once __DIR__ . '/controller/xassidaController.php';
        $controller = new KhassidaController();
        $controller->index();
        break;

    // --------------------------------------------------
    // DOUAS & INVOCATIONS — accès libre
    // --------------------------------------------------
    case 'douas':
        require_once __DIR__ . '/controller/DouasController.php';
        $controller = new DouasController();
        $controller->index();
        break;

    // --------------------------------------------------
    // CORAN — accès libre
    // --------------------------------------------------
    case 'coran':
        require_once __DIR__ . '/controller/coranController.php';
        $controller = new CoranController();
        $controller->index();
        break;

    // AJAX : versets d'une sourate
    case 'ajax_versets':
        require_once __DIR__ . '/controller/coranController.php';
        $controller = new CoranController();
        $controller->ajaxVersets();
        break;

    // AJAX : sauvegarder progression (nécessite connexion, silencieux sinon)
    case 'ajax_progression_coran':
        require_once __DIR__ . '/controller/coranController.php';
        $controller = new CoranController();
        $controller->sauvegarderProgression();
        break;

    // --------------------------------------------------
    // QIBLA — accès libre
    // --------------------------------------------------
    case 'qibla':
        require_once __DIR__ . '/controller/qiblaController.php';
        $controller = new QiblaController();
        $controller->index();
        break;

    // AJAX : enregistrer localisation qibla
    case 'ajax_qibla':
        require_once __DIR__ . '/controller/qiblaController.php';
        $controller = new QiblaController();
        $controller->enregistrerLocalisation();
        break;

    // --------------------------------------------------
    // DICTAPHONE / CAPTURE AUDIO — accès libre
    // --------------------------------------------------
    case 'dictaphone':
        require_once __DIR__ . '/controller/captureAudioController.php';
        $controller = new CaptureAudioController();
        $controller->index();
        break;

    // AJAX : identifier un xassida par empreinte audio
    case 'ajax_identifier':
        require_once __DIR__ . '/controller/captureAudioController.php';
        $controller = new CaptureAudioController();
        $controller->identifier();
        break;

    // AJAX : liste xassidas populaires
    case 'ajax_xassidas':
        require_once __DIR__ . '/controller/captureAudioController.php';
        $controller = new CaptureAudioController();
        $controller->ajaxXassidas();
        break;

    // --------------------------------------------------
    // LECTEUR AUDIO — accès libre
    // --------------------------------------------------
    case 'lecteur':
        require_once __DIR__ . '/view/pages/vitrine/lecteur/lecteur.php';
        break;

    // --------------------------------------------------
    // ACCUEIL (défaut)
    // --------------------------------------------------
    default:
        renderAccueil();
        break;
}

// ======================================================
// FONCTION : PAGE D'ACCUEIL
// ======================================================

function renderAccueil(): void
{
    ?>
<!DOCTYPE html>
<html lang="fr">
<?php require_once("view/sections/vitrine/header.php"); ?>

<body class="index-page">

<?php
    if (file_exists(__DIR__ . '/view/sections/vitrine/menu.php')) {
        require_once __DIR__ . '/view/sections/vitrine/menu.php';
    }
?>

  <main class="main">

<?php
    $sections = [
        'banniere', 'rappel', 'fonctionnalite',
        'recommandations', 'chiffrage', 'faq', 'contact'
    ];
    foreach ($sections as $section) {
        $path = __DIR__ . "/view/sections/vitrine/{$section}.php";
        if (file_exists($path)) {
            require_once $path;
        }
    }
?>

  </main>

<?php
    if (file_exists(__DIR__ . '/view/sections/vitrine/footer.php')) {
        require_once __DIR__ . '/view/sections/vitrine/footer.php';
    }
?>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <div id="preloader"></div>

  <script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="public/templates/templateVitrine/assets/js/main.js"></script>
</body>
</html>
<?php
}