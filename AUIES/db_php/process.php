<?php
session_start();

function login()
{
    require('connection.php');
    if (isset($_POST['login'])) {

        // $uname = $_POST['uname'];
        // $pass = $_POST['pass'];

        $uname = mysqli_real_escape_string($con, $_POST['uname']);
        $pass =  mysqli_real_escape_string($con, $_POST['pass']);

        if (empty($uname) || empty($pass)) {
            $_SESSION['message'] = "Please Fill In All The Fields!";
            $_SESSION['msg_type'] = "danger";
            header('location:../index.php');
        } else {
            if ($_POST['as'] == 'Admin') {
                $query = "select * from admins where username=? and password=?";
                $stmt = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    $_SESSION['message'] = "sql error!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../index.php');
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_fetch_assoc($result)) {
                        $sname = "select * from admins where username=?";
                        $stmt2 = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt2, $sname)) {
                            $_SESSION['message'] = "sql error!";
                            $_SESSION['msg_type'] = "danger";
                            header('location:../index.php');
                        } else {
                            mysqli_stmt_bind_param($stmt2, "s", $uname);
                            mysqli_stmt_execute($stmt2);
                            $result2 = mysqli_stmt_get_result($stmt2);
                            while ($row = $result2->fetch_assoc()) {
                                $_SESSION['Aname'] = $row['username'];
                            }

                            header('location:../pages/Admin/main.php');
                        }
                    } else {
                        $_SESSION['message'] = "Please Enter The Correct Username Or Password!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../index.php');
                    }
                }
            } elseif ($_POST['as'] == 'Student') {
                $query = "select * from student where username=? and password=?";
                $stmt = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    $_SESSION['message'] = "sql error!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../index.php');
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_fetch_assoc($result)) {
                        $sname = "select * from student where username=?";
                        $stmt2 = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt2, $sname)) {
                            $_SESSION['message'] = "sql error!";
                            $_SESSION['msg_type'] = "danger";
                            header('location:../index.php');
                        } else {
                            mysqli_stmt_bind_param($stmt2, "s", $uname);
                            mysqli_stmt_execute($stmt2);
                            $result2 = mysqli_stmt_get_result($stmt2);
                            while ($row = $result2->fetch_assoc()) {
                                $_SESSION['Sname'] = $row['username'];
                                $_SESSION['Ssec'] = $row['section'];
                                $_SESSION['Sd'] = $row['department'];
                            }

                            header('location:../pages/Student/main.php');
                        }
                    } else {
                        $_SESSION['message'] = "Please Enter The Correct Username Or Password!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../index.php');
                    }
                }
            } elseif ($_POST['as'] == 'Head') {
                $query = "select * from head where username=? and password=?";
                $stmt = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    $_SESSION['message'] = "sql error!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../index.php');
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (mysqli_fetch_assoc($result)) {
                        $sname = "select * from head where username=?";
                        $stmt2 = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt2, $sname)) {
                            $_SESSION['message'] = "sql error!";
                            $_SESSION['msg_type'] = "danger";
                            header('location:../index.php');
                        } else {
                            mysqli_stmt_bind_param($stmt2, "s", $uname);
                            mysqli_stmt_execute($stmt2);
                            $result2 = mysqli_stmt_get_result($stmt2);
                            while ($row = $result2->fetch_assoc()) {
                                $_SESSION['Hname'] = $row['username'];
                                $_SESSION['Hd'] = $row['department'];
                            }

                            header('location:../pages/Head/main.php');
                        }
                    } else {
                        $_SESSION['message'] = "Please Enter The Correct Username Or Password!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../index.php');
                    }
                }
            }
        }
    }
}

login();
