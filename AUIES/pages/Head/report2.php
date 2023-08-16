<?php
session_start();
if (isset($_POST['re2'])) {
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
    <title>AUIES Group Report</title>
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

        <?php
        include('navbar.php');
        ?>

        <div class="container-fluid page-body-wrapper">
            <div class="main-panel" style="overflow:scroll !important;">
                <div class="container">
                    <div class="jumbotron">

                        <?php
                        $queryeval = "select * from evaluation where id='" . $_SESSION['seval'] . "'";
                        $resulteval = mysqli_query($con, $queryeval);
                        $roweval = $resulteval->fetch_assoc();
                        ?>
                        <div class="card print-container">
                            <div class="card-body">

                                <h1 style="text-align: center;"><img src="../../images/index.png" alt="" width="60" height="60">AUIES Report</h1>
                                <p><b>Acadamic Year</b><?php echo " " . $roweval['year'] . " "; ?><b>Semister:</b><?php echo " " . $roweval['semister']; ?></p>
                                <p><b>Department:</b><?php echo " " . $_SESSION['Hd']; ?></p>
                                <p><b>All instructors Result</b></p>
                                <hr>
                                <table id="datatable" class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Instructor</th>
                                            <th scope="col">Avarage Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                                    <tr>
                                                        <td>
                                                            <?php
                                                            echo $row1[2] . " " . $row1[3];
                                                            ?>
                                                        </td>
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
                                                            $query1 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='1' and ins_id='" . $row1[1] . "' ";
                                                            $res1 = $con->query($query1);
                                                            $count1 = mysqli_num_rows($res1);

                                                            $count11 += $count1;

                                                            $query2 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='2' and ins_id='" . $row1[1] . "'";
                                                            $res2 = $con->query($query2);
                                                            $count2 = mysqli_num_rows($res2);

                                                            $count22 += $count2;

                                                            $query3 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='3' and ins_id='" . $row1[1] . "'";
                                                            $res3 = $con->query($query3);
                                                            $count3 = mysqli_num_rows($res3);

                                                            $count33 += $count3;

                                                            $query4 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='4' and ins_id='" . $row1[1] . "'";
                                                            $res4 = $con->query($query4);
                                                            $count4 = mysqli_num_rows($res4);

                                                            $count44 += $count4;

                                                            $query5 = "select * from answer where qu_id='" . $row8['id'] . "' and answer='5' and ins_id='" . $row1[1] . "'";
                                                            $res5 = $con->query($query5);
                                                            $count5 = mysqli_num_rows($res5);

                                                            $count55 += $count5;

                                                            $ts = $count1 + $count2 + $count3 + $count4 + $count5;

                                                            $ts1 += $ts;
                                                        }
                                                        $ttimese = ($count11 * 1) + ($count22 * 2) + ($count33 * 3) + ($count44 * 4) + ($count55 * 5);
                                                        if ($ts1 != 0) { 
                                                        ?>
                                                            <td scope="col">
                                                                <h6><?php echo $ttimese / $ts1; ?></h6>
                                                            </td>
                                                        <?php } ?>
                                                    </tr>
                                        <?php  }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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