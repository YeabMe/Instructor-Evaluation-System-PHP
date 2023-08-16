<?php
if (!isset($_SESSION)) {
    session_start();
}

function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $year = $_POST['year'];
        $sem = $_POST['sem'];
        $d = $_POST['dep'];


        $query = "select * from evaluation where semister='" . $_POST['sem'] . "' and year='" . $_POST['year'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The Evaluation exists!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/evaluation.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO evaluation(year,semister,department) values('$year','$sem','$d')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Data Successfully Saved!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Head/evaluation.php');
            } else {
                $_SESSION['message'] = "Data is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/evaluation.php');
            }
        }
    }
}



// *****************************************************************************
function edit_evaluation()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];
        $year = $_POST['year'];
        $sem = $_POST['sem'];

        $query = "select * from evaluation where semister='" . $_POST['sem'] . "' and year='" . $_POST['year'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The evaluation exists!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/evaluation.php');
        } else {
            $update = mysqli_query($con, "UPDATE evaluation SET year='$year',semister='$sem' WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Head/evaluation.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Head/evaluation.php');
            }
        }
    }
}


//  ************************************************************************************************
function delete_evaluation()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM evaluation WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Head/evaluation.php');
    }
}


// ************************************************************************
function pending()
{
    require('connection.php');
    if (isset($_POST['pending'])) {
        $id = $_POST['stat_id'];

        $update = mysqli_query($con, "UPDATE evaluation SET  status='0' WHERE id=$id") or die(mysqli_error($con));

        if ($update) {
            $_SESSION['message'] = "Data Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../pages/Head/evaluation.php');
        } else {
            $_SESSION['message'] = "Data Is Not Successfully Updated!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/evaluation.php');
        }
    }
}

function start()
{
    require('connection.php');
    if (isset($_POST['start'])) {
        $id = $_POST['stat_id'];

        $update = mysqli_query($con, "UPDATE evaluation SET  status='1' WHERE id=$id") or die(mysqli_error($con));

        if ($update) {
            $_SESSION['message'] = "Data Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../pages/Head/evaluation.php');
        } else {
            $_SESSION['message'] = "Data Is Not Successfully Updated!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/evaluation.php');
        }
    }
}


function close()
{
    require('connection.php');
    if (isset($_POST['close'])) {
        $id = $_POST['stat_id'];

        $update = mysqli_query($con, "UPDATE evaluation SET  status='2' WHERE id=$id") or die(mysqli_error($con));

        if ($update) {
            $_SESSION['message'] = "Data Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../pages/Head/evaluation.php');
        } else {
            $_SESSION['message'] = "Data Is Not Successfully Updated!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/evaluation.php');
        }
    }
}



function is_defalult()
{
    require('connection.php');
    if (isset($_POST['default'])) {
        $id = $_POST['def_id'];

        $update = mysqli_query($con, "UPDATE evaluation SET  def='1' WHERE id=$id") or die(mysqli_error($con));

        if ($update) {
            $_SESSION['message'] = "Data Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../pages/Head/evaluation.php');
        } else {
            $_SESSION['message'] = "Data Is Not Successfully Updated!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/evaluation.php');
        }
    }
}


function not_default()
{
    require('connection.php');
    if (isset($_POST['not_default'])) {
        $id = $_POST['def_id'];

        $update = mysqli_query($con, "UPDATE evaluation SET  def='0' WHERE id=$id") or die(mysqli_error($con));

        if ($update) {
            $_SESSION['message'] = "Data Successfully Updated!";
            $_SESSION['msg_type'] = "success";
            header('location:../pages/Head/evaluation.php');
        } else {
            $_SESSION['message'] = "Data Is Not Successfully Updated!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/evaluation.php');
        }
    }
}


add_new();
edit_evaluation();
delete_evaluation();
pending();
start();
close();
is_defalult();
not_default();
