<?php
session_start();

if(isset($_POST['submit'])){

	include 'dbh.inc.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);

	if(empty($uid)){
        $error = "Please enter a student ID";
        $_SESSION["error"] = $error;
        header("Location: ../search.php?search=empty");
        exit();
    }else{
    	$sql = "SELECT * FROM students WHERE student_id='$uid'";
    	$result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1){
            $error = "Invalid ID. Please enter a valid ID";
            $_SESSION["error"] = $error;
            header("Location: ../search.php?login=error_no_student");
            exit();
        } else{
        		header("Location:../student.php?uid=$uid");
        		exit();
        }
    }
}