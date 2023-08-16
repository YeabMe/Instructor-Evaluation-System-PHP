<?php
if (!isset($_SESSION)) {
    session_start();
}

function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $code = $_POST['code'];
        $course = $_POST['cor'];
        $dis = $_POST['dis'];
        $dep = $_POST['dep'];

        $query = "select * from course where code='" . $_POST['code'] . "'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The course exists!";
            $_SESSION['msg_type'] = "warning";

            header('location:../pages/Head/course.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO course(code,course,description,department) values('$code','$course','$dis','$dep')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Data Successfully Saved!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Head/course.php');
            } else {
                $_SESSION['message'] = "Data is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/course.php');
            }
        }
    }
}


// *****************************************************************************
function edit_course(){
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];
        $code = $_POST['code'];
        $course = $_POST['cor'];
        $dis = $_POST['dis'];

        $query00 = "select * from course where id='" . $id . "'";
        $result00 = mysqli_query($con, $query00);
        $row00 = $result00->fetch_assoc();


        if ($row00['code'] == $code) {
            $update = mysqli_query($con, "UPDATE course SET course='$course',description='$dis'  WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";
                header('location:../pages/Head/course.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";
                header('location:../pages/Head/course.php');
            }
        } else {
            $query = "select * from course where code='" . $_POST['code'] . "'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['message'] = "The course exists!";
                $_SESSION['msg_type'] = "warning";

                header('location:../pages/Head/course.php');
            } else {
                $update = mysqli_query($con, "UPDATE course SET code='$code',course='$course',description='$dis'  WHERE id=$id") or die(mysqli_error($con));

                if ($update) {
                    $_SESSION['message'] = "Data Successfully Updated!";
                    $_SESSION['msg_type'] = "success";
                    header('location:../pages/Head/course.php');
                } else {
                    $_SESSION['message'] = "Data Is Not Successfully Updated!";
                    $_SESSION['msg_type'] = "danger";
                    header('location:../pages/Head/course.php');
                }
            }
        }
    }
}


//  ************************************************************************************************
function delete_course()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM course WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Head/course.php');
    }
}

add_new();
edit_course();
delete_course();
