
<?php
if (!isset($_SESSION)) {
    session_start();
}


function add_new()
{
    require('connection.php');
    if (isset($_POST['insertdata'])) {
        $section = $_POST['sec'];
        $dep = $_POST['dep'];



        $query = "select * from section where section='" . $_POST['sec'] . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The section exists!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/section.php');
        } else {
            $insert = mysqli_query($con, "INSERT INTO section(section,department) values('$section','$dep')") or die(mysqli_error($con));

            if ($insert) {
                $_SESSION['message'] = "Data Successfully Saved!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Head/section.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Saved!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/section.php');
            }
        }
    }
}



// *****************************************************************************
function edit_section()
{
    require('connection.php');
    if (isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];

        $section = $_POST['sec'];



        $query = "select * from section where section='" . $_POST['sec'] . "'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['message'] = "The section exists!";
            $_SESSION['msg_type'] = "danger";
            header('location:../pages/Head/section.php');
        } else {


            $update = mysqli_query($con, "UPDATE section SET section='$section'  WHERE id=$id") or die(mysqli_error($con));

            if ($update) {
                $_SESSION['message'] = "Data Successfully Updated!";
                $_SESSION['msg_type'] = "success";

                header('location:../pages/Head/section.php');
            } else {
                $_SESSION['message'] = "Data Is Not Successfully Updated!";
                $_SESSION['msg_type'] = "danger";

                header('location:../pages/Head/section.php');
            }
        }
    }
}


//  ************************************************************************************************
function delete_section()
{
    require('connection.php');
    if (isset($_POST['deletedata'])) {
        $id = $_POST['delete_id'];

        mysqli_query($con, "DELETE FROM section WHERE id=$id") or die(mysqli_error($con));

        header('location:../pages/Head/section.php');
    }
}


add_new();
edit_section();
delete_section();


?>