<?php
session_start();
// require_once('../../db_php/course_crud.php');
require_once('../../db_php/connection.php');
if (isset($_SESSION['Sname'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AUIES Evaluation</title>
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

      <!-- partial:partials/_horizontal-navbar.html -->
      <?php
      include('navbar.php');
      ?>


      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel" style="overflow:scroll !important;">







          <?php
          $query = "select * from evaluation where department='" . $_SESSION['Sd'] . "' and def='" . 1 . "'";
          $result5 = mysqli_query($con, $query);
          $row99 = $result5->fetch_assoc();



          if ((mysqli_num_rows($result5) > 1) or (mysqli_num_rows($result5) == 0)) {


          ?>
            <script>
              alert('Evaluation Is Not Set')
            </script>

            <?php } else {
            if ($row99['status'] == 0) {
            ?>
              <script>
                alert('Evaluation Not Yet Started')
              </script>
              <?php
            } elseif ($row99['status'] == 1) {

              $query6 = "select * from section where section='" . $_SESSION['Ssec'] . "' ";
              $result6 = mysqli_query($con, $query6);
              $row6 = $result6->fetch_assoc();

              $query7 = "select * from restriction where section_id='" . $row6['id'] . "'";
              $result7 = mysqli_query($con, $query7);
              if (mysqli_num_rows($result7) >= 1) {

              ?>

                <div class="container">
                  <div class="jumbotron">
                    <div class="card">
                      <h2>Evaluate</h2>
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

                    <div class="card">
                      <div class="card-body">
                        <form action="" method="POST">
                          <label>Choose Instructor</label>
                          <select name="i">
                            <?php




                            $querysec = "select * from section where section='" . $_SESSION['Ssec'] . "'";
                            $resultsec = mysqli_query($con, $querysec);
                            
                            while ($rowsec = $resultsec->fetch_assoc()) {
                              $queryres = "select * from restriction where section_id='" . $rowsec['id'] . "' and evaluation_id='" . $row99['id'] . "'";
                              $resultres = mysqli_query($con, $queryres);
                              while ($rowre = $resultres->fetch_assoc()) {
                                $queryins = "select * from instructor where ins_id='" . $rowre['ins_id'] . "'";
                                $resultins = mysqli_query($con, $queryins);
                                while ($row1 = mysqli_fetch_array($resultins)) {
                            ?>

                                  <option value="<?php echo $row1[1]; ?>"><?php echo $row1[2] . " " . $row1[3]; ?></option>
                            <?php }
                              }
                            }
                            ?>
                          </select>
                          <button type="Submit" name="subins" class="btn btn-primary">Evaluate</button>
                        </form>
                        <?php

                        if (isset($_POST['subins'])) {
                          $insid = $_POST['i'];
                          $inst = "select * from instructor where ins_id='" . $insid . "'";
                          $insre = mysqli_query($con, $inst);
                          $rowinst = $insre->fetch_assoc();
                        ?>
                          <h5>Evaluate <?php echo $rowinst['firstname']; ?></h5>
                          <?php
                           $querysec2 = "select * from section where section='" . $_SESSION['Ssec'] . "'";
                           $resultsec2 = mysqli_query($con, $querysec2);
                           $ro2 = $resultsec2->fetch_assoc();
                          $qu = "select * from restriction where ins_id='" . $insid . "' and section_id='" . $ro2['id'] . "'";
                          $resu = mysqli_query($con, $qu);
                          while ($r = $resu->fetch_assoc()) {

                          ?>

                            <form action="../../db_php/answer.php" method="POST">


                              <input type="hidden" name="sec_id" value="<?php echo $r['section_id']; ?>">
                              <input type="hidden" name="sub_id" value="<?php echo $r['course_id']; ?>">
                              <input type="hidden" name="ins_id" value="<?php echo $r['ins_id']; ?>">
                              <input type="hidden" name="res_id" value="<?php echo $r['id']; ?>">
                              <input type="hidden" name="ev_id" value="<?php echo $r['evaluation_id']; ?>">

                              <?php
                              $que = "select * from student where username='" . $_SESSION['Sname'] . "'";
                              $re = mysqli_query($con, $que);
                              $ro = $re->fetch_assoc();
                              ?>
                              <input type="hidden" name="stu_id" value="<?php echo $ro['id']; ?>">

                          <?php }
                        } ?>
                          <hr>
                          <h6>5 = Strongly Agree, 4 = Agree, 3 = Uncertain, 2 = Disagree, 1 = Strongly Disagree</h6>


                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">



                        <table id="datatable" class="table table-sm">
                          <thead>
                            <tr>
                              <th scope="col">Question</th>
                              <th scope="col">1</th>
                              <th scope="col">2</th>
                              <th scope="col">3</th>
                              <th scope="col">4</th>
                              <th scope="col">5</th>

                            </tr>
                          </thead>



                          <tbody>
                            <?php

                            $query0 = "select * from question where evaluation_id='" . $row99['id'] . "'";
                            $res = $con->query($query0);
                            $count = mysqli_num_rows($res);
                            
                            while ($row8 = $res->fetch_assoc()) {





                            ?>
                              <tr>
                                <td>
                                  <?php
                                  echo $row8['question'];

                                  ?>
                                  <input type="hidden" name="cou" value="<?php echo $count; ?>">
                                  <input type="hidden" name="q_id[]" value="<?php echo $row8['id']; ?>">
                                </td>

                                <?php for ($c = 1; $c <= 5; $c++) : ?>
                                  <td>

                                    <input type="radio" name="rate[<?php echo $row8['id'] ?>]" value="<?php echo $c ?>" required>



                                  </td>
                                <?php endfor; ?>

                              </tr>
                            <?php  } ?>
                          </tbody>



                        </table>
                        <button type="submit" name="subans" class="btn btn-primary">Submit</button>
                        </form>

                      </div>
                    </div>




                  </div>
                </div>
              <?php } else { ?>
                <script>
                  alert('no evaluation with your section');
                </script>
              <?php
              }
            } elseif ($row99['status'] == 2) {

              ?>
              <script>
                alert('Evaluation Is Closed')
              </script>
          <?php }
          } ?>










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





  </body>

  </html>
<?php } else {
  header('location:../../index.php');
}
?>