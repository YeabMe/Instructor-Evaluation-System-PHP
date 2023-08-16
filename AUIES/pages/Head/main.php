<?php
    require_once('../../db_php/connection.php');
?>
<?php
session_start();
if (isset($_SESSION['Hname'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AUIES Head</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="shortcut icon" href="../../images/index.png" />
  </head>

  <body>
    <div class="container-scroller">

      <!-- partial:partials/_horizontal-navbar.html -->
      <?php
      include('navbar.php');
      ?>



      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <?php
          include('home.php');
          ?>

          <?php
          include('_footer.html');
          ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>


    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/dashboard.js"></script>
  </body>

  </html>
<?php } else {
  header('location:../../index.php');
}
?>