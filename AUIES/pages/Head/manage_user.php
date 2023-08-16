<?php
session_start();
require_once('../../db_php/connection.php');

if (isset($_SESSION['Hname'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AUIES Manage Account</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/datatables.min.css" />
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/index.png" />
  </head>

  <body>
    <div class="container-scroller">

      <!-- navbar -->
      <?php
      include('navbar.php');
      ?>


      <div class="container-fluid page-body-wrapper">
        <div class="main-panel" style="overflow:scroll !important;">









          <div class="container">
            <div class="jumbotron">
              <div class="card">
                <h2>Manage Your Account</h2>
                <?php
                if (isset($_SESSION['message'])) : ?>
                  <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                  </div>
                <?php endif ?>
              </div>

              <div>
                <!-- manage model -->


                <div>

                  <?php
                  $d = $_SESSION['Hname'];
                  $value = "select * from head where username='" . $d . "'";
                  $result = mysqli_query($con, $value);
                  while ($row = $result->fetch_assoc()) :
                  ?>
                    <form action="../../db_php/manage.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="update_id" id="update_id" value="<?php echo $row['id']; ?>">
                        
                        <div class="mb-3">
                          <label>User Name</label>
                          <input type="text" name="uname" id="uname" class="form-control" placeholder="Enter Username" required value="<?php echo $row['username']; ?>">
                        </div>
                        <div class="mb-3">
                          <label>Password</label>
                          <input type="password" name="pass1" class="form-control" placeholder="Enter Password">
                        </div>
                        <h6>Leave this blank if you dont want to change you password</h6>
                        <div class="mb-3">
                          <label>Confirm Password</label>
                          <input type="password" name="pass2" class="form-control" placeholder="Enter Password Again">
                        </div>

                      <?php endwhile; ?>
                      </div>
                      <div>
                        
                        <button type="Submit" name="managehead" class="btn btn-primary">Update data</button>
                      </div>
                    </form>

                </div>


              </div>
            </div>
          </div>



          <?php
          include('_footer.html');
          ?>
        </div>
      </div>
    </div>


    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/datatables.min.js"></script>
    <!-- datatables -->

  <?php } else {
  header('location:../../index.php');
}
  ?>