<?php

if (!isset($_SESSION)) {
    session_start();
}
require_once('connection.php');



// *****************************************************************************
if (isset($_POST['managehead'])) {
    $uid = $_POST['update_id'];

    $uname = $_POST['uname'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    


    $query00 = "select * from head where id='" . $uid . "'";
    $result00 = mysqli_query($con, $query00);
    $row00 = $result00->fetch_assoc();


    if ($row00['username'] == $uname) {
        if ($pass1 == "") {
            
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/manage_user.php');
            
        } else {
            if ($pass1 != $pass2) {
                $_SESSION['message'] = "The Password Does Not Match!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Head/manage_user.php');
            } else {

                $update = mysqli_query($con, "UPDATE head SET password='$pass1'  WHERE id=$uid") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Head/manage_user.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Head/manage_user.php');
                }
            }
        }
    } else {
        $query = "select * from head where username='" . $_POST['uname'] . "'";
        $result2 = mysqli_query($con, $query);
        if (mysqli_num_rows($result2) > 0) {
            $_SESSION['message'] = "The Username Is Taken!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/manage_user.php');
        } else {
            if ($pass1 == "") {
                $update = mysqli_query($con, "UPDATE head SET username='$uname'  WHERE id=$uid") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Head/manage_user.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Head/manage_user.php');
                }
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Head/manage_user.php');
                } else {

                    $update = mysqli_query($con, "UPDATE head SET username='$uname',password='$pass1'  WHERE id=$uid") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Head/manage_user.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Head/manage_user.php');
                    }
                }
            }
        }
    }
}

//  ************************************************************************************************
if (isset($_POST['manageadmin'])) {
    $uid = $_POST['update_id'];

    $uname = $_POST['uname'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    


    $query00 = "select * from admins where id='" . $uid . "'";
    $result00 = mysqli_query($con, $query00);
    $row00 = $result00->fetch_assoc();


    if ($row00['username'] == $uname) {
        if ($pass1 == "") {
            
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Admin/manage_user.php');
            
        } else {
            if ($pass1 != $pass2) {
                $_SESSION['message'] = "The Password Does Not Match!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Admin/manage_user.php');
            } else {

                $update = mysqli_query($con, "UPDATE admins SET password='$pass1'  WHERE id=$uid") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Admin/manage_user.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Admin/manage_user.php');
                }
            }
        }
    } else {
        $query = "select * from admins where username='" . $_POST['uname'] . "'";
        $result2 = mysqli_query($con, $query);
        if (mysqli_num_rows($result2) > 0) {
            $_SESSION['message'] = "The Username Is Taken!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Admin/manage_user.php');
        } else {
            if ($pass1 == "") {
                $update = mysqli_query($con, "UPDATE admins SET username='$uname'  WHERE id=$uid") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";

                    header('location:../pages/Admin/manage_user.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Admin/manage_user.php');
                }
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Admin/manage_user.php');
                } else {

                    $update = mysqli_query($con, "UPDATE admins SET username='$uname',password='$pass1'  WHERE id=$uid") or die(mysqli_error($con));

                    if ($update) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Admin/manage_user.php');
                    } else {
                        $_SESSION['message'] = "Data Is Not Successfully Updated!";
                        $_SESSION['msg_type'] = "danger";

                        header('location:../pages/Admin/manage_user.php');
                    }
                }
            }
        }
    }
}

//  ************************************************************************************************
if (isset($_POST['managestudent'])) {
    $uid = mysqli_real_escape_string($con, $_POST['update_id']);
    $uname = mysqli_real_escape_string($con, $_POST['uname']);

    $q = "select * from section_update";
    $r = mysqli_query($con, $q);
    $row1 = $r->fetch_assoc();

    if ($row1['sec_upd'] == 1) {
        $sec = mysqli_real_escape_string($con, $_POST['sec']);
    }
    $pass1 = mysqli_real_escape_string($con, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($con, $_POST['pass2']);
    


    $query00 = "select * from student where id='" . $uid . "'";

    $result00 = mysqli_query($con, $query00);
    $row00 = $result00->fetch_assoc();


    if ($row00['username'] == $uname) {
        if ($pass1 == "") {

            
            $q2 = "select * from section_update";
            $r2 = mysqli_query($con, $q2);
            $row2 = $r2->fetch_assoc();

            if ($row2['sec_upd'] == 1) {
                if ($row00['section'] != $sec) {
                    $update2 = "UPDATE student SET section=?  WHERE id=?";
                    $stmt1 = mysqli_stmt_init($con);
                    if (!mysqli_stmt_prepare($stmt1, $update2)) {
                        $_SESSION['message'] = "sql error!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../index.php');
                    } else {
                        mysqli_stmt_bind_param($stmt1, "ss", $sec, $uid);
                        mysqli_stmt_execute($stmt1);
                        // $result = mysqli_stmt_get_result($stmt1);
                        if ($update2) {
                            $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                            $_SESSION['msg_type'] = "success";
                            header('location:../index.php');
                        }
                    }
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";

                    header('location:../pages/Student/manage_user.php');
                }
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Student/manage_user.php');
            }
        } else {
            if ($pass1 != $pass2) {
                $_SESSION['message'] = "The Password Does Not Match!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Student/manage_user.php');
            } else {
                $q2 = "select * from section_update";
                $r2 = mysqli_query($con, $q2);
                $row2 = $r2->fetch_assoc();
                $update55 = "UPDATE student SET password=?  WHERE id=?";
                $stmt2 = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt2, $update55)) {
                    $_SESSION['message'] = "sql error!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../index.php');
                } else {
                    mysqli_stmt_bind_param($stmt2, "ss", $pass1, $uid);
                    mysqli_stmt_execute($stmt2);
                   
                    if (($row2['sec_upd'] == 1) and ($row00['section'] != $sec)) {
                        $update3 = "UPDATE student SET password=?,section=?  WHERE id=?";
                        $stmt3 = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt3, $update3)) {
                            $_SESSION['message'] = "sql error!";
                            $_SESSION['msg_type'] = "danger";
                            header('location:../index.php');
                        } else {
                            mysqli_stmt_bind_param($stmt3, "sss", $pass1, $sec, $uid);
                            mysqli_stmt_execute($stmt3);
                           
                            if ($update3) {
                                $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                                $_SESSION['msg_type'] = "success";
                                header('location:../index.php');
                            }

                            if (($update55) and  ($update3)) {
                                $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                                $_SESSION['msg_type'] = "success";
                                header('location:../index.php');
                            }
                        }
                    } else if ($update55) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Student/manage_user.php');
                    }
                }
            }
        }
    } else {
        $query = "select * from student where username='" . $_POST['uname'] . "'";
        $result2 = mysqli_query($con, $query);
        $q3 = "select * from section_update";
        $r3 = mysqli_query($con, $q3);
        $row3 = $r3->fetch_assoc();

        if (mysqli_num_rows($result2) > 0) {
            $_SESSION['message'] = "The Username Is Taken!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Student/manage_user.php');
        } else {
            if ($pass1 == "") {
                $update44 = "UPDATE student SET username=?  WHERE id=?";
                $stmt4 = mysqli_stmt_init($con);
                if (!mysqli_stmt_prepare($stmt4, $update44)) {
                    $_SESSION['message'] = "sql error!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../index.php');
                } else {
                    mysqli_stmt_bind_param($stmt4, "ss", $uname, $uid);
                    mysqli_stmt_execute($stmt4);
                    // $result4 = mysqli_stmt_get_result($stmt4);
                    if (($row3['sec_upd'] == 1) and ($row00['section'] != $sec)) {
                        $update4 = "UPDATE student SET username=?,section=?  WHERE id=?";
                        $stmt5 = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt5, $update4)) {
                            $_SESSION['message'] = "sql error!";
                            $_SESSION['msg_type'] = "danger";
                            header('location:../index.php');
                        } else {
                            mysqli_stmt_bind_param($stmt5, "sss", $uname, $sec, $uid);
                            mysqli_stmt_execute($stmt5);
                            // $result5 = mysqli_stmt_get_result($stmt5);
                            if ($update4) {
                                $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                                $_SESSION['msg_type'] = "success";
                                header('location:../index.php');
                            }

                            if (($update44) and  ($update4)) {
                                $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                                $_SESSION['msg_type'] = "success";
                                header('location:../index.php');
                            }
                        }
                    } else if ($update44) {
                        $_SESSION['message'] = "Data Successfully Updated!";
                        $_SESSION['msg_type'] = "success";

                        header('location:../pages/Student/manage_user.php');
                    }
                }
            } else {
                if ($pass1 != $pass2) {
                    $_SESSION['message'] = "The Password Does Not Match!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Student/manage_user.php');
                } else {

                    $update33 = "UPDATE student SET username=?,password=?  WHERE id=?";
                    $stmt6 = mysqli_stmt_init($con);
                    if (!mysqli_stmt_prepare($stmt6, $update33)) {
                        $_SESSION['message'] = "sql error!";
                        $_SESSION['msg_type'] = "danger";
                        header('location:../index.php');
                    } else {
                        mysqli_stmt_bind_param($stmt6, "sss", $uname, $pass1, $uid);
                        mysqli_stmt_execute($stmt6);
                        // $result6 = mysqli_stmt_get_result($stmt6);
                        if (($row3['sec_upd'] == 1) and ($row00['section'] != $sec)) {
                            $update6 = "UPDATE student SET username=?,section=?,password=?  WHERE id=?";
                            $stmt7 = mysqli_stmt_init($con);
                            if (!mysqli_stmt_prepare($stmt7, $update6)) {
                                $_SESSION['message'] = "sql error!";
                                $_SESSION['msg_type'] = "danger";
                                header('location:../index.php');
                            } else {
                                mysqli_stmt_bind_param($stmt7, "ssss", $uname, $sec, $pass1, $uid);
                                mysqli_stmt_execute($stmt7);
                                // $result7 = mysqli_stmt_get_result($stmt7);
                                if ($update6) {
                                    $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                                    $_SESSION['msg_type'] = "success";
                                    header('location:../index.php');
                                }

                                if (($update33) and  ($update6)) {
                                    $_SESSION['message'] = "Section Successfully Updated Please login Again!";
                                    $_SESSION['msg_type'] = "success";
                                    header('location:../index.php');
                                }
                            }
                        } else if ($update33) {
                            $_SESSION['message'] = "Data Successfully Updated!";
                            $_SESSION['msg_type'] = "success";

                            header('location:../pages/Student/manage_user.php');
                        }
                    }
                }
            }
        }
    }
}




