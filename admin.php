<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ======================================================
// PROTECTION ADMIN — seul endroit où le login est requis
// ======================================================

require_once __DIR__ . '/controller/userController.php';

$auth = new UserController();
$auth->requireAdmin(); // Redirige vers login si non connecté ou non admin

?>
<!DOCTYPE html>
<html lang="fr">
<?php require_once("view/sections/admin/head.php"); ?>
<body>
  <div class="container-scroller">
    <?php require_once("view/sections/admin/navbar.php"); ?>
    <?php require_once("view/sections/admin/sidebar.php"); ?>
    <?php require_once("view/sections/admin/content.php"); ?>
  </div>
  <?php require_once("view/sections/admin/script.php"); ?>
</body>
</html>