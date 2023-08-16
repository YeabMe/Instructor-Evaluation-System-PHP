<?php
if (!isset($_SESSION)) {
    session_start();
}


function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $dep_name = $_POST['dep'];

        $query = "select * from department where dp_name='" . $_POST['dep'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The department exist!";
            $_SESSION['msg_type'] = "warning";
            header('location:../pages/Admin/department.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO department(dp_name) values('$dep_name')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Record has been saved!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Admin/department.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Admin/student.php');
            }
        }
    }
}



// *****************************************************************************
function edit_department()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];
        $dep_name = $_POST['dep'];

        $query = "select * from department where dp_name='" . $_POST['dep'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The department exist!";
            $_SESSION['msg_type'] = "warning";
            header('location:../pages/Admin/department.php');
        } else {
            $update = mysqli_query($con, "UPDATE department SET dp_name='$dep_name'  WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Admin/department.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Admin/department.php');
            }
        }
    }
}




//  ************************************************************************************************
function delete_department()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM department WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Admin/department.php');
    }
}


add_new();
edit_department();
delete_department();
