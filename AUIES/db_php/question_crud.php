<?php
if (!isset($_SESSION)) {
    session_start();
}

function add_new_Q()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {

        $q = $_POST['q'];
        $cri = $_POST['cri'];
        $dep = $_POST['dep'];
        $ev = $_SESSION['seval'];

        $sql = "SELECT * FROM question where question='$q' and evaluation_id='$ev' and criteria='$cri'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The question exists!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/manageQ.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO question(question,criteria,evaluation_id,department) values('$q','$cri','$ev','$dep')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Data Successfully Saved!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Head/manageQ.php');
            } else {
                $_SESSION['message'] = "Data is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/manageQ.php');
            }
        }
    }
}



// *****************************************************************************
function edit_Question()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {

        $id = $_POST['update_id'];
        $q = $_POST['q'];
        $cri = $_POST['cri'];
        $ev = $_SESSION['seval'];


        $sql = "SELECT * FROM question where question='$q' and evaluation_id='$ev' and criteria='$cri'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The question exists!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/manageQ.php');
        } else {
            $update = mysqli_query($con, "UPDATE question SET question='$q',criteria='$cri'  WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Head/manageQ.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Head/manageQ.php');
            }
        }
    }
}


//  ************************************************************************************************
function delete_Question()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM question WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Head/manageQ.php');
    }
}

// *********************************************************
function add_new_R()
{
    require('connection.php');
    if (isset($_POST['insres'])) {
        $ins = $_POST['ins'];
        $sec = $_POST['sec'];
        $cor = $_POST['cor'];
        $dep = $_POST['dep'];
        $ev = $_SESSION['seval'];

        $sql = "SELECT * FROM restriction where ins_id='$ins' and evaluation_id='$ev' and section_id='$sec'  and course_id='$cor'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The Restriction exists!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/restriction.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO restriction(evaluation_id,ins_id,section_id,course_id,department) values('$ev','$ins','$sec','$cor','$dep')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Data Successfully Saved!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Head/restriction.php');
            } else {
                $_SESSION['message'] = "Data is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/restriction.php');
            }
        }
    }
}



function delete_restriction()
{
    require('connection.php');
    if (isset($_POST['delres'])) {
        $id = $_POST['deleteres_id'];

        mysqli_query($con, "DELETE FROM restriction WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Head/restriction.php');
    }
}


add_new_Q();
edit_Question();
delete_Question();
add_new_R();
delete_restriction();
