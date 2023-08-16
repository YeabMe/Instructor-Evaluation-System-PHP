<?php
session_start();
if (isset($_POST['re'])) {
  $id = $_POST['eval'];
  $_SESSION['seval'] = $id;
}


require_once('../../db_php/connection.php');
if (isset($_SESSION['Hname'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AUIES Report</title>
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


    <style>
      @media print {
        body * {
          visibility: hidden;
        }

        .print-container,
        .print-container * {
          visibility: visible;
        }
      }
    </style>





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








          <div class="container">
            <div class="jumbotron">
              <div class="card">
                <form action="" method="POST">
                  <label>Choose Instructor</label>
                  <select name="i">
                    <?php




                    $queryev = "select * from evaluation where id='" . $_SESSION['seval'] . "'";
                    $resultev = mysqli_query($con, $queryev);
                    while ($rowev = $resultev->fetch_assoc()) {
                      $queryres = "select distinct ins_id from restriction where evaluation_id='" . $rowev['id'] . "'";
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
                  <button type="Submit" name="subins" class="btn btn-primary">Get</button>
                </form>
              </div>
              <?php
              if (isset($_POST['subins'])) {
                if(isset($_POST['i'])){
                $insid = $_POST['i'];
                $inst = "select * from instructor where ins_id='" . $insid . "'";
                $insre = mysqli_query($con, $inst);
                $rowinst = $insre->fetch_assoc();

                $queryeval = "select * from evaluation where id='" . $_SESSION['seval'] . "'";
                $resulteval = mysqli_query($con, $queryeval);
                $roweval = $resulteval->fetch_assoc();
              ?>
                <div class="card print-container">
                  <div class="card-body">
                    
                    <h1 style="text-align: center;"><img src="../../images/index.png" alt="" width="60" height="60" >AUIES Report</h1>
                    <p><b>Acadamic Year</b><?php echo " " . $roweval['year'] . " "; ?><b>Semister:</b><?php echo " " . $roweval['semister']; ?></p>
                    <p><b>Department</b><?php echo " " . $_SESSION['Hd'] ; ?></p>
                    <p><b>Instructor:</b><?php echo " " . $rowinst['firstname'] . " " . $rowinst['lastname']; ?></p>
                    
                    <hr>
                    <table id="datatable" class="table table-sm">
                      <thead>
                        <tr>
                          <th scope="col">Question</th>
                          <th scope="col">1</th>
                          <th scope="col">2</th>
                          <th scope="col">3</th>
                          <th scope="col">4</th>
                          <th scope="col">5</th>
                          <th scope="col">Student</th>


                        </tr>
                      </thead>



                      <tbody>
                        <?php

                        $query0 = "select * from question where evaluation_id='" . $_SESSION['seval'] . "'";
                        $res = $con->query($query0);
                        $count = mysqli_num_rows($res);
                        $count11 = 0;
                        $count22 = 0;
                        $count33 = 0;
                        $count44 = 0;
                        $count55 = 0;
                        $ts1 = 0;
                        while ($row8 = $res->fetch_assoc()) {
                       
                          
                          

                         






                        ?>
                          <tr>
                            <td>
                              <?php
                              echo $row8['question'];

                              ?>
                              
                            </td>
                            <td>


                                
                                
                            <?php 
                              $query1 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='1' and ins_id='" . $insid . "' ";
                               $res1 = $con->query($query1);
                              $count1 = mysqli_num_rows($res1);
                                echo $count1; 
                                $count11+=$count1;?>
                               


                              </td>

                            
                              <td>


                              <?php 
                              $query2 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='2' and ins_id='" . $insid . "'";
                               $res2 = $con->query($query2);
                              $count2 = mysqli_num_rows($res2);
                                echo $count2; 
                                $count22+=$count2;?>
                                


                              </td>
                              <td>


                              <?php 
                              $query3 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='3' and ins_id='" . $insid . "'";
                               $res3 = $con->query($query3);
                              $count3 = mysqli_num_rows($res3);
                                echo $count3; 
                                $count33+=$count3;?>
                                


                              </td>
                              <td>


                              <?php 
                              $query4 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='4' and ins_id='" . $insid . "'";
                               $res4 = $con->query($query4);
                              $count4 = mysqli_num_rows($res4);
                                echo $count4; 
                                $count44+=$count4;?>
                                


                              </td>
                              <td>


                              <?php 
                              $query5 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='5' and ins_id='" . $insid . "'";
                               $res5 = $con->query($query5);
                              $count5 = mysqli_num_rows($res5);
                                echo $count5; 
                                 $count55+=$count5;?>
                               


                              </td>
                              <td>


                              <?php 
                                $ts = $count1 + $count2 + $count3 + $count4 + $count5;
                                echo $ts; 
                                $ts1+=$ts;?>


                              </td>
                              
                              
                            

                          </tr>
                         
                        <?php  } 

                        $ttimese = ($count11 * 1) + ($count22 * 2) + ($count33 * 3) + ($count44 * 4) + ($count55 * 5);
                        ?>
                        
                         <tr>
                            <td scope="col"><h6>Total</h6></td>
                            <td scope="col"><h6><?php echo $count11;?></h6></td>
                            <td scope="col"><h6><?php echo $count22;?></h6></td>
                            <td scope="col"><h6><?php echo $count33;?></h6></td>
                            <td scope="col"><h6><?php echo $count44;?></h6></td>
                            <td scope="col"><h6><?php echo $count55;?></h6></td>
                            <td scope="col"><h6><?php echo $ts1;?></h6></td>
                          </tr>
                          <tr>
                            <td scope="col"><h6>Total + Evaluation Point</h6></td>
                            <td scope="col"><h6><?php echo $count11 * 1;?></h6></td>
                            <td scope="col"><h6><?php echo $count22 * 2;?></h6></td>
                            <td scope="col"><h6><?php echo $count33 * 3;?></h6></td>
                            <td scope="col"><h6><?php echo $count44 * 4;?></h6></td>
                            <td scope="col"><h6><?php echo $count55 * 5;?></h6></td>
                            <td scope="col"><h6><?php echo $ttimese;?></h6></td>
                          </tr>
                          <tr>
                            <td scope="col"><h6>Avarage from 5%</h6></td>
                            <td scope="col"></td>
                            <td scope="col"></td>
                            <td scope="col"></td>
                            <td scope="col"></td>
                            <td scope="col"></td>
                            <?php if($ts1 != 0){ ?>
                            <td scope="col"><h6><?php echo $ttimese / $ts1;?></h6></td>
                            <?php }?>
                            
                          </tr>
                      </tbody>



                    </table>
                    




                  </div>

                </div>
              <?php 
              }}?>

              <button onclick="window.print();" class="btn btn-primary">Print Preview</button>

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





  </body>

  </html>
<?php } else {
  header('location:../../index.php');
}
?>