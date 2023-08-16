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
        $uname = $_POST['uname'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $dep = $_POST['dep'];


        $query = "select * from head where head_id='" . $_POST['sid'] . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The head Id Is Taken!";
            $_SESSION['msg_type'] = "warning";
            header('location:../pages/Admin/head.php');
        } else {
            $query = "select * from head where username='" . $_POST['uname'] . "'";
            $result2 = mysqli_query($con, $query);
            if (mysqli_num_rows($result2) > 0) {
                $_SESSION['message'] = "The Username Is Taken!";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Admin/head.php');
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "warning";
                    header('location:../pages/Admin/head.php');
                } else {
                    $insert = mysqli_query($con, "INSERT INTO head(head_id,firstname,lastname,username,password,department) values('$sid','$fname','$lname','$uname','$pass1','$dep')") or die(mysqli_error($con));

                    if ($insert) {
                        $_SESSION['message'] = "Data Successfully Saved!";
                        $_SESSION['msg_type'] = "success";
                        header('location:../pages/Admin/head.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Saved!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../pages/Admin/head.php');
                    }
                }
            }
        }
    }
}

// *****************************************************************************
function edit_head()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];
        $uname = $_POST['uname'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];



        $query00 = "select * from head where id='" . $id . "'";
        $result00 = mysqli_query($con, $query00);
        $row00 = $result00->fetch_assoc();


        if ($row00['username'] == $uname) {
            if ($pass1 == "") {

                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Admin/head.php');
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Admin/head.php');
                } else {

                    $update = mysqli_query($con, "UPDATE head SET password='$pass1'  WHERE id=$id") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/head.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/head.php');
                    }
                }
            }
        } else {
            $query = "select * from head where username='" . $_POST['uname'] . "'";
            $result2 = mysqli_query($con, $query);
            if (mysqli_num_rows($result2) > 0) {
                $_SESSION['message'] = "The Username Is Taken!";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Admin/head.php');
            } else {
                if ($pass1 == "") {
                    $update = mysqli_query($con, "UPDATE head SET username='$uname'  WHERE id=$id") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/head.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/head.php');
                    }
                } else {
                    if ($pass1 != $pass2) {
                        $_SESSION['message'] = "The Password Does Not Match!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../pages/Admin/head.php');
                    } else {

                        $update = mysqli_query($con, "UPDATE head SET username='$uname',password='$pass1'  WHERE id=$id") or die(mysqli_error($con));

                        if ($update) {
                            $_SESSION['message'] = "Data Successfully Updated!";
                            $_SESSION['msg_type'] = "success";

                            header('location:../pages/Admin/head.php');
                        } else {
                            $_SESSION['message'] = "Data Is Not Successfully Updated!";
                            $_SESSION['msg_type'] = "danger";

                            header('location:../pages/Admin/head.php');
                        }
                    }
                }
            }
        }
    }
}


//  ************************************************************************************************
function delete_head()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM head WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Admin/head.php');
    }
}


add_new();
edit_head();
delete_head();
