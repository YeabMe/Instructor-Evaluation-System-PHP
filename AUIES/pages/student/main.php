<?php
    require_once('../../db_php/connection.php');
?>
<?php
session_start();
if (isset($_SESSION['Sname'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AUIES Student</title>
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


      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row mt-3">
              <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4">
                        <h5 class="text-dark font-weight-bold mb-2">Welcome <?php echo $_SESSION['Sname']; ?>! </h5>
                        <?php
                            $query = "select * from evaluation where department='" . $_SESSION['Sd'] . "' and def='" . 1 . "'";
                            $result = mysqli_query($con, $query);
                            $row = $result->fetch_assoc();
                          
                          if ((mysqli_num_rows($result) > 1) or (mysqli_num_rows($result) == 0)) {
                        ?>
                        <h5 class="text-dark font-weight-bold mb-2">Evaluation Status: Not Set</h5>
                        <?php
                        
                        }else{
                          if ($row['status'] == 0) {
                            ?>
                             <h5 class="text-dark font-weight-bold mb-2">Evaluation Status: Not Yet Started</h5>
                             <?php
                              }
                                
                              
                              elseif($row['status'] == 1){
                            ?>
                             <h5 class="text-dark font-weight-bold mb-2">Evaluation Status: Started</h5>
                             <?php }elseif($row['status'] == 2){ ?>
                              <h5 class="text-dark font-weight-bold mb-2">Evaluation Status: Closed</h5>
                              <?php }}?>
                        
                            
                          
                          
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Welcome-Card -->

          </div>

          <?php
          include('_footer.html');
          ?>

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