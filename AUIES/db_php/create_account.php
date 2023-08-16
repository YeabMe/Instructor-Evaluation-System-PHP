<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('connection.php');



// create student
if (isset($_POST['create_student'])) {
    $sid = mysqli_real_escape_string($con, $_POST['id']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);
    $sec = mysqli_real_escape_string($con, $_POST['sec']);
    $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    $dep = mysqli_real_escape_string($con, $_POST['dep']);

    $query0 = "select * from stlist where sc_id=?";
    $stmt1 = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt1, $query0)) {
        $_SESSION['message'] = "sql error!";
        $_SESSION['msg_type'] = "danger";
        header('location:../index.php');
    } else {
        mysqli_stmt_bind_param($stmt1, "s", $sid);
        mysqli_stmt_execute($stmt1);
        $result0 = mysqli_stmt_get_result($stmt1);
        if (mysqli_num_rows($result0) > 0) {
            $query00 = "select * from student where school_id=?";
            $stmt2 = mysqli_stmt_init($con);
            if (!mysqli_stmt_prepare($stmt2, $query00)) {
                $_SESSION['message'] = "sql error!";
                $_SESSION['msg_type'] = "danger";
                header('location:../index.php');
            } else {
                mysqli_stmt_bind_param($stmt2, "s", $sid);
                mysqli_stmt_execute($stmt2);
                $result00 = mysqli_stmt_get_result($stmt2);
                if (mysqli_num_rows($result00) > 0) {
                    $_SESSION['message'] = "The Id Is Taken!";
                    $_SESSION['msg_type'] = "success";
                    header('location:../create_student.php');
                } else {
                    $query000 = "select * from student where username=?";
                    $stmt3 = mysqli_stmt_init($con);
                    if (!mysqli_stmt_prepare($stmt3, $query000)) {
                        $_SESSION['message'] = "sql error!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../index.php');
                    } else {
                        mysqli_stmt_bind_param($stmt3, "s", $uname);
                        mysqli_stmt_execute($stmt3);
                        $result000 = mysqli_stmt_get_result($stmt3);
                        if (mysqli_num_rows($result000) > 0) {
                            $_SESSION['message'] = "The Username Is Taken!";
                            $_SESSION['msg_type'] = "warning";

                            header('location:../create_student.php');
                        } else {
                            if ($pass1 != $pass2) {
                                $_SESSION['message'] = "The Password Does Not Match!";
                                $_SESSION['msg_type'] = "warning";
                                header('location:../create_student.php');
                            } else {
                                $insert = "INSERT INTO student(school_id,username,section,password,department) values(?,?,?,?,?);";
                                $stmt4 = mysqli_stmt_init($con);
                                if (!mysqli_stmt_prepare($stmt4, $insert)) {
                                    $_SESSION['message'] = "Account Is Not Successfully Created!";
                                    $_SESSION['msg_type'] = "danger";
                                    header('location:../create_student.php');
                                } else {
                                    mysqli_stmt_bind_param($stmt4, "sssss", $sid,$uname,$sec,$pass1,$dep);
                                    mysqli_stmt_execute($stmt4);
                                    
                                    $_SESSION['message'] = "Account Successfully Created!";
                                    $_SESSION['msg_type'] = "success";
                                    header('location:../index.php');

                                }
                               
                            }
                        }
                    }
                }
            }
        } else {
            $_SESSION['message'] = "Invalid Id!";
            $_SESSION['msg_type'] = "danger";
            header('location:../create_student.php');
        }
    }
}
