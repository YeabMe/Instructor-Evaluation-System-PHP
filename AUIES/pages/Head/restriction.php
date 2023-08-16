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
        <title>AUIES Restriction</title>
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




                    <!-- add new Modal -->
                    <div class="modal fade" id="ins" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Restriction</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="../../db_php/question_crud.php" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Instructor</label>
                                            <select name="ins">
                                                <?php
                                                $value = "select * from instructor";
                                                $result = mysqli_query($con, $value);
                                                while ($row1 = mysqli_fetch_array($result)) :;
                                                ?>

                                                    <option value="<?php echo $row1[1]; ?>"><?php echo $row1[2] . " " . $row1[3]; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Section</label>
                                            <select name="sec">
                                                <?php
                                                $d = $_SESSION['Hd'];
                                                $value = "select * from section where department='$d'";
                                                $result = mysqli_query($con, $value);
                                                while ($row1 = mysqli_fetch_array($result)) :;
                                                ?>

                                                    <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Course</label>
                                            <select name="cor">
                                                <?php
                                                $d = $_SESSION['Hd'];
                                                $value = "select * from course where department='$d'";
                                                $result = mysqli_query($con, $value);
                                                while ($row1 = mysqli_fetch_array($result)) :;
                                                ?>

                                                    <option value="<?php echo $row1[0]; ?>"><?php echo $row1[2]; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="dep" class="form-control" value="<?php echo $_SESSION['Hd']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="Submit" name="insres" class="btn btn-primary">Save Data</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- delete model -->
                    <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete restriction Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="../../db_php/question_crud.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="deleteres_id" id="deleteres_id">
                                        <h4>Do you want to Delete this Data?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="Submit" name="delres" class="btn btn-primary">Yes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="jumbotron">
                            <div class="card">
                                <h2>Restiriction</h2>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ins">
                                        Add New
                                    </button>
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
                            </div>
                            <div class="card">
                                <div class="card-body">



                                    <table id="datatable" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Instructor</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Course</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>



                                        <tbody>
                                            <?php
                                            $d = $_SESSION['Hd'];
                                            $e = $_SESSION['seval'];

                                            $sql = "SELECT * FROM restriction where department='$d' and evaluation_id='$e'";
                                            $res = $con->query($sql);
                                            while ($row = $res->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $query1 = "select * from instructor where ins_id='" . $row['ins_id'] . "'";
                                                        $result1 = $con->query($query1);
                                                        $row1 = $result1->fetch_assoc();
                                                        echo $row1['firstname'] . " " . $row1['lastname'];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $query2 = "select * from section where id='" . $row['section_id'] . "'";
                                                        $result2 = $con->query($query2);
                                                        $row2 = $result2->fetch_assoc();
                                                        echo $row2['section'];        
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $query3 = "select * from course where id='" . $row['course_id'] . "'";
                                                        $result3 = $con->query($query3);
                                                        $row3 = $result3->fetch_assoc();
                                                        echo $row3['course'];
                                                        ?>
                                                    </td>

                                                    <td>


                                                        <button type="button" class="btn btn-danger deletebtn">
                                                            Delete
                                                            <!-- <i class="fa fa-trash-o" aria-hidden="true"></i> -->
                                                        </button>

                                                    </td>
                                                </tr>
                                            <?php  } ?>
                                        </tbody>



                                    </table>
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
        <script>
            $(document).ready(function() {
                $('table').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [10, 25, 59, -1],
                        [10, 25, 50, "ALL"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search records"
                    },


                });
            });
        </script>



        <!-- delete script -->
        <script>
            $(document).ready(function() {


                $("#datatable tbody").on("click", ".deletebtn", function() {
                    $('#delete').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#deleteres_id').val(data[0]);
                });

            });
        </script>
    </body>

    </html>
<?php } else {
    header('location:../../index.php');
}
?>