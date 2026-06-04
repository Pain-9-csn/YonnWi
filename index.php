<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Déconnecter si nouvelle session de navigateur
if (!isset($_SESSION['actif'])) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['actif'] = true;

require_once __DIR__ . '/controller/userController.php';

$controller = new UserController();


// ======================
// Déconnexion
// ======================

if (isset($_GET['action']) && $_GET['action'] === 'logout') {

    session_unset();
    session_destroy();

    header('Location: login.php');
    exit;
}


// ======================
// Routeur
// ======================

$action = $_GET['action'] ?? 'accueil';


switch ($action) {

    // ======================
    // Horaires prières
    // ======================

    case 'horairesprieres':

        require_once __DIR__ . '/controller/HorairePrieresController.php';

        $controller = new HorairePrieresController();

        $controller->index();

    break;

    // ======================
    // Langue
    // ======================

    case 'langue':

        $langues_valides = ['fr', 'wo', 'ar', 'en'];

        $lang = $_GET['lang'] ?? 'fr';

        if (in_array($lang, $langues_valides)) {
            $_SESSION['lang'] = $lang;
        }

        $retour = $_SERVER['HTTP_REFERER'] ?? 'index.php';
        header('Location: ' . $retour);
        exit;

    break;

    // ======================
    // Khassidapdf
    // ======================
    case 'khassidapdf':

        require_once __DIR__ . '/controller/XassidaController.php';

        $controller = new KhassidaController();

        $controller->index();

    break;

    // ======================
    // Douas & Invocations
    // ======================

    case 'douas':
        require_once __DIR__ . '/controller/DouasController.php';
        $controller = new DouasController();
        $controller->index();
    break;


    // ======================
    // Accueil
    // ======================

    default:

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Accueil - YoonWi</title>

    <!-- Favicons -->
    <link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">

    <!-- Vendor CSS -->
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

<?php require_once("view/sections/vitrine/menu.php"); ?>

<main class="main">

    <?php require_once("view/sections/vitrine/banniere.php"); ?>

    <?php require_once("view/sections/vitrine/rappel.php"); ?>

    <?php require_once("view/sections/vitrine/fonctionnalite.php"); ?>

    <?php require_once("view/sections/vitrine/recommandations.php"); ?>

    <?php require_once("view/sections/vitrine/chiffrage.php"); ?>

    <?php require_once("view/sections/vitrine/faq.php"); ?>

    <?php require_once("view/sections/vitrine/contact.php"); ?>

</main>

<?php require_once("view/sections/vitrine/footer.php"); ?>

<!-- Scroll Top -->
<a href="#"
   id="scroll-top"
   class="scroll-top d-flex align-items-center justify-content-center">

    <i class="bi bi-arrow-up-short"></i>

</a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS -->
<script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>

<script src="public/templates/templateVitrine/assets/vendor/glightbox/js/glightbox.min.js"></script>

<!-- Main JS -->
<script src="public/templates/templateVitrine/assets/js/main.js"></script>

</body>
</html>

<?php

    break;
}