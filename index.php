<?php
session_start();
require_once __DIR__ . '/controller/userController.php';

$controller = new UserController();

// Gestion de la déconnexion
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Accueil - YonnWi</title>
 
  <!-- Favicons -->
  <link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">
  <link href="public/templates/templateVitrine/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eStartup
  * Template URL: https://bootstrapmade.com/estartup-bootstrap-landing-page-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

<?php require_once("view/sections/vitrine/menu.php");?>

  <main class="main">

    <!-- Hero Section -->
<?php require_once("view/sections/vitrine/banniere.php");?> 
    <!-- /Hero Section -->

    <!-- About Section -->
<?php require_once("view/sections/vitrine/rappel.php");?>
    <!-- /About Section -->

    <!-- Services Section -->
<?php require_once("view/sections/vitrine/fonctionnalite.php");?>
    <!-- /Services Section -->

    <!-- Features Section -->
<?php require_once("view/sections/vitrine/recommandations.php");?>
    <!-- /Features Section -->

    <!-- Pricing Section -->
<?php require_once("view/sections/vitrine/chiffrage.php");?>
    <!-- /Pricing Section -->

    <!-- Faq Section -->
<?php require_once("view/sections/vitrine/faq.php");?>
    <!-- /Faq Section -->

    <!-- Contact Section -->
<?php require_once("view/sections/vitrine/contact.php");?>
    <!-- /Contact Section -->

  </main>

 
<?php require_once("view/sections/vitrine/footer.php");?>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="public/templates/templateVitrine/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/php-email-form/validate.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/aos/aos.js"></script>
  <script src="public/templates/templateVitrine/assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Main JS File -->
  <script src="public/templates/templateVitrine/assets/js/main.js"></script>

</body>

</html>