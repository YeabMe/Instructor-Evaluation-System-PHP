<?php
if (!isset($_SESSION)) {
    session_start();
}


function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];


        $query = "select * from admins where username='" . $_POST['uname'] . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The User Name Is Taken!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Admin/user.php');
        } else {
            if ($pass1 != $pass2) {
                $_SESSION['message'] = "The Password Does Not Match!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Admin/user.php');
            } else {
                $insert = mysqli_query($con, "INSERT INTO admins(firstname,lastname,username,password) values('$fname','$lname','$uname','$pass1')") or die(mysqli_error($con));

                if ($insert) {
                    $_SESSION['message'] = "Data Successfully Saved!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Admin/user.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Saved!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Admin/user.php');
                }
            }
        }
    }
}

// *****************************************************************************
function edit_user()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];


        $uname = $_POST['uname'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];


        $query00 = "select * from admins where id='" . $id . "'";
        $result00 = mysqli_query($con, $query00);
        $row00 = $result00->fetch_assoc();


        if ($row00['username'] == $uname) {
            if ($pass1 == "") {

                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Admin/user.php');
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Admin/user.php');
                } else {

                    $update = mysqli_query($con, "UPDATE admins SET password='$pass1'  WHERE id=$id") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/user.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/user.php');
                    }
                }
            }
        } else {
            $query = "select * from admins where username='" . $_POST['uname'] . "'";
            $result2 = mysqli_query($con, $query);
            if (mysqli_num_rows($result2) > 0) {
                $_SESSION['message'] = "The Username Is Taken!";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Admin/user.php');
            } else {
                if ($pass1 == "") {
                    $update = mysqli_query($con, "UPDATE admins SET username='$uname'  WHERE id=$id") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/user.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/user.php');
                    }
                } else {
                    if ($pass1 != $pass2) {
                        $_SESSION['message'] = "The Password Does Not Match!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../pages/Admin/user.php');
                    } else {

                        $update = mysqli_query($con, "UPDATE admins SET username='$uname',password='$pass1'  WHERE id=$id") or die(mysqli_error($con));

                        if ($update) {
                            $_SESSION['message'] = "Data Successfully Updated!";
                            $_SESSION['msg_type'] = "success";

                            header('location:../pages/Admin/user.php');
                        } else {
                            $_SESSION['message'] = "Data Is Not Successfully Updated!";
                            $_SESSION['msg_type'] = "danger";

                            header('location:../pages/Admin/user.php');
                        }
                    }
                }
            }
        }
    }
}


//  ************************************************************************************************
function delete_user()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM admins WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Admin/user.php');
    }
}



add_new();
edit_user();
delete_user();
