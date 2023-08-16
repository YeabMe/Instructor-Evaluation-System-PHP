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
        <title>AUIES Sections</title>
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
                    <div class="modal fade" id="studentadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Section Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="../../db_php/section_crud.php" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Section</label>
                                            <input type="text" name="sec" class="form-control" placeholder="Enter Section" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="dep" class="form-control" value="<?php echo $_SESSION['Hd']; ?>">
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="Submit" name="insertdata" class="btn btn-primary">Save Data</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- edit model -->
                    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Section Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="../../db_php/section_crud.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="update_id" id="update_id">
                                        <div class="mb-3">
                                            <label>Section</label>
                                            <input type="text" name="sec" id="sec" class="form-control" placeholder="Enter year" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="Submit" name="updatedata" class="btn btn-primary">Update data</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Section Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="../../db_php/section_crud.php" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" name="delete_id" id="delete_id">
                                        <h4>Do you want to Delete this Data?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="Submit" name="deletedata" class="btn btn-primary">Yes</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>


                    <div class="container">
                        <div class="jumbotron">
                            <div class="card">
                                <h2>Section</h2>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentadd">
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
                            <div>
                                <div>



                                    <table id="datatable" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>



                                        <tbody>
                                            <?php
                                            $d = $_SESSION['Hd'];
                                            $sql = "SELECT * FROM section where department='$d'";
                                            $res = $con->query($sql);
                                            while ($row = $res->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['section'] ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-success editbtn">
                                                            Edit
                                                            <!-- <i class="fa fa-pencil-square-o" aria-hidden="true"></i> -->
                                                        </button>
                                                        <button type="button" class="btn btn-danger deletebtn">
                                                            Delete
                                                            <!-- <i class="fa fa-trash-o" aria-hidden="true"></i> -->
                                                        </button>

                                                    </td>
                                                </tr>
                                            <?php } ?>
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

        <!-- edit script -->
        <script>
            $(document).ready(function() {


                $("#datatable tbody").on("click", ".editbtn", function() {
                    $('#datatable').DataTable();
                    $('#edit').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[0]);
                    $('#sec').val(data[1]);
                    $('#dep').val(data[2]);
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

                    $('#delete_id').val(data[0]);
                });

            });
        </script>
    </body>

    </html>
<?php } else {
    header('location:../../index.php');
}
?>