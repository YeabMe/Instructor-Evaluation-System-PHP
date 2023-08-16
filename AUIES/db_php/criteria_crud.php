<?php
if (!isset($_SESSION)) {
    session_start();
}


function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $cri = $_POST['cri'];

        $query = "select * from criteria where criteria='" . $_POST['cri'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The criteria exist!";
            $_SESSION['msg_type'] = "warning";
            header('location:../pages/Head/criteria.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO criteria(criteria) values('$cri')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Data Successfully Saved!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Head/criteria.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Head/criteria.php');
            }
        }
    }
}




// *****************************************************************************
function edit_criteria()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];
        $cri = $_POST['cri'];

        $query = "select * from criteria where criteria='" . $_POST['cri'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The criteria exist!";
            $_SESSION['msg_type'] = "warning";
            header('location:../pages/Head/criteria.php');
        } else {
            $update = mysqli_query($con, "UPDATE criteria SET criteria='$cri'  WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Head/criteria.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Head/criteria.php');
            }
        }
    }
}




//  ************************************************************************************************
function delete_criteria()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM criteria WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Head/criteria.php');
    }
}


add_new();
edit_criteria();
delete_criteria();
