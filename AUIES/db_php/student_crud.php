<?php
if (!isset($_SESSION)) {
    session_start();
}


function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $sid = $_POST['sid'];
        $uname = $_POST['uname'];
        $sec = $_POST['sec'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $dep = $_POST['dep'];


        $query = "select * from student where school_id='" . $_POST['sid'] . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The School Id Is Taken!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Admin/student.php');
        } else {
            $query = "select * from student where username='" . $_POST['uname'] . "'";
            $result2 = mysqli_query($con, $query);
            if (mysqli_num_rows($result2) > 0) {
                $_SESSION['message'] = "The Username Is Taken!";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Admin/student.php');
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Admin/student.php');
                } else {
                    $insert = mysqli_query($con, "INSERT INTO student(school_id,username,section,password,department) values('$sid','$uname','$sec','$pass1','$dep')") or die(mysqli_error($con));

                    if ($insert) {
                        $_SESSION['message'] = "Data Successfully Saved!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/student.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Saved!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/student.php');
                    }
                }
            }
        }
    }
}

// *****************************************************************************
function edit_student()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];


        $uname = $_POST['uname'];
        $sec = $_POST['sec'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $dep = $_POST['dep'];


        $query00 = "select * from student where id='" . $id . "'";
        $result00 = mysqli_query($con, $query00);
        $row00 = $result00->fetch_assoc();


        if ($row00['username'] == $uname) {
            if ($pass1 == "") {
                $update = mysqli_query($con, "UPDATE student SET section='$sec',department='$dep'  WHERE id=$id") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Admin/student.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Admin/student.php');
                }
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Admin/student.php');
                } else {

                    $update = mysqli_query($con, "UPDATE student SET section='$sec',password='$pass1',department='$dep'  WHERE id=$id") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/student.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/student.php');
                    }
                }
            }
        } else {
            $query = "select * from student where username='" . $_POST['uname'] . "'";
            $result2 = mysqli_query($con, $query);
            if (mysqli_num_rows($result2) > 0) {
                $_SESSION['message'] = "The Username Is Taken!";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Admin/student.php');
            } else {
                if ($pass1 == "") {
                    $update = mysqli_query($con, "UPDATE student SET username='$uname',section='$sec',department='$dep'  WHERE id=$id") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/student.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/student.php');
                    }
                } else {
                    if ($pass1 != $pass2) {
                        $_SESSION['message'] = "The Password Does Not Match!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../pages/Admin/student.php');
                    } else {

                        $update = mysqli_query($con, "UPDATE student SET username='$fname',section='$sec',password='$pass1',department='$dep'  WHERE id=$id") or die(mysqli_error($con));

                        if ($update) {
                            $_SESSION['message'] = "Data Successfully Updated!";
                            $_SESSION['msg_type'] = "success";

                            header('location:../pages/Admin/student.php');
                        } else {
                            $_SESSION['message'] = "Data Is Not Successfully Updated!";
                            $_SESSION['msg_type'] = "danger";

                            header('location:../pages/Admin/student.php');
                        }
                    }
                }
            }
        }
    }
}


//  ************************************************************************************************
function delete_student()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM student WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Admin/student.php');
    }
}


add_new();
edit_student();
delete_student();