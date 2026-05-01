<!DOCTYPE html>
<html lang="en">
  <?php require_once("view/sections/admin/head.php");?>
  <body>
    <div class="container-scroller">
      <?php require_once("view/sections/admin/navbar.php");?>
      <!-- partial:partials/_sidebar.html -->
      <?php require_once("view/sections/admin/sidebar.php");?>
      <!-- partial -->
      <?php require_once("view/sections/admin/content.php");?>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
 <?php require_once("view/sections/admin/script.php");?>
    <!-- End custom js for this page -->
  </body>
</html>