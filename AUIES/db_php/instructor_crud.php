<?php
if (!isset($_SESSION)) {
    session_start();
}


function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $sid = $_POST['sid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];



        $query = "select * from instructor where ins_id='" . $_POST['sid'] . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The School Id Is Taken!";
            $_SESSION['msg_type'] = "warning";
            header('location:../pages/Admin/instructor.php');
        } else {

            $insert = mysqli_query($con, "INSERT INTO instructor(ins_id,firstname,lastname) values('$sid','$fname','$lname')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "DaData Successfully Saved!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Admin/instructor.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Admin/instructor.php');
            }
        }
    }
}

// *****************************************************************************
function edit_instructor()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];


        $iid = $_POST['iid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];


        $query00 = "select * from instructor where id='" . $id . "'";
        $result00 = mysqli_query($con, $query00);
        $row00 = $result00->fetch_assoc();
        if ($row00['ins_id'] == $iid) {

            $update = mysqli_query($con, "UPDATE instructor SET firstname='$fname',lastname='$lname'  WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Admin/instructor.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Admin/instructor.php');
            }
        } else {

            $query = "select * from instructor where ins_id='" . $_POST['iid'] . "'";
            $result2 = mysqli_query($con, $query);
            if (mysqli_num_rows($result2) > 0) {
                $_SESSION['message'] = "Instructor id is taken";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Admin/instructor.php');
            } else {

                $update = mysqli_query($con, "UPDATE instructor SET ins_id='$iid',firstname='$fname',lastname='$lname'  WHERE id=$id") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Admin/instructor.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Admin/instructor.php');
                }
            }
        }
    }
}



//  ************************************************************************************************
function delete_instructor()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM instructor WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Admin/instructor.php');
    }
}


add_new();
edit_instructor();
delete_instructor();
