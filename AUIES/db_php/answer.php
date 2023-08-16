<?php

if (!isset($_SESSION)) {
    session_start();
}


function answer()
{
    require_once('connection.php');
    if (isset($_POST['subans'])) {

        $co = $_POST['cou'];
        $sec_id = $_POST['sec_id'];
        $sub_id = $_POST['sub_id'];
        $ins_id = $_POST['ins_id'];
        $res_id = $_POST['res_id'];
        $ev_id = $_POST['ev_id'];
        $stu_id = $_POST['stu_id'];





        for ($i = 0; $i < $co; $i++) {
            $qid = $_POST['q_id'][$i];
            $ans = $_POST['rate'][$_POST['q_id'][$i]];

            $query = "select * from answer where stu_id='" . $_POST['stu_id'] . "' and ev_id='" . $_POST['ev_id'] . "' and ins_id='" . $_POST['ins_id'] . "' and qu_id='" . $qid . "'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                $query = "select * from instructor where ins_id='" . $_POST['ins_id'] . "' ";
                $result = mysqli_query($con, $query);
                $row = $result->fetch_assoc();
                $_SESSION['message'] = "Your are done evaluating " . $row['firstname'] . " " . $row['lastname'] . " this semester. Thank you.";
                $_SESSION['msg_type'] = "danger";
                break;
            } else {
                $insert = mysqli_query($con, "INSERT INTO answer(qu_id,answer,ev_id,ins_id,sub_id,sec_id,res_id,stu_id) values('$qid','$ans','$ev_id','$ins_id','$sub_id','$sec_id','$res_id','$stu_id')") or die(mysqli_error($con));
                if ($insert) {
                    $query = "select * from instructor where ins_id='" . $_POST['ins_id'] . "' ";
                    $result = mysqli_query($con, $query);
                    $row = $result->fetch_assoc();

                    $_SESSION['message'] = "Your are done evaluating " . $row['firstname'] . " " . $row['lastname'] . " this semester. Thank you.";
                    $_SESSION['msg_type'] = "danger";
                }
            }
        }

        header('location:../pages/Student/evaluate.php');
    }
}

answer();
